<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Add 'order_id' to the fillable property
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];
}