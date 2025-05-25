@extends('layouts.app')

@section('content')

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-7xl p-12 bg-white rounded-2xl shadow-xl mt-30 min-h-[600px] py-20 ">
        
        {{-- Main Heading --}}
        <div class="text-center mb-10 mt-8">
            <h1 class="text-5xl font-extrabold text-indigo-700 mb-8">📅 PlanWise-Event Scheduler Dashboard</h1>
            <p class="text-xl text-gray-600 italic mb-6">
                <span class="text-blue-500">Plan</span>, 
                <span class="text-green-500">manage</span>, and 
                <span class="text-purple-500">track</span> your events effortlessly.
            </p>
        </div>

        {{-- Guest Actions --}}
        @guest
            <div class="text-center space-x-4 mb-8">
                <a href="{{ route('login') }}" class="bg-teal-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">Login</a>
                <a href="{{ route('register') }}" class="bg-gray-700 text-white px-5 py-2 rounded hover:bg-gray-800 transition">Register</a>
            </div>
        @endguest

        {{-- Authenticated User Actions --}}
        @auth
            <div class="text-center space-x-4 mb-10">
                <a href="{{ route('calendar') }}" class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition">📆 View Calendar</a>
                <a href="{{ route('profile.edit') }}" class="bg-teal-700 text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition">👤Event list</a>
            </div>

            {{-- Upcoming Events Section --}}
            <div>
                <h2 class="text-2xl font-semibold text-indigo-600 mb-4">🔔 Upcoming Events</h2>
                @if ($events->count())
                    <ul class="list-disc pl-6 space-y-2 text-gray-700">
                        @foreach ($events as $event)
                            <li>
                                <span class="font-bold">{{ $event->title }}</span> — 
                                {{ \Carbon\Carbon::parse($event->start)->format('M d, Y') }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500">No upcoming events.</p>
                @endif
            </div>
        @endauth
    </div>
</div>
@endsection
