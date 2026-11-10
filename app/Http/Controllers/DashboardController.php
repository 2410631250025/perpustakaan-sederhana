<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookTitles = Book::count();
        $totalBookStock  = Book::sum('stock');
        $totalMembers    = Member::count();

        $totalBorrowed = 0;
        if (Schema::hasTable('borrowings')) {
            $totalBorrowed = Borrowing::where('status', 'borrowed')->count();
        }

        return view('dashboard.index', compact(
            'totalBookTitles',
            'totalBookStock',
            'totalMembers',
            'totalBorrowed'
        ));
    }
}