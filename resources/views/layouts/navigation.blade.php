<!-- resources/views/layouts/navigation.blade.php -->
@section('navigation')
<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-end z-10">
    <!-- Dropdown menu -->
    <div x-data="{ open: false }" class="relative inline-block text-left">
        <!-- Nút hiển thị tên người dùng -->
        <button @click="open = !open"
            class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            {{ auth()->user()?->name ?? 'Guest' }} ▼
        </button>

        <!-- Dropdown menu -->
        <div x-show="open" @click.away="open = false"
            class="absolute right-0 mt-2 w-48 origin-top-right rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
            <div class="py-1">
                <a href="{{ url('/profile') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Log out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection