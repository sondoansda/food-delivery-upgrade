<?php

namespace App\Http\Controllers;

use App\Models\Menu_Item;


class WelcomeController extends Controller
{
    public function index()
    {
        // Lấy tất cả menu items từ DB
        $menuItems = Menu_Item::with('restaurant')->get();
        // Trả về view welcome với biến $menuItems

        return view('welcome', compact('menuItems'));
    }
}
