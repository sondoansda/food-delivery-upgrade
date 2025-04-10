<?php
// app/Http/Controllers/DriverController.php
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Delivery;

class DriverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'driver') {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $deliveries = Delivery::where('driver_id', auth()->id())
            ->with('order.restaurant') // Load thông tin đơn hàng và nhà hàng
            ->get();
        return view('drivers.index', compact('deliveries'));
    }

    public function updateStatus(Request $request, $id)
    {
        $delivery = Delivery::where('driver_id', auth()->id())->findOrFail($id);
        $delivery->update(['status' => $request->status]);
        if ($request->status == 'delivered') {
            $order = $delivery->order;
            $order->update(['status' => 'delivered']);
            $driver = auth()->user();
            $driver->is_available = true;
            $delivery->order->restaurant->update(['is_available' => true]);
            $delivery->order->restaurant->save();
            $delivery->order->restaurant->user->notify();
            $delivery->order->restaurant->user->save();
        }
        return redirect()->back()->with('success', 'Delivery status updated!');
    }
}
