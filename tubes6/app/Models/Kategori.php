<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    // Relasi One to Many ke Reservasi
    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'kategori_id');
    }
}