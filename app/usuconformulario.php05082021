<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuconformulario extends Model
{
    protected $fillable = [
        'estructura_id','periodoFin', 'proyecto_id', 'activo','pivote','User_id','periodoInicio','formulario',
    ];
  
    public function user(){
        return $this->belongsTo(user::class);
    }

    public function estructura(){
        return $this->belongsTo(estructura::class);
    }
}
