<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['name','description'];

    public function User(){
        return $this->belongsToMany(User::class,'thread_user','thread_id','user_id')->withTimestamps();
    }

    public function Message(){
        return $this->hasMany(Message::class);
    }
}
