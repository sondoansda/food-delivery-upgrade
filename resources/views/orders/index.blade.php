@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-5">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Order Food</h3>
                </div>
                <div class="card-body">
                    @foreach($restaurants as $restaurant)
                    <h4 class="mt-3">{{ $restaurant->name }}</h4>
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($restaurant->menuItems as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td><input type="checkbox" name="items[]" value="{{ $item->id }}" class="form-check-input"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mb-3">
                            <label class="form-label">Total Amount</label>
                            <input type="number" name="total" class="form-control" placeholder="Enter total" required step="0.01">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection