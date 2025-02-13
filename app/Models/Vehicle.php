<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Vehicle extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'vehicles';

    protected $fillable = [
        'model_id',
        'colour',
        'numberplate',
        // 'image',
        'make_id',
        'manufacturer_id',
        'propulsion_id',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function propulsion()
    {
        return $this->belongsTo(Propulsion::class); 
    }

    public function make(){
        return $this->belongsTo(VehicleMake::class);
    }

    public function vehicleModel(){
        return $this->belongsTo(VehicleModel::class,'model_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    

    
    // public function manufacturer()
    // {
    //     return $this->belongsTo(Manufacturer::class);
    // }
}
