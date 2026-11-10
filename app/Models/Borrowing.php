<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    //untuk Anggota yang meminjam
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    //untuk petugas yang melayani
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //detail buku bisa lebih dari satu buku
    public function details()
    {
        return $this->hasMany(BorrowingDetails::class);
    }
}
