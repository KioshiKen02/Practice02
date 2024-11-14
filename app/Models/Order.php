<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [ 'users_id','house_no','street','barangay','municipality','province', 'payment_method', 'order_status', // Add this line
        // Add other attributes here as needed, like:
        // 'shipping_address', 'payment_method', etc.
    ];
}
