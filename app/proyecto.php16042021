<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proyecto extends Model
{
    protected $fillable = [
        'empresa_id','proyecto','fechaInicio','direccion','activo','fechatermino','pivote','contacto','email','telefono','comuna',
    ];
    
    public function empresa(){
        return $this->belongsTo(empresa::class);
    }
}
