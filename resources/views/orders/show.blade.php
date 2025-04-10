<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-wide">
            Your Cart
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Error Message -->
            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Cart Items -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-indigo-500 pb-2">
                    Items in Your Cart
                </h3>

                @if (empty($cartItems))
                <p class="text-gray-500 text-lg italic">No items in your cart for this restaurant.</p>
                @else
                <div class="space-y-4">
                    @foreach ($cartItems as $itemId => $item)
                    <div class="flex items-center justify-between border-b pb-4">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h5>
                            <p class="text-sm text-gray-600">Quantity: {{ $item['quantity'] }}</p>
                            <p class="text-md"><span class="font-medium text-indigo-600">Price:</span> ${{ number_format($item['price'], 2) }}</p>
                            <p class="text-md"><span class="font-medium text-indigo-600">Subtotal:</span> ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                    </div>
                    @endforeach

                    <!-- Total and Place Order -->
                    <div class="mt-6 text-right">
                        <p class="text-xl font-bold text-gray-800">
                            Total: ${{ number_format(array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems)), 2) }}
                        </p>
                        <form action="{{ route('order.place', $restaurantId) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>