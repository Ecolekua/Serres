<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empresa extends Model
{
    protected $fillable = [
        'rut', 'nombre', 'direccion', 'comuna', 'email','telefonos','giro','rutRepLeg','nomRepLeg','tipoEmpresa','nomContacto','fonContacto','emailContacto','mutualidad','especialidad','djuradas','holding',
    ];
}
