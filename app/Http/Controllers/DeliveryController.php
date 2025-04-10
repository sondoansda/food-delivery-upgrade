<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends Controller
{

    public function assign($orderId)
    {
        $order = Order::findOrFail($orderId);
        $driver = User::where('role', 'driver')->where('is_available', true)->firstOrFail();
        Delivery::create([
            'order_id' => $order->id,
            'driver_id' => $driver->id,
            'status' => 'assigned',
        ]);
        $driver->update(['is_available' => false]);
        $order->update(['status' => 'assigned']);
        return redirect()->route('orders.show', $order->id);
    }
}
