@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-5">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Customer Reviews</h3>
                </div>
                <div class="card-body">
                    @if($reviews->isEmpty())
                    <p class="text-center">No reviews yet.</p>
                    @else
                    <div class="list-group">
                        @foreach($reviews as $review)
                        <div class="list-group-item mb-3">
                            <div class="d-flex justify-content-between">
                                <h5>{{ $review->user->name }}</h5>
                                <span class="badge bg-warning text-dark">
                                    {{ $review->rating }} <i class="fas fa-star"></i>
                                </span>
                            </div>
                            <p class="mb-1">{{ $review->comment ?? 'No comment' }}</p>
                            <small class="text-muted">Order #{{ $review->order->id }} - {{ $review->created_at->diffForHumans() }}</small>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection