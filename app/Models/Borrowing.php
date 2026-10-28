<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(user::class);
    }
    public function member() {
        return $this->belongsTo(Member::class);
    }
    public function details() {
        return $this->hasMany(BorrowingDetail::class);
    }
}
