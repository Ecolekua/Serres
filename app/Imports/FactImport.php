<?php
namespace App\Imports;

use App\solicitudeproceso;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Alert;

class FactImport implements ToCollection
{
   public $matriz= array();
   public $pos=0;
    public function collection(Collection $rows)
    {
       
        foreach ($rows as $fila => $valor) 
        {
            if(!empty($valor[0])){

                $busqueda=solicitudeproceso::where('certificado',$valor[0])->get();
                if ($busqueda==NULL){
                    $this->matriz[$this->pos]=$valor[0];
                    $this->pos++;
                    
                }else{
                    $act=solicitudeproceso::where('certificado',$valor[0])->update(['nfactura'=>$valor[1]]);
                  
                }
            }
        
        }   
            return json_encode($this->pos);
     
    }
}