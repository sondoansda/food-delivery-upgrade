<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app') <!-- Kết nối với app.blade.php -->

@section('navigation')
@include('layouts.navigation') <!-- Gọi navigation.blade.php -->
@endsection

@section('header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Admin Dashboard') }}
</h2>
@endsection
@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-blue-50 p-6 rounded-lg shadow-sm">
                <h4 class="text-md font-medium text-blue-800">Total Users</h4>
                <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
            </div>
            <div class="bg-green-50 p-6 rounded-lg shadow-sm">
                <h4 class="text-md font-medium text-green-800">Total Restaurants</h4>
                <p class="text-3xl font-bold text-green-600">{{ $totalRestaurants }}</p>
            </div>
            <div class="bg-yellow-50 p-6 rounded-lg shadow-sm">
                <h4 class="text-md font-medium text-yellow-800">Total Orders</h4>
                <p class="text-3xl font-bold text-yellow-600">{{ $totalOrders }}</p>
            </div>
            <div class="bg-purple-50 p-6 rounded-lg shadow-sm">
                <h4 class="text-md font-medium text-purple-800">Total Reviews</h4>
                <p class="text-3xl font-bold text-purple-600">{{ $totalReviews }}</p>
            </div>
            <div class="bg-red-50 p-6 rounded-lg shadow-sm">
                <h4 class="text-md font-medium text-red-800">Total Deliveries</h4>
                <p class="text-3xl font-bold text-red-600">{{ $totalDeliveries }}</p>
            </div>
            <div class="bg-indigo-50 p-6 rounded-lg shadow-sm">
                <h4 class="text-md font-medium text-indigo-800">Total Payments</h4>
                <p class="text-3xl font-bold text-indigo-600">{{ $totalPayments }}</p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h4 class="text-md font-medium mb-4">Orders by Status</h4>
                <canvas id="orderStatusChart" height="200"></canvas>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h4 class="text-md font-medium mb-4">User Roles Distribution</h4>
                <canvas id="userRolesChart" height="200"></canvas>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm col-span-1 lg:col-span-2">
                <h4 class="text-md font-medium mb-4">Orders Over Last 7 Days</h4>
                <canvas id="ordersByDateChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const charts = {
            orderStatus: document.getElementById('orderStatusChart').getContext('2d'),
            userRoles: document.getElementById('userRolesChart').getContext('2d'),
            ordersByDate: document.getElementById('ordersByDateChart').getContext('2d'),
            data: {
                orderStatuses: @json($orderStatuses ?? []),
                userRoles: @json($userRoles ?? []),
                ordersByDate: @json($ordersByDate ?? [])
            }
        };
        console.log('Charts data:', charts.data); // Debug dữ liệu
        window.initCharts(charts);
    });
</script>
@vite('resources/js/dashboard.js')
@endsection