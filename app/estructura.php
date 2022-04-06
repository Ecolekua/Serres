<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class estructura extends Model
{
    protected $fillable = [
        'empresa_id', 'contrato', 'fechaInicio', 'activo', 'pivote','fechaCierre','User_id','proyecto_id','contratistasubcontrato_id',
    ];

    public function empresa(){
        return $this->belongsTo(empresa::class);
    }

    public function proyecto(){
        return $this->belongsTo(proyecto::class);
    }

    public function contratistasubcontrato()
    {
        return $this->belongsTo(empresa::class);
    }

    public function certificado(){
        return $this->hasMany(estructura::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }

}
