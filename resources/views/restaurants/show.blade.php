<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight tracking-wide">
            {{ $restaurant->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md mb-6 animate-fade-in">
                {{ session('success') }}
            </div>
            @endif

            <!-- Restaurant Details -->
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-indigo-500 pb-2">
                    Restaurant Details
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Name:</span> <span class="text-gray-700">{{ $restaurant->name }}</span></p>
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Address:</span> <span class="text-gray-700">{{ $restaurant->address }}</span></p>
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Phone:</span> <span class="text-gray-700">{{ $restaurant->phone }}</span></p>
                        <p class="text-lg"><span class="font-semibold text-indigo-600">Owner:</span> <span class="text-gray-700">{{ $restaurant->user->name }}</span></p>
                    </div>
                </div>
            </div>

            <!-- Menu Items -->
            <div class="mt-8">
                <h4 class="text-xl font-bold text-gray-800 mb-4 border-b-2 border-indigo-500 pb-2">
                    Menu Items
                </h4>
                @if ($restaurant->menuItems->isEmpty())
                <p class="text-gray-500 text-lg italic">No menu items available.</p>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($restaurant->menuItems as $menuItem)
                    <div class="border rounded-xl p-4 bg-white shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <h5 class="text-lg font-semibold text-gray-900">{{ $menuItem->name }}</h5>
                        <p class="text-sm text-gray-600 mt-1 italic">{{ $menuItem->description }}</p>
                        <p class="text-md mt-2"><span class="font-medium text-indigo-600">Price:</span> <span class="text-gray-800 font-bold">${{ number_format($menuItem->price, 2) }}</span></p>
                        <!-- Add to Cart Form -->
                        <form action="{{ route('order.addToCart', $menuItem->id) }}" method="POST" class="mt-3 flex items-center space-x-2">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" class="w-16 p-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-center">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>

                <!-- View Cart Button -->
                <div class="mt-6 text-right">
                    <a href="{{ route('order.store', $restaurant->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg transition-colors duration-200">
                        View Cart
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tailwind Animation (Optional) -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }
    </style>
</x-app-layout>