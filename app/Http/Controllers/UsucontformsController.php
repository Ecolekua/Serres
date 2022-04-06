<?php

namespace App\Http\Controllers;
use App\user;
use App\empresa;
use App\estructura;
use App\usuconformulario;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Alert;
class UsucontformsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $tipo="Cliente";
    public $con="Contratista";
    public $c=0;
    public $pivote = array();
    public $activo=1;
    public $ep="Empresa Principal";
    public $m="Mixto";
  
    public function index(request $user_id)
    {
        //$usuconfor = usuconformulario::orderBy('id', 'ASC')->get();
        //$usuconfor = usuconformulario::paginate(1000);
        $usuconfor= usuconformulario::where('user_id',$user_id->user_id)->paginate(1000);
        $users=user::all();
        $contratos = estructura::all();
        return view('UsuContForm.index',compact('usuconfor','users','contratos'));
    }

    public function busqueda(request $user_id)
    {
        //$usuconfor = usuconformulario::orderBy('id', 'ASC')->get();
        //$usuconfor = usuconformulario::paginate(1000);
        if($user_id->user_id!=0){
            $usuconfor = usuconformulario::where('user_id',$user_id->user_id)->paginate(1000);
            $users=user::all();
            $contratos = estructura::all();
        }else{
            $usuconfor = usuconformulario::where('estructura_id',$user_id->contrato_id)->paginate(1000);
            $users=user::all();
            $contratos = estructura::all();
        }
        //dd($usuconfor);
        return view('UsuContForm.index',compact('usuconfor','users','contratos'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $contratistas =estructura::all(); //estructura::paginate(2)
         $usuarios=user::where('tipo',$this->tipo)->get();
        // return view('UsuContForm.create',compact('usuarios','contratistas'));

        $empresas = empresa::select('id','rut','nombre')->where('tipoEmpresa',$this->ep)->orWhere('tipoEmpresa',$this->m)->orderBy('nombre', 'ASC')->get();
        $contratistas = empresa::select('id','rut','nombre')->where('tipoEmpresa',$this->con)->orWhere('tipoEmpresa',$this->m)->get();
        return view('UsuContForm.create', compact('empresas','contratistas','usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
 
        $this->usuarios_id = $request->input("user_id");
        $this->estructura = $request->input("estructura_id");
        $this->contratos = $request->input("contrato");
        $this->formularios = $request->input("formulario");
        $this->ruts = $request->input("rut");
        
        foreach($this->estructuras_id = $request->input("estructura_id") as $estructura)
        { 
         
            $this->pivote=$this->estructuras_id[$this->c]."-".$this->contratos[$this->c]."-".$this->usuarios_id."-".$this->formularios[$this->c];
            
            
            $this->estructura=$this->estructuras_id[$this->c];
            $this->contrato=$this->contratos[$this->c];
            $this->formulario=$this->formularios[$this->c];
            $this->usuario = $this->usuarios_id;
           
            if($this->formulario!="") //$this->fechaInicio!="" && $this->fechaFin!="" && 
            {
          
                    $busqueda=usuconformulario::where('pivote',$this->pivote)->get();
        
                    if (count($busqueda)==0){

                        usuconformulario::create([
                                'estructura_id'=>$this->estructura,
                                
                                // 'periodoInicio'=>$this->fechaInicio,
                                // 'periodoFin'=>$this->fechaFin,
                                'formulario'=>$this->formulario,
                                'activo'=>$this->activo,
                                'pivote'=>$this->pivote,
                                'User_id'=>$this->usuario,
                            ]);
                                // $this->asignados++;
                         
                    }else{
                        
                        Alert::error(' Usuario ya asignado...');
                        $usuarios=user::where('tipo',$this->tipo)->get();
                        $contratistas = estructura::all();
                        return view('UsuContForm.create',compact('contratistas','usuarios'));
                         
                    }
            }else{
                if($this->formulario!="" ){ //|| $this->fechaInicio!="" || $this->fechaFin!="" 
                $this->vacios[$this->v]=$this->rut;
                $this->c++;
                $this->v++;
                }
            }
            $this->c++;
            
        }

        // $ing=$this->asignados;
        // $vac = $this->vacios;
        Alert::success('Contratistas Asignados al Usuario con Exito...');
        $contratistas = estructura::all();
        $usuarios=user::where('tipo',$this->tipo)->get();
        return view('UsuContForm.create',compact('contratistas','usuarios'));
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ids)
    {
       
        
        $id=usuconformulario::where('id',$ids)->get();
        return view('UsuContForm.edit',compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usuconformulario $id)
    {
        //dd($request);
        $id->update($request->all());
        $estructuras=usuconformulario::where('id',$request->id)->get();
        //dd($estructuras);
        foreach($estructuras as $estructura){
            //dd($estructura->estructura_id);
            $update=estructura::where('id',$estructura->estructura_id)->update(['certificadoVisible'=>$request->verCertificado]);
        }
        Alert::success(' Actualizado con Exito...');
        $id=usuconformulario::where('id',$id)->get();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borrar=usuconformulario::where('id',$id)->delete();
        return ;
    }

    public function empresasxproyecto($proyecto_id){
        
        $estructuras=estructura::with('empresa','proyecto')->select('id','empresa_id','proyecto_id','contrato')->where('proyecto_id',$proyecto_id)->get();
        return $estructuras;
    }

    public function asignaestructurausuario(request $request){

        $this->usuario = $request->input("usuario_id");
        $this->estructuras_id = $request->input("estructurasseleccionadas");
        $this->formularios = $request->input("formularios");
        $this->activo=1;
        if ($this->formularios==1){
            foreach($this->estructuras_id as $estructura)
            { 
                $busquedaContrato=estructura::where('id',$estructura)->get();
                    foreach($busquedaContrato as $estructuracontrato){
                        $this->contratos=$estructuracontrato->contrato;
                    }
                        $this->pivote=$estructura."-".$this->contratos."-".$this->usuario."-".$this->formularios;
                        $busqueda=usuconformulario::where('pivote',$this->pivote)->get();
        
                        if (count($busqueda)==0){

                            usuconformulario::create([
                                    'estructura_id'=>$estructura,
                                    'formulario'=>$this->formularios,
                                    'activo'=>$this->activo,
                                    'pivote'=>$this->pivote,
                                    'User_id'=>$this->usuario,
                                ]);
                             
                            
                        }
            }
        }

        if ($this->formularios==2){
            foreach($this->estructuras_id as $estructura)
            { 
                $busquedaContrato=estructura::where('id',$estructura)->get();
                    foreach($busquedaContrato as $estructuracontrato){
                        $this->contratos=$estructuracontrato->contrato;
                    }
                        $this->pivote=$estructura."-".$this->contratos."-".$this->usuario."-".$this->formularios;
                        $busqueda=usuconformulario::where('pivote',$this->pivote)->get();
        
                        if (count($busqueda)==0){

                            usuconformulario::create([
                                    'estructura_id'=>$estructura,
                                    'formulario'=>$this->formularios,
                                    'activo'=>$this->activo,
                                    'pivote'=>$this->pivote,
                                    'User_id'=>$this->usuario,
                                ]);
                             
                            
                        }
            }
        }

        if ($this->formularios==3){
            foreach($this->estructuras_id as $estructura)
            { 
                $busquedaContrato=estructura::where('id',$estructura)->get();
                    foreach($busquedaContrato as $estructuracontrato){
                        $this->contratos=$estructuracontrato->contrato;
                    }
                        $this->pivote=$estructura."-".$this->contratos."-".$this->usuario."-"."1";
                        $busqueda=usuconformulario::where('pivote',$this->pivote)->get();
        
                        if (count($busqueda)==0){

                            usuconformulario::create([
                                    'estructura_id'=>$estructura,
                                    'formulario'=>1,
                                    'activo'=>$this->activo,
                                    'pivote'=>$this->pivote,
                                    'User_id'=>$this->usuario,
                                ]);
                        }

                        $this->pivote=$estructura."-".$this->contratos."-".$this->usuario."-"."2";
                        $busqueda=usuconformulario::where('pivote',$this->pivote)->get();
        
                        if (count($busqueda)==0){

                            usuconformulario::create([
                                    'estructura_id'=>$estructura,
                                    'formulario'=>2,
                                    'activo'=>$this->activo,
                                    'pivote'=>$this->pivote,
                                    'User_id'=>$this->usuario,
                                ]);
                        }
            }
        }

        // for,mulario covid //
        if ($this->formularios==4){
            foreach($this->estructuras_id as $estructura)
            { 
                $busquedaContrato=estructura::where('id',$estructura)->get();
                    foreach($busquedaContrato as $estructuracontrato){
                        $this->contratos=$estructuracontrato->contrato;
                    }
                        $this->pivote=$estructura."-".$this->contratos."-".$this->usuario."-".$this->formularios;
                        $busqueda=usuconformulario::where('pivote',$this->pivote)->get();
        
                        if (count($busqueda)==0){

                            usuconformulario::create([
                                    'estructura_id'=>$estructura,
                                    'formulario'=>$this->formularios,
                                    'activo'=>$this->activo,
                                    'pivote'=>$this->pivote,
                                    'User_id'=>$this->usuario,
                                ]);
                             
                            
                        }
            }
        }

        // fin formulario covid //
        $usuarios=user::where('tipo',$this->tipo)->get();
        $empresas = empresa::select('id','rut','nombre')->where('tipoEmpresa',$this->ep)->orWhere('tipoEmpresa',$this->m)->orderBy('nombre', 'ASC')->get();
        $contratistas = empresa::select('id','rut','nombre')->where('tipoEmpresa',$this->con)->orWhere('tipoEmpresa',$this->m)->get();
        Alert::success(' Proceso de Asignación Finalizado...');
        return view('UsuContForm.create', compact('empresas','contratistas','usuarios'));
            
    }

    public function clonacionperfiles($usuarioActual,$usuarioDestino){

        $perfiles=usuconformulario::where('user_id',$usuarioActual)->get();
            foreach($perfiles as $perfil){
                $this->pivote=$perfil->estructura_id."-".$perfil->estructura->contrato."-".$usuarioDestino."-".$perfil->formulario;
                $busqPivote=usuconformulario::where('pivote',$this->pivote)->get();
                    if (count($busqPivote)==0){
                        usuconformulario::create([
                            'estructura_id'=>$perfil->estructura_id,
                            'formulario'=>$perfil->formulario,
                            'activo'=>$this->activo,
                            'pivote'=>$this->pivote,
                            'User_id'=>$usuarioDestino,
                        ]);
                    
                    }

            }
            return 1;

    }
}