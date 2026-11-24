<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class BorrowingController extends Controller
{
    public function index() 
    {
        $borrowings = Borrowing::with(['member', 'user', 'details.book'])->latest()->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

    public function create() 
    {
        $members = Member::all();
        $books = Book::where('stock', '>', 0)->get();
        return view('borrowings.create', compact('members', 'books'));
    }
    
    public function store(Request $request) 
    {
        $request->validate([
            'member_id'   => 'required|exists:members,id',
            'borrow_date' => 'required|date',
            'due_date'    => 'required|date|after_or_equal:borrow_date',
            'book_ids'    => 'required|array|min:1|max:3', // Maksimal 3 buku per transaksi
            'book_ids.*'  => 'required|exists:books,id|distinct', // Mencegah buku sama dipilih 2x dalam 1 transaksi
        ], [
            'book_ids.max'        => 'Maksimal peminjaman adalah 3 buku dalam satu transaksi.',
            'book_ids.*.distinct' => 'Tidak boleh memilih judul buku yang sama lebih dari satu kali dalam satu transaksi.'
        ]);

        // 1. Cek apakah anggota sedang meminjam buku yang sama (belum dikembalikan)
        $bukuSudahDipinjam = Borrowing::where('member_id', $request->member_id)
            ->where('status', 'Dipinjam')
            ->with(['details' => function ($query) use ($request) {
                $query->whereIn('book_id', $request->book_ids)->with('book');
            }])
            ->get()
            ->pluck('details')
            ->flatten();

        if ($bukuSudahDipinjam->isNotEmpty()) {
            $judulBuku = $bukuSudahDipinjam->pluck('book.title')->filter()->unique()->implode(', ');
            return back()
                ->withInput()
                ->with('error', "Gagal! Anggota ini masih meminjam buku yang sama dan belum dikembalikan: {$judulBuku}.");
        }

        // 2. Cek total buku yang saat ini masih berstatus "Dipinjam" oleh anggota tersebut
        $bukuSedangDipinjam = Borrowing::where('member_id', $request->member_id)
            ->where('status', 'Dipinjam')
            ->withCount('details')
            ->get()
            ->sum('details_count');

        $jumlahAkanDipinjam = count($request->book_ids);

        if (($bukuSedangDipinjam + $jumlahAkanDipinjam) > 3) {
            $sisaKuota = max(0, 3 - $bukuSedangDipinjam);
            return back()
                ->withInput()
                ->with('error', "Gagal! Anggota ini sedang meminjam {$bukuSedangDipinjam} buku. Maksimal total pinjaman adalah 3 buku (sisa kuota: {$sisaKuota} buku).");
        }

        DB::beginTransaction();
        try {
            $borrowing = Borrowing::create([
                'user_id'     => auth()->id(),
                'member_id'   => $request->member_id,
                'borrow_date' => $request->borrow_date,
                'due_date'    => $request->due_date,
                'status'      => 'Dipinjam',
            ]);

            foreach ($request->book_ids as $bookId) {
                $book = Book::findOrFail($bookId);
                
                if ($book->stock < 1) {
                    throw new \Exception("Stok buku '{$book->title}' sudah habis.");
                }

                BorrowingDetail::create([
                    'borrowing_id' => $borrowing->id,
                    'book_id'      => $bookId,
                ]);

                $book->decrement('stock');
            }

            DB::commit();
            return redirect()->route('borrowings.index')->with('success', 'Peminjaman berhasil dicatat!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function returnBook($id) 
    {
        DB::beginTransaction();
        try {
            $borrowing = Borrowing::with('details.book')->findOrFail($id);
            
            if ($borrowing->status === 'Dikembalikan') {
                return back()->with('error', 'Buku sudah dikembalikan sebelumnya.');
            }

            $borrowing->update([
                'status'      => 'Dikembalikan',
                'return_date' => now()->toDateString(),
            ]);

            foreach ($borrowing->details as $detail) {
                $detail->book->increment('stock');
            }

            DB::commit();
            return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dikembalikan dan stok diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memproses pengembalian: ' . $e->getMessage());
        }
    }

    public function exportPdf()
    {
        $borrowings = Borrowing::with(['member', 'user', 'details.book'])->latest()->get();
        $pdf = Pdf::loadView('borrowings.pdf', compact('borrowings'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('laporan-peminjaman-buku.pdf');
    }
}