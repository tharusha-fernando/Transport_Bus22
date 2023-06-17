<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory,HasUuids;

    protected $fillable=['trip_id','user_id','details'];

    public function Trip(){
        return $this->hasOne(Trip::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
    
}
