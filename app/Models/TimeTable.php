<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory,HasUuids;

    protected $fillable=['name','description','bus_station_id'];

    public function BusStation(){
        return $this->belongsTo(BusStation::class);
    }
}
