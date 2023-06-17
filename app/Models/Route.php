<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable=['license_plate','model','capacity','owner_name'];

    public function BusStation(){
        return $this->belongsToMany(BusStation::class,'route_station','route_id','bus_station_id');
    }
}
