<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('user')->get();
        return view('restaurants.index', compact('restaurants'));
    }
    public function show(Restaurant $restaurant)
    {
        $restaurant->load('user', 'menuItems'); // Tải thông tin đơn hàng và món ăn liên quan đến nhà hàng
        return view('restaurants.show', compact('restaurant'));
    }
}
