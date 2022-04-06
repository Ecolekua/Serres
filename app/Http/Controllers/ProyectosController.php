<?php

namespace App\Http\Controllers;
use App\empresa;
use App\proyecto;
use App\comuna;
use Alert;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $pivote;
    public $campo;
    public $activo=1;
    public $contratista="Contratista";
    public function index()
    {
        $empresas = empresa::where('tipoEmpresa','!=',$this->contratista)->get();
        
        return view('Proyectos.index',compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emp='Empresa Principal';
        $mix='Mixto';
        $val = 1;
        $comunas=comuna::all();
        $empresas = Empresa::Where('tipoEmpresa',$emp)->orWhere('tipoEmpresa',$mix)->orderBy('nombre', 'ASC')->get();
        return view('Proyectos.create',compact('empresas','val','comunas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // proyecto::create($request->all());
        $this->pivote=$request['empresa_id']."-".$request['proyecto'];

        $busqueda=proyecto::where('pivote',$this->pivote)->get();
        foreach($busqueda as $resultado){
            $this->campo = $resultado->pivote;
        }

        if (empty($this->campo)){
            proyecto::create([
            'pivote'=>$request['empresa_id']."-".$request['proyecto'],
            'empresa_id'=>$request['empresa_id'],
            'proyecto'=>$request['proyecto'],
            // 'fechaInicio'=>$request['fechaInicio'],
            'direccion'=>$request['direccion'],
            'contacto'=>$request['contacto'],
            'email'=>$request['email'],
            'telefono'=>$request['telefono'],
            'comuna'=>$request['comuna'],
            'activo'=>$this->activo,
            ]);
            Alert::success('Proyecto Creado y Asignado con Exito');
            return redirect()->route('proyectos.create');
        }else{
            Alert::error('Proyecto ya existe en el Mandante');
            return redirect()->route('proyectos.create'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa=empresa::where('id',$id)->get();
        $proyectos=proyecto::where('empresa_id',$id)->get();
        return view('Proyectos.show',compact('empresa','proyectos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empresa=empresa::where('id',$id)->get();
        $proyectos=proyecto::where('empresa_id',$id)->get();
        return view('Proyectos.edit',compact('empresa','proyectos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, proyecto $proyecto)
    {
        $proyecto->update($request->all());
        
        Alert::success('Proyecto Actualizado con Exito');
        return redirect()->route('proyectos.edit',$proyecto->id);
    }

    /**
     * Remove the specified resource from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Alert::error('aca');
    }
}
