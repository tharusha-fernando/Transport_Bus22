<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;


    public function BusStation(){
        return $this->belongsToMany(BusStation::class,'bus_station_driver','driver_id','bus_station_id');
    }

    public function Doc(){
        return $this->belongsToMany(Doc::class,'driver_docs','driver_id','doc_id');
    }

    
}
