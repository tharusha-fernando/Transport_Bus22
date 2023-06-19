<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory,HasUuids;



    use Sluggable;
    protected $fillable=['name','nic','age','dob','reg_number','slug'];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }



    public function BusStation(){
        return $this->belongsToMany(BusStation::class,'bus_station_driver','driver_id','bus_station_id');
    }

    public function Doc(){
        return $this->belongsToMany(Doc::class,'driver_docs','driver_id','doc_id');
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    
}
