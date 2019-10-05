<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $table='empleados';
    protected $fillable=['cargo_id','priape','segape','prinom','segnom','correo','celular'];

   
}
