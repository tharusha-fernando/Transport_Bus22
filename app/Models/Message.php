<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable=['message','status','attachment','read_at','user_id','thread_id'];

    public function Thread(){
        return $this->belongsTo(Thread::class);
    }


}
