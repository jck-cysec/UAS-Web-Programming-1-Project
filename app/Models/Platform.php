<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $table = 'platforms';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama',
    ];
}