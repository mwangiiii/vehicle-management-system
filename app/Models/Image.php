<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Image extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table='vehicle_images';
    protected $fillable =[
        'image_path',
        'vehicle_id'
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
