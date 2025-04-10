<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['order_id', 'user_id', 'restaurant_id', 'rating', 'comment'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function isAdmin()
    {
        return $this->user->role === 'admin';
    }
}
