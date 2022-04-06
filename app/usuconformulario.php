<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuconformulario extends Model
{
    protected $fillable = [
        'estructura_id','periodoFin', 'proyecto_id', 'activo','pivote','User_id','periodoInicio','formulario','verCertificado',
    ];
  
    public function user(){
        return $this->belongsTo(user::class);
    }

    public function estructura(){
        return $this->belongsTo(estructura::class);
    }

    public function scopeUser_id($query, $user_id){
        if($user_id)
           return $query->where('user_id',$user_id);

    }
    

}
