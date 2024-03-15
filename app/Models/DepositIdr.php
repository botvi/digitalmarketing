<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositIdr extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_id',
        'amount',
        'payment_status',
        'payment_method',
    ];

    // Definisikan hubungan dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}