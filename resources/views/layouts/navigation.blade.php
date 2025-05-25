<nav x-data="{ open: false }" class="bg-emerald-500 text-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('dashboard') }}" class="text-lg font-bold">📅 My Event Calendar</a>

                @auth
                <div class="hidden sm:flex space-x-6">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-300 {{ request()->routeIs('dashboard') ? 'underline' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('calendar') }}" class="hover:text-gray-300 {{ request()->routeIs('calendar') ? 'underline' : '' }}">
                        Calendar
                    </a>
                </div>
                @endauth
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-sm hover:text-gray-300" onclick="event.preventDefault(); this.closest('form').submit();">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-300">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
