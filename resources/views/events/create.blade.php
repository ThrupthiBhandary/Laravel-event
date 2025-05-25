@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow p-8 mt-10 rounded-lg">
    <h1 class="text-3xl font-bold text-center text-indigo-700 mb-6">Create New Event</h1>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" class="w-full border rounded px-4 py-2" required>
        </div>

        <div>
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="w-full border rounded px-4 py-2" rows="3"></textarea>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block font-semibold mb-1">Start Date & Time</label>
                <input type="datetime-local" name="start" class="w-full border rounded px-4 py-2" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">End Date & Time</label>
                <input type="datetime-local" name="end" class="w-full border rounded px-4 py-2" required>
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Attachment (PDF, Image, etc.)</label>
            <input type="file" name="attachment" class="w-full border rounded px-4 py-2">
        </div>

        <div>
            <label class="block font-semibold mb-1">Category</label>
            <select name="category" class="w-full border rounded px-4 py-2">
                <option value="Meeting">Meeting</option>
                <option value="Birthday">Birthday</option>
                <option value="Work">Work</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Color</label>
            <input type="color" name="color" value="#3788d8" class="w-20 h-10 rounded">
        </div>

        <div class="text-center">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">
                Save Event
            </button>
        </div>
    </form>
</div>
@endsection
