@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold flex items-center gap-2">
            <span class="text-indigo-600">📅</span> Event Calendar
        </h1>
    </div>

   <div class="mb-4 space-x-4">
    <span class="inline-flex items-center">
        <span class="w-4 h-4 bg-blue-500 rounded mr-1"></span> Meeting
    </span>
    <span class="inline-flex items-center">
        <span class="w-4 h-4 bg-purple-500 rounded mr-1"></span> Assignment
    </span>
    <span class="inline-flex items-center">
        <span class="w-4 h-4 bg-yellow-400 rounded mr-1"></span> Exam
    </span>
    <span class="inline-flex items-center">
        <span class="w-4 h-4 bg-pink-500 rounded mr-1"></span> Birthday
    </span>
    <span class="inline-flex items-center">
        <span class="w-4 h-4 bg-teal-500 rounded mr-1"></span> Study
    </span>
    <span class="inline-flex items-center">
        <span class="w-4 h-4 bg-gray-600 rounded mr-1"></span> Other
    </span>
</div>


        <div id="calendar" style="min-height: 700px;" class="h-[700px]"></div>
    </div>
</div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                editable: true,
                events: {
    url: '/events',
    method: 'GET',
    failure: function() {
        alert('There was an error while fetching events!');
    }
},
eventDataTransform: function(eventData) {
    return {
        ...eventData,
         title: `${eventData.title} (${eventData.category})`, // show category too
        color: eventData.color // ✅ apply dynamic color
    };
},


               select: function (info) {
    const title = prompt('Enter Event Title:');
    if (!title) {
        calendar.unselect();
        return;
    }

    const category = prompt('Enter Category (Meeting,Study,Birthday,Assignment,Work,Exam, Other):');
    if (!category) {
        calendar.unselect();
        return;
    }

    // Define color based on category
    let color = '#3788d8'; // default
  switch (category.toLowerCase()) {
    case 'meeting':
        color = '#3b82f6'; // blue-500
        break;
    case 'assignment':
        color = '#8b5cf6'; // purple-500
        break;
    case 'exam':
        color = '#facc15'; // yellow-400
        break;
    case 'birthday':
        color = '#ec4899'; // pink-500
        break;
    case 'study':
        color = '#14b8a6'; // teal-500
        break;
    case 'other':
        color = '#4b5563'; // gray-600
        break;
}



    fetch('/events', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            title: title,
            start: info.startStr,
            end: info.endStr,
            category: category,
            color: color
        })
    })
    .then(response => response.json())
    .then(() => {
        calendar.refetchEvents();
        alert('✅ Event added!');
    });

    calendar.unselect();
},


                eventDrop: function (info) {
                    fetch(`/events/${info.event.id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            title: info.event.title,
                            start: info.event.start.toISOString(),
                            end: info.event.end ? info.event.end.toISOString() : info.event.start.toISOString()
                        })
                    }).then(() => {
                        alert('✅ Event updated!');
                    });
                },

                eventClick: function (info) {
                    if (confirm('❌ Delete this event?')) {
                        fetch(`/events/${info.event.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(() => {
                            calendar.refetchEvents();
                            alert('🗑️ Event deleted!');
                        });
                    }
                }
            });

            calendar.render();
        });
    </script>
@endpush
