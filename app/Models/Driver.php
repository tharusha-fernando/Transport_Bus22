<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

class Driver extends Model
{
    use HasFactory, HasUuids;



    use Sluggable;
    protected $fillable = ['name', 'nic', 'dob', 'reg_number', 'slug','user_id'];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

   



    public function BusStation()
    {
        return $this->belongsToMany(BusStation::class, 'bus_station_driver', 'driver_id', 'bus_station_id');
    }

    public function Doc()
    {
        return $this->belongsToMany(Doc::class, 'driver_docs', 'driver_id', 'doc_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function age():Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) =>  $attributes['dob']
        );
    }
}
