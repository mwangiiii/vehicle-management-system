<?php


namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements Auditable
{

    use HasFactory; 
    use \OwenIt\Auditing\Auditable;
    protected $table='categories';

    protected $fillable=[
        'name'
    ];
    
    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }

}
