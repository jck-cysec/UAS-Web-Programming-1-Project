<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'gambar',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];
}