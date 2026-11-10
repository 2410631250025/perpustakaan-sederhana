<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'email', 'phone', 'address'];

    // Relasi ke peminjaman (opsional, untuk persiapan fitur Azmi)
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}