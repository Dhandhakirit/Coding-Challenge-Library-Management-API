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
        'description',
        'is_borrowed',
    ];

    protected $casts = [
        'is_borrowed' => 'boolean',
    ];

    public function isAvailable()
    {
        return !$this->is_borrowed;
    }


}
