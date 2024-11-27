<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get("/events",[ApiController::class,"getEvent"])->name("getEvent");
Route::get("/spots",[ApiController::class,"getSpot"])->name("getSpot");
Route::post("/logs",[ApiController::class,"postLog"])->name("postLog");