<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cronomantenimiento extends Model
{
    protected $table='cronomantenimientos';
    protected $fillable=['id','nombre','usuarios_id','fecha'];
}
