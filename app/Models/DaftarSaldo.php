<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarSaldo extends Model
{
    use HasFactory;
    protected $fillable = [
        'idr',
        'usd',
    ];
}
