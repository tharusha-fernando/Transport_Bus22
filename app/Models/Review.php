<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    use HasUuids;
    
    protected $fillable=['user_id','trip_id','subject','description','type','rating'];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Trip(){
        return $this->belongsTo(Trip::class);
    }
}
