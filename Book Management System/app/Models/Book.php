<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'author', 'publication_year'];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
