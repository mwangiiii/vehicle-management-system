<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMake extends Model
{
    protected $table = 'vehicle_makes';
    protected $fillable = [
        'type', 
    ];

    public function modell()
    {
        return $this->hasMany(Modell::class);
    }


    public function vehicle(){
        return $this->has(vehicle::class);
    }

    
}
