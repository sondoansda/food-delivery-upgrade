@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-5">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Your Deliveries</h3>
                </div>
                <div class="card-body">
                    @if($deliveries->isEmpty())
                    <p class="text-center">No deliveries assigned yet.</p>
                    @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Restaurant</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deliveries as $delivery)
                            <tr>
                                <td>{{ $delivery->order->id }}</td>
                                <td>{{ $delivery->order->restaurant->name }}</td>
                                <td>${{ number_format($delivery->order->total, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $delivery->status == 'delivered' ? 'success' : 'warning' }}">
                                        {{ $delivery->status }}
                                    </span>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('drivers.updateStatus', $delivery->id) }}">
                                        @csrf
                                        <select name="status" class="form-select d-inline w-auto" onchange="this.form.submit()">
                                            <option value="assigned" {{ $delivery->status == 'assigned' ? 'selected' : '' }}>Assigned</option>
                                            <option value="in_progress" {{ $delivery->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="delivered" {{ $delivery->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection