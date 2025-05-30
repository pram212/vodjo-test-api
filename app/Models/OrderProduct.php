<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    /** @use HasFactory<\Database\Factories\OrderProductFactory> */
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_name',
        'qty',
        'price',
    ];
}
