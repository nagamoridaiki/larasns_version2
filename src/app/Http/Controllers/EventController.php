<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all()->sortByDesc('created_at')
        ->load(['user']);
        return view('events.list', compact('events'));
    }

    public function create()
    {
        return view('events.create');    
    }

    public function store(EventRequest $request, Event $event)
    {
            $image = $request->file('image');
            $path = Storage::disk('s3')->putFile('', $image, 'public');
            $event->image = Storage::disk('s3')->url($path);

            $event->title = $request->title;
            $event->detail = $request->detail;
            $event->user_id = $request->user()->id;
            $event->address = $request->address;
            $event->price = $request->price;
            $event->save();
            return redirect()->route('events.index');
    }

    public function show(Event $event)
    {
        
        return view('events.detail', ['event' => $event ]);
    }

}
