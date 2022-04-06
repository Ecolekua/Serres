<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class certificado extends Model
{
    protected $fillable = [
        'id','estructura_id','mes','nmes','anio','obs1','obs2','obs3','obs4','segundaNomina','contratoVisible','nominaExtendida','totalRevizados','dotacionFinal','responsableInspeccion_id','solicitud_id','pivote','retirosFiniquitos','empleadoNuevos','empleadosMesAnterior','vistoContrato','vistoFiniquito','vistoSueldo','vistoPrevision','estado','abreviacion','montoRemuneracional','montoPrevisional',
        
    ];

    public function estructura(){
        return $this->belongsTo(estructura::class);
    }

    public function empleadoscertificado(){
        return $this->hasMany(empleadoscertificado::class);
    }
    
    public function solicitud(){
        return $this->belongsTo(solicitudeproceso::class);
    }
   
}
