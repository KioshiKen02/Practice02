<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'quantity', 'image', 'users_id'];

    // Define the relationship between Product and User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }
}
