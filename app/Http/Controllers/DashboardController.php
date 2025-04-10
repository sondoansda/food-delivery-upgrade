<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Đảm bảo chỉ admin mới truy cập được
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        // Phân bố vai trò người dùng
        $userRoles = User::select('role')
            ->groupBy('role')
            ->selectRaw('role, COUNT(*) as count')
            ->pluck('count', 'role')
            ->toArray();

        // Tổng số nhà hàng
        $totalUsers = User::count();
        $totalRestaurants = Restaurant::count();
        $totalOrders = Order::count();
        $totalReviews = Review::count();
        $totalDeliveries = Delivery::count();
        $totalPayments = Payment::count(); // Giả định có model Payment

        $orderStatuses = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $userRoles = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        $ordersByDate = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        return view('dashboard.dashboard', compact(
            'totalUsers',
            'totalRestaurants',
            'totalOrders',
            'totalReviews',
            'totalDeliveries',
            'totalPayments',
            'orderStatuses',
            'userRoles',
            'ordersByDate'
        ));
    }
}
