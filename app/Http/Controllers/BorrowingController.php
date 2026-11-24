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
            'book_ids'    => 'required|array|min:1',
            'book_ids.*'  => 'required|exists:books,id|distinct', // distinct mencegah buku yang sama dipilih 2x
        ], [
            'book_ids.*.distinct' => 'Tidak boleh memilih judul buku yang sama lebih dari satu kali dalam satu transaksi.'
        ]);

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
                'return_date' => now(),
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