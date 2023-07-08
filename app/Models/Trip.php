<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory,HasUuids;
    use Sluggable;
    protected $fillable=['time_table_id','bus_id','type','details',
    'location_id','start','end','route_id',
    'distance','status','from','to'];

    public function sluggable(): array
    {
        
        return [
            'slug' => [
                'source' => ['start','created_at']
            ]
        ];
    }


    public function TimeTable(){
        return $this->belongsTo(TimeTable::class);
    }

    public function Bus(){
        return $this->belongsTo(Bus::class);
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

    public function BusStation(){
        return $this->belongsToMany(BusStation::class,'bus_station_trip','trip_id','bus_station_id');
    }

    public function Location(){
        return $this->belongsTo(Location::class);
    }
}
