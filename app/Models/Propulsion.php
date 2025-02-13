<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class Propulsion extends Model implements Auditable

{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'propulsions';

    protected $fillable = ['type'];

    public function vehicles()
    {
        return $this->hasOne(Vehicle::class);
    }
}
