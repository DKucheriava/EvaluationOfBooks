<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'genre',
        'description',
        'cover_image',
    ];

    protected $casts = [
        'genre' => 'array',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
