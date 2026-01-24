<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'game_id',
        'qty',
        'harga',
    ];

    protected $casts = [
        'order_id' => 'integer',
        'game_id' => 'integer',
        'qty' => 'integer',
        'harga' => 'integer',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}