<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h1>

        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">🔔 Upcoming Events</h2>
            @forelse($upcomingEvents as $event)
                <div class="p-4 border rounded shadow-sm mb-2 bg-white">
                    <div class="font-medium">{{ $event->title }}</div>
                    <div class="text-sm text-gray-600">{{ $event->start }} → {{ $event->end }}</div>
                </div>
            @empty
                <p class="text-gray-600">No upcoming events.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
