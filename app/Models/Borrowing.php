<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Fallback: jika return_date kosong tapi status sudah Dikembalikan, ambil tanggal dari updated_at
    public function getReturnDateAttribute($value)
    {
        if ($value) {
            return $value;
        }

        if (strtolower($this->status) === 'dikembalikan' && $this->updated_at) {
            return $this->updated_at->format('Y-m-d');
        }

        return null;
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(BorrowingDetail::class);
    }
}