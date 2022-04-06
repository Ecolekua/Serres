<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class solicituddocumento extends Model
{
    protected $fillable = [
        'solicitudeproceso_id','documento','estado','orden','observaciones','tipodocumento',
    ];

    public function solicitudeproceso(){
        return $this->belongsTo(solicitudeproceso::class);
    }
}
