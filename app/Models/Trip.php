<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory,HasUuids;

    protected $fillable=['timetable_id','bus_id','type','details',
    'location_id','start','end','route_id',
    'distance','status','from','to'];


    public function TimeTable(){
        return $this->belongsTo(TimeTable::class);
    }

    public function Bus(){
        return $this->hasOne(Bus::class);
    }

    public function Route(){
        return $this->hasOne(Route::class);
    }

    public function From(){
        return $this->hasOne(BusStation::class,'from','id');
    }

    public function To(){
        return $this->hasOne(BusStation::class,'to','id');
    }
}
