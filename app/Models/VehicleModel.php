<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    protected $table='vehicle_models';
    protected $fillable =[
        'make_id',
        'type'
    ];
    
    public function make(){
        return $this->belongsTo(VehicleMake::class);
    }

    public function vehicle(){
        return $this->hasMany(Vehicle::class); 
       }

    public function image(){
        return $this->hasMany(Image::class, 'vehicle_id'); 
    }
}
