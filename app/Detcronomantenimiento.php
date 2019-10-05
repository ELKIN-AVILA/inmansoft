<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detcronomantenimiento extends Model
{
    protected $table='detcronomantenimiento';
    protected $fillable=['cronomantenimiento_id','sede_id ','departamentos_id','dependencias_id','jefedependencia_id','fechaini','fechafin','estado','numequipo'];
}
