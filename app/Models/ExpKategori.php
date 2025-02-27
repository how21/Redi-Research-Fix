<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpKategori extends Model
{
    use HasFactory;

    protected $table = 'exp_kategori'; 

    protected $fillable = ['name'];

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }
    public function project()
    {
        return $this->hasMany(Experience::class);
    }
}
