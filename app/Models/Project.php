<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'client_id',
        'kategori_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function bidang()
    {
        return $this->belongsTo(ExpKategori::class, 'kategori_id');
    }
}
