<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $table = 'categories';
    use HasFactory;
    protected $fillable = ['name'];
    
    public function albums()
    {
        return $this->hasMany(Album::class, 'categories_id'); // Sesuaikan dengan foreign key
    }
}
