<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Locale;

class Booking extends Model
{
    use HasFactory,HasUuids;
    use Sluggable;

    protected $fillable=['trip_id','user_id','details','start','end','amount','seat_numbers','price','asasasa'];




    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'user_id'
            ]
        ];
    }
    public function Trip(){
        return $this->belongsTo(Trip::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Start(){
        return $this->belongsTo(Location::class,'start');
    }

    public function End(){
        return $this->belongsTo(Location::class,'end');
    }
    
}
