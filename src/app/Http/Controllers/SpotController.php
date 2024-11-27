<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotController
{
    public function index()
    {
        $spots=Spot::get();
        return view("spot.index",compact("spots"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events=Event::get();
        return view("spot.create",compact("events"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "event_id"=>"required",
            "name"=>"required",
            "description"=>"required",
            "location_x"=>"required",
            "location_y"=>"required",
            "images"=>"required",
        ],[
            "event_id.required"=>"エラーが発生しました",
            "name.required"=>"エラーが発生しました",
            "description.required"=>"エラーが発生しました",
            "location_x.required"=>"エラーが発生しました",
            "location_y.required"=>"エラーが発生しました",
            "images.required"=>"エラーが発生しました",
        ]);
        Spot::query()->create([
            "event_id"=>$request->event_id,
            "name"=>$request->name,
            "description"=>$request->description,
            "location_x"=>$request->location_x,
            "location_x"=>$request->location_x,
            "location_y"=>$request->location_y,
            "images"=>$request->images,
        ]);
        return redirect(route("spot_create"))->with(["message"=>"スポット情報が登録されました"]);
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
        $spot=Spot::query()->find($id);
        $events=Event::get();
        return view("spot.edit",compact("spot","events"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "event_id"=>"required",
            "name"=>"required",
            "description"=>"required",
            "location_x"=>"required",
            "location_y"=>"required",
            "images"=>"required",
        ],[
            "event_id.required"=>"エラーが発生しました",
            "name.required"=>"エラーが発生しました",
            "description.required"=>"エラーが発生しました",
            "location_x.required"=>"エラーが発生しました",
            "location_y.required"=>"エラーが発生しました",
            "images.required"=>"エラーが発生しました",
        ]);
        $spot=Spot::query()->find($id);
        $spot->update([
            "event_id"=>$request->event_id,
            "name"=>$request->name,
            "description"=>$request->description,
            "location_x"=>$request->location_x,
            "location_y"=>$request->location_y,
            "images"=>$request->images,
        ]);
        return redirect(route("spot_edit",$spot->id))->with(["message"=>"スポット情報が更新されました"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spot=Spot::query()->find($id);
        $spot->delete();
        return redirect(route("spot_index"));
    }
}
