<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;


class EventController extends Controller
{
    public function index(): View {
        return view('events.index', ['events' => Event::all()]);
    }
}
