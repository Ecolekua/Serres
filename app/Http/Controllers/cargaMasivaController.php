<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\FactImport;
use App\Imports\EmpresasImport;
use App\Imports\ExcelEmpleadosCertificado;
use App\solicitudeproceso;
use App\seguimiento;
use App\solicituddocumento;
use Alert;
use App\certificado;
use Validator;
class cargaMasivaController extends Controller
{
    



   public $resultado=array(); 
   Public $estado="Asignada";
   public $declaracion="Declaracion";
   public $solicitud_id;
   public $load;
   public $id;
   public function cargamasivausuarios(){
        return view('Admin.cargamasivausuarios');
    }

    public function importUser(Request $requestTrabajador){
        
       
            Excel::import(new UsersImport, $requestTrabajador->excel);
            
                
        
        Alert::success('Usuarios Cargados');
        return view('Admin.cargamasivausuarios');
        
    }

    public function ImportJobs(Request $requestTrabajador){
        
            
            auth()->User()->paso=$requestTrabajador->solicitud_id;
           
        

        $planillaExcel=Excel::import(new ExcelEmpleadosCertificado, $requestTrabajador->excel);
        
        
        
    
        //Alert::success('planilla leida');
       
        $ncertificado = auth()->User()->paso;
        $certificado=certificado::where('id',$ncertificado)->get();
        return view('Inspector.certificado',compact('certificado'));
    
}

    public function cargamasivaempresas(){
        return view('Admin.cargamasivaempresas');
    }

    public function importEmpresas(Request $requestEmpresa){

        Excel::import(new EmpresasImport, $requestEmpresa->excel);

        Alert::success('Empresas Cargados');
        return view('Admin.cargamasivaempresas');
    }

    public function cargamasivafacturas(){
        return view('Admin.cargamasivafacturas');
    }

    public function importFact(Request $requestTrabajador){
        
       $validator=Validator::make($requestTrabajador->all(),['excel'=>'required|mimes:xls,xlsx'
       ]);

        if ($validator->passes()){

        }else{
            Alert::error('Solo se admiten formatos xls y xlsx');
            return view('Admin.cargamasivafacturas');
        }

        $import=Excel::import(new FactImport, $requestTrabajador->excel);

       //dd('Row count: ' . $import->getRowCount()); 
   
    //    public function getRowCount(): int
    //    {
    //        return $this->numRows;
    //    }
   //dd($requestTrabajador->excel);
    Alert::success('Números de Facturas Cargados');
        return view('Admin.cargamasivafacturas');
    
}


}