<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    protected $fillable=[
        "event_id",
        "name",
        "description",
        "location_x",
        "location_y",
        "images",
    ];

    public function event(){
        return $this->belongsTo(Event::class,"event_id");
    }
}
