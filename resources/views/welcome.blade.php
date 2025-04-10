@extends('layouts.app')
<?php $pageTitle = 'Welcome to MyFood'; ?>
@section('navigation')
@include('layouts.navigation')
@endsection
@section('header')
<h1 class="text-2xl font-bold text-gray-900">
    {{ __('Food Delivery') }}
</h1>
@endsection
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Food Delivery') }}
        </h2>
        <p class="mt-2 text-gray-600">Explore the best food options available in your area.</p>
        <p class="mt-2 text-gray-600">Order your favorite meals from local restaurants.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900">Fast Delivery</h3>
                <p class="mt-2 text-gray-600">Get your food delivered in under 30 minutes!</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900">Wide Variety</h3>
                <p class="mt-2 text-gray-600">Choose from a variety of cuisines and restaurants.</p>
            </div>
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900">Secure Payments</h3>
                <p class="mt-2 text-gray-600">Pay safely with multiple payment options.</p>
            </div>
        </div>

        <!-- Categories -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Categories</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <p class="text-gray-700">Pizza</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <p class="text-gray-700">Burgers</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <p class="text-gray-700">Sushi</p>
                </div>
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <p class="text-gray-700">Desserts</p>
                </div>
            </div>
        </div>

        <!-- Menu Items -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4">Menu Items</h3>
            @if($menuItems->isEmpty())
            <p class="text-gray-600">No menu items available at the moment.</p>
            @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($menuItems as $item)
                <div class="bg-white shadow rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-900">{{ $item->name }}</h4>
                    <p class="text-gray-600">Restaurant: {{ $item->restaurant_name }}</p>
                    <p class="text-gray-600">Price: ${{ number_format($item->price, 2) }}</p>
                    <p class="text-gray-600">Status: {{ ucfirst($item->status) }}</p>
                    <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Add to Cart
                    </button>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection