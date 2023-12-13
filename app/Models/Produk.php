<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = ['nama', 'stok', 'harga', 'kategori_id', 'thumbnail', 'gambar_detail1', 'gambar_detail2', 'gambar_detail3'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
