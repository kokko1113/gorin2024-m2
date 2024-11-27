<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events=Event::get();
        return view("event.index",compact("events"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("event.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "place"=>"required",
            "date"=>"required",
            "map_image"=>"required",
        ],[
            "name.required"=>"エラーが発生しました",
            "place.required"=>"エラーが発生しました",
            "date.required"=>"エラーが発生しました",
            "map_image.required"=>"エラーが発生しました",
        ]);
        Event::query()->create([
            "name"=>$request->name,
            "place"=>$request->place,
            "date"=>$request->date,
            "map_image"=>$request->map_image,
        ]);
        return redirect(route("event_create"))->with(["message"=>"イベント情報が登録されました"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event=Event::query()->find($id);
        return view("event.edit",compact("event"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name"=>"required",
            "place"=>"required",
            "date"=>"required",
            "map_image"=>"required",
        ],[
            "name.required"=>"エラーが発生しました",
            "place.required"=>"エラーが発生しました",
            "date.required"=>"エラーが発生しました",
            "map_image.required"=>"エラーが発生しました",
        ]);
        $event=Event::query()->find($id);
        $event->update([
            "name"=>$request->name,
            "place"=>$request->place,
            "date"=>$request->date,
            "map_image"=>$request->map_image,
        ]);
        return redirect(route("event_edit",$event->id))->with(["message"=>"イベント情報が更新されました"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event=Event::query()->find($id);
        $event->delete();
        return redirect(route("event_index"));
    }
}
