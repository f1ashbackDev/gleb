<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = "orders_items";
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'count',
        'sum'
    ];

    public function product()
    {
        return $this->hasMany(Products::class, 'id', 'product_id');
    }
}
