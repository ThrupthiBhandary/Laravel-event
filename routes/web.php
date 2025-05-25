<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ✅ Homepage - show upcoming events if logged in
Route::get('/', function () {
    $events = [];

    if (Auth::check()) {
        $events = Event::whereDate('start', '>=', now())
            ->orderBy('start')
            ->take(5)
            ->get();
    }

    return view('home', compact('events'));
})->name('home');

// ✅ Dashboard (protected)
// Route::get('/dashboard', function () {
//     $upcomingEvents = \App\Models\Event::whereDate('start', '>=', now())
//         ->orderBy('start')
//         ->take(5)
//         ->get();

//     return view('dashboard', compact('upcomingEvents'));
// })->middleware(['auth', 'verified'])->name('dashboard');


// ✅ Authenticated Routes
Route::middleware('auth')->group(function () {
    // 🔐 Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📅 Calendar Routes
    Route::get('/calendar', [EventController::class, 'index'])->name('calendar');

    // 🔁 FullCalendar AJAX API Routes
    Route::get('/events', [EventController::class, 'fetch'])->name('events.fetch');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});

// ✅ Laravel Breeze Auth Routes
require __DIR__.'/auth.php';
