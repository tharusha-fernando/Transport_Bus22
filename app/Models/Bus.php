<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bus extends Model
{
    use HasFactory;
    protected $fillable=['license_plate','model','capacity','owner_name'];

    public function BusStation(){
        return $this->belongsToMany(BusStation::class,'bus_bus_station','bus_id','bus_station_id');
    }

    
    public function Doc(){
        return $this->belongsToMany(Doc::class,'table_bus_doc','bus_id','doc_id');
    }
}