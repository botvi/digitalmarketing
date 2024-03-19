<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id', // Tambahkan 'kategori_id' ke dalam properti fillable
        'subkategori_id',
        'keterangan',
        'deskripsi',
        'produk',
        'idr',
        'usd',
    ];

    protected $casts = [
        'produk' => 'array',
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
