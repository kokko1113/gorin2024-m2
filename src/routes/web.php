<?php

use App\Http\Controllers\DispatchController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\SetmenuController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//  "cache.headers:no_store;max_age=0"









Route::prefix("admin")->group(function(){
    Route::get("/dash",[LoginController::class,"dash"])->name("dash");

    Route::get("/event",[EventController::class,"index"])->name("event_index");
    Route::get("/event/create",[EventController::class,"create"])->name("event_create");
    Route::post("/event",[EventController::class,"store"])->name("event_store");
    Route::get("/event/{id}",[EventController::class,"edit"])->name("event_edit");
    Route::patch("/event/{id}",[EventController::class,"update"])->name("event_update");
    Route::delete("/event/{id}",[EventController::class,"destroy"])->name("event_destroy");

    Route::get("/spot",[SpotController::class,"index"])->name("spot_index");
    Route::get("/spot/create",[SpotController::class,"create"])->name("spot_create");
    Route::post("/spot",[SpotController::class,"store"])->name("spot_store");
    Route::get("/spot/{id}",[SpotController::class,"edit"])->name("spot_edit");
    Route::patch("/spot/{id}",[SpotController::class,"update"])->name("spot_update");
    Route::delete("/spot/{id}",[SpotController::class,"destroy"])->name("spot_destroy");

    Route::get("/log",[LogController::class,"index"])->name("log_index");
    Route::delete("/log/{id}",[LogController::class,"destroy"])->name("log_destroy");
})



?>
