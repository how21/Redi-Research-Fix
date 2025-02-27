<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    use HasFactory;
    protected $fillable = ['name'];

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }
}
