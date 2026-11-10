<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi: Satu Kategori memiliki banyak Buku (1 to Many)
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}