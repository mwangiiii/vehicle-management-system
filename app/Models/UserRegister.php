<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwneIt\Auditing\Contract\Auditable;

class UserRegister extends Model
{
       use \OwenIt\Auditing\Auditable;
       protected $table = 'user_registers';
}



