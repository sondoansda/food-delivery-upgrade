<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['user_id', 'name', 'address', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menuItems()
    {
        return $this->hasMany(Menu_Item::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
