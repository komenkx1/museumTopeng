<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.events.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.events.add");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required"],
            "image_url" => ["required", "mimes:png,jpg,jpeg","max:2048"],
        ]);
        $events = $request->all();
        $fileContent = $request->file('image_url');
        if ($fileContent) {
            $nama_image = "Events/" . md5(now() . "_" . $fileContent->getClientOriginalName()) . '.' . $fileContent->getClientOriginalExtension();
            $fileContent->storeAs('public', $nama_image);
            $events['image_url'] = $nama_image;
        }

        Event::create($events);
        return redirect()->route("admin.events.index")->with('toast_success', 'Event Successful Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view("admin.events.edit",compact('event'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            "name" => ["required"],
            "image_url" => ["mimes:png,jpg,jpeg","max:2048"],
        ]);
        $events = $request->all();
        $fileContent = $request->file('image_url');

        if ($fileContent) {
            Storage::delete('public/' . $event->image_url);
            $nama_image = "Events/" . md5(now() . "_" . $fileContent->getClientOriginalName()) . '.' . $fileContent->getClientOriginalExtension();
            $fileContent->storeAs('public', $nama_image);
            $events['image_url'] = $nama_image;
        }

        $event->update($events);
        return redirect()->route("admin.events.index")->with('toast_success', 'Event Successful Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
