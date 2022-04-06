<?php
namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    public $pass;
    public function collection(Collection $rows)
    {
       
        foreach ($rows as $fila => $valor) 
        {
          if(!empty($valor[0])){
              user::create([
                  'name' => $valor[0],
                  'email' => $valor[1],
                  'password' => Hash::make($valor[2]),
                  'Tipo' => $valor[3],
              ]);

          }
        }
        return;
    }
}