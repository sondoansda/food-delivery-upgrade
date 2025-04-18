<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu_Item extends Model
{
    protected $table = 'menu_items'; // Chỉ định rõ tên bảng

    protected $fillable = ['user_id', 'restaurant_id', 'total', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function menuItems()
    {
        return $this->belongsToMany(Menu_Item::class, 'order_items')
            ->withPivot('quantity', 'price');
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
