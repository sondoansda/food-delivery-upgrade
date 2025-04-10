<?php

namespace App\Http\Controllers;

use App\Models\Menu_Item;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, $restaurantId = null)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        // Lọc các món ăn trong giỏ hàng theo restaurant_id
        $filteredCart = array_filter($cart, function ($item) use ($restaurantId) {
            return $item['restaurant_id'] == $restaurantId;
        });

        if (empty($filteredCart)) {
            return redirect()->back()->withErrors(['cart' => 'No items from this restaurant in your cart.']);
        }

        // Trả về view hiển thị giỏ hàng
        return view('orders.show', [
            'cartItems' => $filteredCart,
            'restaurantId' => $restaurantId,
        ]);
    }

    public function addToCart(Request $request, Menu_Item $menuItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$menuItem->id])) {
            $cart[$menuItem->id]['quantity'] += $quantity;
        } else {
            $cart[$menuItem->id] = [
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'quantity' => $quantity,
                'restaurant_id' => $menuItem->restaurant_id,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function place(Request $request, $restaurantId)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->withErrors(['cart' => 'Your cart is empty.']);
        }

        $filteredCart = array_filter($cart, function ($item) use ($restaurantId) {
            return $item['restaurant_id'] == $restaurantId;
        });

        if (empty($filteredCart)) {
            return redirect()->back()->withErrors(['cart' => 'No items from this restaurant in your cart.']);
        }

        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $filteredCart));

        $order = Order::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $restaurantId,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($filteredCart as $itemId => $item) {
            $menuItem = Menu_Item::findOrFail($itemId);
            $order->menuItems()->attach($menuItem->id, [
                'quantity' => $item['quantity'],
                'price' => $menuItem->price,
            ]);
        }

        foreach (array_keys($filteredCart) as $itemId) {
            unset($cart[$itemId]);
        }
        session()->put('cart', $cart);

        return redirect()->route('orders.show.order', $order->id)->with('success', 'Order placed successfully!');
    }

    // Phương thức hiển thị chi tiết đơn hàng đã đặt
    public function show(Order $order)
    {
        if (auth()->id() !== $order->user_id) {
            abort(403, 'You are not authorized to view this order.');
        }

        $order->load('menuItems');
        return view('orders.show-order', compact('order'));
    }
}
