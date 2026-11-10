<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index() 
    {
        $borrowings = Borrowing::with(['member', 'user', 'details.book'])->latest()->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

    public function create() {
        $members = Member::all();
        $books = Book::where('stock', '>', 0)->get();
        return view('borrowings.create', compact('members', 'books'));
    }
    
    public function store(Request $request) 
    {
        $request->validated([
            'member_id' => 'required|exists:members.id',
            'book_id' => 'required|exists:books,id', //sesuaikan jika pakai array/banyak buku
            'due_date' =>'required|date|after:today',
        ]);

        DB::beginTransaction();
        try {
            $borrowing = Borrowing::create([
                'user_id' => auth()->id, //ini buat nyatet petugas/admin yang login
                'member_id' => $request->member_id,
                'borrow_date' => now(),
                'due_date' => $request->due_date,
                'status' => 'Dipinjam',
            ]);

            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'book_id' => $request->book_id,
            ]);

            $book = Book::find($request->book_id);
            $book->decrement('stok');

            DB:commit();
            return redirect()->route('borrowings.index')->with('sukses', 'Peminjaman berhasil dicatat');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('Eror', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function returnBook($id) 
    {
        DB::beginTransaction();
        try {
            $borrowing = Borrowing::with('details.book')->findOrFail($id);
            $borrowing->update(['status' => 'Dikembalikan']);

            foreach ($borrowing->details as $detail) {
                $detail->book->increment('stock');
            }

        DB::commit();
        return redirect()->route('borrowings.index')->with('sukses', 'Buku berhasil dikembalikan');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('Error', 'Gagal memproses pengembalian');
    }
    
    }
}
