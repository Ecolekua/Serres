<?php
namespace App\Imports;

use App\empresa;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmpresasImport implements ToCollection
{
    public $pass;
    public function collection(Collection $rows)
    {
       
        foreach ($rows as $fila => $valor) 
        {
          if(!empty($valor[0])){
              empresa::create([
                  'rut' => $valor[0],
                  'nombre' => $valor[1],
                  
                  'direccion' => $valor[2],
                  'comuna' => $valor[3],
                  'email' => $valor[4],
                  'telefonos' => $valor[5],
                  'tipoEmpresa' => $valor[6],
                  'nomContacto' => $valor[7],
                  'fonContacto' => $valor[8],
                  'emailContacto' => $valor[9],
              ]);

          }
        }
        return;
    }
}