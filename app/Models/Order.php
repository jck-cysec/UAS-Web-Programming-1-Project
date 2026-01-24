<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'total_harga',
        'status',
        'tanggal_order',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'total_harga' => 'integer',
        'status' => 'string',
        'tanggal_order' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}