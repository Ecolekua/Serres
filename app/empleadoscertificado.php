<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class empleadoscertificado extends Model
{
    protected $fillable = [
        'certificado_id', 'Empleado_id','rut','nombre','cargo', 'fechaRetiro', 'estado','pivote','comparacion','totalHaberes','totalImponibles','liquidoPago','contingenciaPrevisional','contingenciaRemuneracional','contingenciaContrato','contingenciaFiniquito','hojaNomina','nacionalidad','genero','diasTrabajados','numeroLocal'

    ];

    public function certificado(){
        return $this->belongsTo(certificado::class)->orderBy('estado');
    }
}
