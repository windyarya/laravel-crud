<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'penulis', 'subbab', 'isi_subbab', 'gambar_materi', 'referensi'
    ];
}
