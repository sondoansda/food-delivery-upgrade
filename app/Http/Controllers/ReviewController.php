<?php

// app/Http/Controllers/ReviewController.php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __invoke()
    {
        $restaurant = auth()->user()->restaurant;
        $reviews = $restaurant
            ? Review::whereIn('order_id', $restaurant->orders->pluck('id'))->with('user', 'order')->get()
            : collect();
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review submitted!');
    }
}
