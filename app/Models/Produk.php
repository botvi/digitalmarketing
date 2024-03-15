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
        'produk',
        'keterangan',
        'stok',
        'idr',
        'usd',
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
