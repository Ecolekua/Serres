<?php

namespace App\Http\Controllers;
use App\user;
use App\empresa;
use App\estructura;
use App\usuconformulario;
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
    public function index()
    {
        $usuconfor = usuconformulario::orderBy('id', 'ASC')->get();
        return view('UsuContForm.index',compact('usuconfor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contratistas =estructura::all(); //estructura::paginate(2)
        $usuarios=user::where('tipo',$this->tipo)->get();
        return view('UsuContForm.create',compact('usuarios','contratistas'));
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
        // $this->fechasInicio = $request->input("fechaInicio");
        // $this->fechasFin = $request->input("fechaFin");
        $this->formularios = $request->input("formulario");
        $this->ruts = $request->input("rut");
        
        foreach($this->estructuras_id = $request->input("estructura_id") as $estructura)
        { 
            //dd($this->estructuras_id[15]);
            $this->pivote=$this->estructuras_id[$this->c]."-".$this->contratos[$this->c]."-".$this->usuarios_id."-".$this->formularios[$this->c];
            
            
            $this->estructura=$this->estructuras_id[$this->c];
            $this->contrato=$this->contratos[$this->c];
            // $this->fechaInicio=$this->fechasInicio[$this->c];
            // $this->fechaFin=$this->fechasFin[$this->c];
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
        $id->update($request->all());
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
}
