<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;
    protected $table = 'albums';
    protected $fillable = ['title','categories_id',  'image'];

    public function categorie()
    {
        return $this->belongsTo(Category::class);
    }
}
