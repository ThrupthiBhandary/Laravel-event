<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Show calendar view
    public function index()
    {
        return view('calendar');
    }

    // Fetch all events (used by FullCalendar)
    public function fetch()
    {
       $events = Event::select('id', 'title', 'start', 'end', 'color', 'category')->get();

$formatted = $events->map(function ($event) {
    return [
        'id' => $event->id,
        'title' => $event->title,
        'start' => $event->start->toDateString(),
        'end' => $event->end->toDateString(),
        'color' => $event->color ?? '#3788d8',
        'category' => $event->category ?? 'Other', // 👈 add this line
    ];
});


        return response()->json($formatted);
    }

    // Store a new event
    public function store(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description ?? '',
            'category' => $request->category ?? null,
            'color' => $request->color ?? '#3788d8',
            'user_id' => Auth::id(),
        ]);

        return response()->json($event);
    }

    // Update an existing event
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description ?? '',
            'category' => $request->category ?? $event->category,
            'color' => $request->color ?? $event->color,
        ]);

        return response()->json(['message' => 'Event updated successfully']);
    }

    // Delete an event
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
}
