<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Event;
use App\Tag;
use App\User;
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
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('events.create', [
            'allTagNames' => $allTagNames,
        ]);    
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
            //EventRequest.phpでpassedValidationメソッドによって、コレクションとなり、eachメソッドが使える
            //第一引数のみ$tagNameとして設定。use ($article)とあるのは、クロージャの中の処理で変数$articleを使うため
            $request->tags->each(function ($tagName) use ($event) {
                //タグの登録にはfirstOrCreateメソッドでタグモデルの保存をする。
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $event->tags()->attach($tag);
            });
            return redirect()->route('events.index');
    }

    public function show(Event $event)
    {

        return view('events.detail', ['event' => $event ]);
    }

    public function join(Request $request, Event $event)
    {
        $event->join()->detach($request->user()->id);
        $event->join()->attach($request->user()->id);
        return [
            'id' => $event->id,
            'countJoin' => $event->count_join,
        ];
    }

    public function unjoin(Request $request, Event $event)
    {
        $event->join()->detach($request->user()->id);
        return [
            'id' => $event->id,
            'countJoin' => $event->count_join,
        ];
    }

}
