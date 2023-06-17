<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BusStation extends Model
{
    use HasFactory,HasUuids;
    protected $fillable=['name','address','latitude','longitude'];

    public function Bus(){
        return $this->BelongsToMany(Bus::class,'bus_bus_station','bus_station_id','bus_id');
    }
    
    public function Route(){
        return $this->belongsToMany(Route::class,'route_station','bus_station_id','route_id');
    }


    public function Driver(){
        return $this->belongsToMany(Driver::class,'bus_station_driver','bus_station_id','driver_id');
    }


    
    
}
