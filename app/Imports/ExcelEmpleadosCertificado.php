<?php

namespace App\Imports;

use App\certificado;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\solicitudeproceso;
use Alert;
class ExcelEmpleadosCertificado implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public $mes;
    public $anio;
    public $estructura_id;
    public $responsableInspeccion_id;
    public $nmes;
    
    public function collection(Collection $rows)
    {
        
       
        
        $solicitudeproceso=solicitudeproceso::where('id',auth()->User()->paso)->get();
            foreach($solicitudeproceso as $datosSolicitud){
                $this->mes=$datosSolicitud->mes;
                $this->anio=$datosSolicitud->ano;
                $this->estructura_id=$datosSolicitud->estructura_id;
                $this->responsableInspeccion_id=$datosSolicitud->inspector_id;
            }
        $certificado=certificado::create([
            'estructura_id'=>$this->estructura_id,
            'mes'=>$this->mes,
            'nmes'=>$this->mes,
            'anio'=>$this->anio,
            'solicitud_id'=>auth()->User()->paso,
            'obs1'=>'-',
            'obs2'=>'-',
            'obs3'=>'-',
            'obs4'=>'-',
            'segundaNomina'=>'N',
            'contratoVisible'=>'N',
            'nominaExtendida'=>'N',
            'totalRevizados'=>0,
            'dotacionFinal'=>0,
            'responsableInspeccion_id'=>$this->responsableInspeccion_id,
            'pivote'=>'pivote-temporal'.'-'.$this->estructura_id.'-'.$this->mes.'-'.$this->anio,
        ]);


        
        //  foreach ($rows as $fila => $valor) 
        //  {
        //    if(!empty($valor[0])){
        //        dd($valor[0]);
        //       user::create([
        //           'name' => $valor[0],
        //           'email' => $valor[1],
        //           'password' => Hash::make($valor[2]),
        //           'Tipo' => $valor[3],
        //       ]);

        //    }
        //  }

         
        auth()->User()->paso=$certificado->id;
        
       
    }
}
