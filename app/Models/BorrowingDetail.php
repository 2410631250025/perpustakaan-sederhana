<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    protected $guarded = ['id'];

    public funtion book() {
        return $this-.belongsTo(book::class);
    }
}
