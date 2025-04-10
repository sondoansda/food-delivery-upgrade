<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurants') }}
        </h2>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Restaurants List -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-lg font-medium mb-4">List of Restaurants</h3>

                @if ($restaurants->isEmpty())
                <p class="text-gray-500">No restaurants found.</p>
                @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($restaurants as $restaurant)
                    <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow">
                        <h4 class="text-md font-semibold text-gray-800">{{ $restaurant->name }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $restaurant->address }}</p>
                        <p class="text-sm mt-1">
                            <span class="font-medium">Owner:</span> {{ $restaurant->user->name }}
                        </p>
                        <p class="text-sm mt-1">
                            <span class="font-medium">Status:</span>
                            <span class="{{ $restaurant->is_available ? 'text-green-600' : 'text-red-600' }}">
                                {{ $restaurant->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </p>
                        <div class="mt-3 flex space-x-2">
                            <a href="{{ route('restaurants.show', $restaurant->id) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm">View Details</a>
                            <!-- Thêm các nút Edit/Delete nếu cần -->
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>