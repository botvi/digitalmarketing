<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'subkategori_id',
        'keterangan',
        'deskripsi',
        'produk',
        'idr',
        'usd',
        'gambar', // Tambahkan 'gambar' ke dalam properti fillable
    ];

    protected $casts = [
        'produk' => 'array',
        'gambar' => 'array', // Tambahkan 'gambar' ke dalam properti casts
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function subkategori()
    {
        return $this->belongsTo(SubKategori::class);
    }

 
}
