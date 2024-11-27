<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable=[
        "event_id",
        "spot_id",
        "operation_type",
        // "created_at",
    ];
    
    public function event(){
        return $this->belongsTo(Event::class,"event_id");
    }
    public function spot(){
        return $this->belongsTo(Event::class,"spot_id");
    }
}
