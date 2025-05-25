<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $upcomingEvents = Event::where('start', '>=', now())
                                ->orderBy('start')
                                ->limit(5)
                                ->get();

        return view('dashboard', compact('upcomingEvents'));
    }
}
