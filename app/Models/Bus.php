<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bus extends Model
{
    use HasFactory,HasUuids;
    use Sluggable;
    protected $fillable=['license_plate','model','capacity','owner_name','slug','driver_id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'license_plate'
            ]
        ];
    }

    public function BusStation(){
        return $this->belongsToMany(BusStation::class,'bus_bus_station','bus_id','bus_station_id');
    }

    
    public function Doc(){
        return $this->belongsToMany(Doc::class,'table_bus_doc','bus_id','doc_id');
    }

    public function Driver(){
        return $this->belongsTo(Driver::class);
    }


}
