<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduk extends Model
{
    use HasFactory;
    protected $table = 'order_produk';

    protected $fillable = [
        'user_id',
        'produk_id',
        'harga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
