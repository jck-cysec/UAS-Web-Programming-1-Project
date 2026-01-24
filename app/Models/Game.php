<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_game',
        'genre',
        'platform',
        'harga',
        'deskripsi',
        'gambar',
    ];

    protected $casts = [
        'harga' => 'integer',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
