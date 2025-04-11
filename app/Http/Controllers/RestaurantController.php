<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $cacheKey = "restaurants_page_{$page}";

        // Cache dữ liệu phân trang trong 60 giây
        $restaurants = Cache::remember($cacheKey, 60, function () use ($page) {
            return Restaurant::paginate(10, ['*'], 'page', $page);
        });

        return response()->json($restaurants);
    }

    public function apiIndex(Request $request)
    {
        try {
            $page = $request->query('page', 1);
            $cacheKey = "api_restaurants_page_{$page}";

            // Cache riêng cho API
            $restaurants = Cache::remember($cacheKey, 60, function () use ($page) {
                return Restaurant::select('id', 'name', 'address') // Chỉ lấy các cột cần thiết
                    ->paginate(10, ['*'], 'page', $page);
            });

            return response()->json([
                'success' => true,
                'data' => $restaurants->items(), // Chỉ trả về mảng dữ liệu
                'pagination' => [
                    'current_page' => $restaurants->currentPage(),
                    'total' => $restaurants->total(),
                    'per_page' => $restaurants->perPage(),
                    'last_page' => $restaurants->lastPage(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch restaurants',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', compact('restaurant'));
    }
}
