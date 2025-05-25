@extends('layouts.app')

@section('content')

    <!-- Optional Header -->
    <div class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Profile') }}
            </h2>
        </div>
    </div>

    <!-- User Name and Events -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Welcome, {{ $user->name }}</h2>

            <h3 class="text-xl font-semibold mb-2">Your Events</h3>
            <ul class="list-disc pl-5 space-y-2">
                @forelse ($events as $event)
                    <li>
                        <div class="flex items-center gap-2">
                            <strong>{{ $event->title }}</strong>
                            @if ($event->category)
                                <span class="inline-block w-3 h-3 rounded-full" style="background-color: {{ $event->color }}"></span>
                                <span class="text-sm text-gray-600">({{ $event->category }})</span>
                            @endif
                        </div>
                        <div>{{ $event->start->format('Y-m-d H:i') }} - {{ $event->end->format('Y-m-d H:i') }}</div>
                        <div>{{ $event->description }}</div>
                    </li>
                @empty
                    <li>No events found.</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Profile Forms -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

@endsection
