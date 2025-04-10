<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-wide">
            Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md mb-6">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-indigo-500 pb-2">
                    Order Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Order ID:</span> {{ $order->id }}</p>
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Restaurant:</span> {{ $order->restaurant->name }}</p>
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Total:</span> ${{ number_format($order->total, 2) }}</p>
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Status:</span>
                            <span class="inline-block px-2 py-1 text-sm font-semibold rounded {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Placed by:</span> {{ $order->user->name }}</p>
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Date:</span> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-indigo-500 pb-2">
                        Ordered Items
                    </h4>
                    @foreach ($order->menuItems as $menuItem)
                    <div class="flex items-center justify-between border-b pb-4">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-900">{{ $menuItem->name }}</h5>
                            <p class="text-sm text-gray-600">Quantity: {{ $menuItem->pivot->quantity }}</p>
                            <p class="text-md"><span class="font-medium text-indigo-600">Price:</span> ${{ number_format($menuItem->pivot->price, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>