<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $guarded =["id"];
    protected $fillable = [
        'title', 'slug', 'client_id', 'province_id', 'kategori_id','image', 'desc'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function bidang()
    {
        return $this->belongsTo(ExpKategori::class, 'kategori_id');
    }
}
