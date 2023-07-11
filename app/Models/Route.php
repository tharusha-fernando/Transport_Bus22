<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory,HasUuids;
    use Sluggable;
    protected $fillable=['number','name','from','to','distance','time','slug'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'number'
            ]
        ];
    }

    public function BusStation(){
        return $this->belongsToMany(BusStation::class,'route_station','route_id','bus_station_id');
    }

    public function Trip(){
        return $this->hasMany(Trip::class);
    }
}
