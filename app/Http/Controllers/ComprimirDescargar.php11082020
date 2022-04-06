<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zipper;
use App\solicituddocumento;
use App\solicitudeproceso;

class ComprimirDescargar extends Controller
{
    public $archivos = array();
    public $ano;
    public $num = 0;
    public function comprimirD($id){

        $archivos=solicituddocumento::where('solicitudeproceso_id',$id)->get();
        $ano=solicitudeproceso::where('id',$id)->get();
        foreach($ano as $dato){
            $this->ano = $dato->ano;
        }
        foreach($archivos as $archivo){
            $this->archivos[$this->num] = glob(public_path('archivos/'.$this->ano.'/'.$archivo->documento));
            $this->num++;
        }
        
            $files = $this->archivos;
          
          Zipper::make(storage_path('public/comprimidos/ArchivosComprimidos'.$id.'.zip'))->add($files)->close();
          
         
          return response()->download(storage_path('public/comprimidos/ArchivosComprimidos'.$id.'.zip'));

          unlink(storage_path('public/comprimidos/ArchivosComprimidos'.$id.'.zip'));//Destruye el archivo temporal
          
    }
}
