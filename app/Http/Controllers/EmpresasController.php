<?php

namespace App\Http\Controllers;

use App\empresa;
use Illuminate\Http\Request;
use App\comuna;
use Alert;
class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $datoEmpresa=array();
    public $f,$c;
    public $rut;

    public function index()
    {
        $empresas = empresa::all();
        return view('Empresas.index',compact('empresas'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comunas=comuna::all();
        $comu=comuna::all();
        $empresa=0;
        $empresa=comuna::all();
        return view('Empresas.create',compact('comunas','comu','empresa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $busqueda=empresa::where('rut',$request->rut)->get();
        foreach($busqueda as $dato){
            $this->rut=$dato->rut;
            //dd($this->rut);
        }
        if(empty($this->rut))
        {
            $empresa=empresa::create($request->all());
            Alert::success('Empresa Guardada con Exito');
            $comunas=comuna::all();
            return view('Empresas.create',compact('comunas'));
        }else{
            Alert::error('Empresa ya Existe...');
            $comunas=comuna::all();
            return view('Empresas.create',compact('comunas'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show($empresa)
    {
        $empresa=empresa::where('id',$empresa)->get();
        return view('Empresas.show',compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit(empresa $empresa)
    {
        $comunas=comuna::all();
        $comu = comuna::pluck('comuna', 'comuna')->toArray();
        return view('Empresas.edit',compact('empresa','comunas','comu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, empresa $empresa)
    {
        

        $empresa->update($request->all());
        
        Alert::success('Empresa Actualizada con Exito');
        return redirect()->route('empresas.edit',$empresa->id);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy(empresa $empresas)
    {
        //
    }

    public function RecuperaDatosEmpresa($rut){
        
        $empresa=empresa::where('rut',$rut)->get();
        return compact('empresa');  
       
     
         
    }

    public function listaCsharp(){
        return empresa::all();
    }
}
