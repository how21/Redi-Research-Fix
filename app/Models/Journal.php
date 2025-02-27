<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'authors',
        'publication_year',
        'publisher',
        'abstract',
        'file_path', // Untuk menyimpan path file PDF
        'doi',
        'keyword',
    ];

    protected $casts = [
        'keyword' => 'array',
    ];

}
