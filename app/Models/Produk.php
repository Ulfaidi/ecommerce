<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $casts = [
        'gambar_detail' => 'array',
    ];
    protected $table = 'produk';

    protected $fillable = ['nama', 'stok', 'harga', 'kategori_id', 'gambar_detail', 'thumbnail', 'size', 'deskripsi'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
