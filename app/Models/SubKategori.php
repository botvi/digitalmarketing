<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama_sub_kategori', 'kategori_id','keterangan'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    
}
