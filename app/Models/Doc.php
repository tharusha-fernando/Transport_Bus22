<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    use HasFactory,HasUuids;
    protected $fillable=['name','description','type','link'];

    public function Bus(){
        return $this->belongsToMany(Bus::class,'table_bus_doc','doc_id','bus_id');
    }

    public function Driver(){
        return $this->belongsToMany(Driver::class,'driver_docs','doc_id','driver_id');
    }
}
