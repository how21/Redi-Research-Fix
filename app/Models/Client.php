<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    use HasFactory;
    protected $fillable = ['full_name', 'short_name'];

    /** 
    * Relasi One-to-Many: Satu Client memiliki banyak Experiences.
    */
    public function experience()
    {
        return $this->hasMany(Experience::class);
    }
    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
