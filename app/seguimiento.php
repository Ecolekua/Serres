<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seguimiento extends Model
{
    protected $fillable = [
        'solicitudeproceso_id','comentario','user_id','inspector_id',
    ];

    public function solicitudeproceso(){
        return $this->belongsTo(solicitudeproceso::class);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }
}
