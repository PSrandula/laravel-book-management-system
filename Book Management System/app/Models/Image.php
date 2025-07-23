<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['filename', 'book_id'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
