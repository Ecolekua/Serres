<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $fillable = [
        'rut', 'nombre', 'direccion', 'comuna', 'email','telefonos','giro','rutRepLeg','nomRepLeg','tipoEmpresa','nomContacto','fonContacto','emailContacto','mutualidad','especialidad','djuradas',
    ];
}
// fuena de funcionamiento
