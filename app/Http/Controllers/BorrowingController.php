<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index() {
        $borrowings = Borrowing::with(['details.book'])->get();
        return view('borrowings.index', compact('borrowings'));
        }

    public function create() {
        $members = Member::all();
        $books = Book::where('stock', '>', 0)->get();
        return view('borrowings.create', compcat('members', 'books'));
    }
    
    public function store(Request $request) {
        $request->validated([
            'member_id' => 'required|exists:members.id',
            'book_ids' => 'required|array', //ini untuk menerima array ID buku dari form
            'book_ids.*' => 'exists:book.id'
        ]);

        DB::transaction(function () use ($request) {
            $borrowing = Borrowing::create([
                'user_id' => auth()->user()->id, //ini buat nyatet petugas/admin yang login
                'member_id' => $request->member_id,
                'borrow_date' => Carbon::now()->toDateString(),
                'due_date' => Carbon::now()->addDays(7)->toDateString(), 
                'status' => 'borrowed'
            ]);

            foreach ($request->book_ids as $bookId) {
                BorrowingDetail::create([
                    'borrowing_id' => $borrowing->id,
                    'book_id' =>$bookId
                ]);

                Book::find($bookId)->decrement('stok');
            }
        });

        return redirect()->route('borrowings.index')->with('success', 'Peminjaman Berhasil Dicatat');
    }

    public function returnBook($id) {
        $borrowing = Borrowing::with('details')->findOrFail($id);

        if ($borrowing->status === 'returned') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->update([
                'return_date' => Carbon::now()->toDateString(),
                'status' => 'returned'
            ]);

            foreach ($borrowing->details as $detail) {
                Book::find($detail->book-id)->increment('stock');
            }
        });

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dikembalikan');
    }
}
