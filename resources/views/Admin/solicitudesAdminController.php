<?php

namespace App\Http\Controllers;
use App\solicitudeproceso;
use App\usuconfomulario;
use App\user;
use App\usuconformulario;
use App\estructura;
use App\proyecto;
use App\zoho;
use App\empresa;
use App\seguimiento;
use App\solicituddocumento;
use Mail;
use App\Mail\NotificacionSolicitudObservada;
use App\Mail\NotificacionSolicitudLiberada;
use App\Exports\SolicitudesExport;
use Illuminate\Http\Request;
use Alert;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ZohoExport;


class solicitudesAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $tipo="Admin";
    public $enviada="Enviada";
    public $liberada="Liberada";
    public $aprobada="Aprobada";
    public $asignada="Asignada";
    public $declaracion="Declaracion";
    public $comentario;
    public $cero=0;
    public $leyenda="Solicitud Ingresada por Primera Vez";
    public $mail;
    public $fechaActual;

    // zoho
    public $nombreMandante;
    public $rutMandante;
    public $nombreInspector;
    public $nombreContratista;
    public $rutContratista;
    public $contratista_id;
    public $proyecto_id;
    public $proyecto;
    public $contrato;
    

    public function index()
    {
        
        $solicitudes=solicitudeproceso::where('inspector_id',NULL)->where('estado',$this->enviada)->orWhere('estado',$this->declaracion)->where('inspector_id',NULL)->get();
        $primerEnvio=seguimiento::where('comentario',$this->leyenda)->get();
        
        return view('Admin.solicitudesNuevas',compact('solicitudes','primerEnvio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        
        


        $solicitud=solicitudeproceso::where('id',$id)->get();
        foreach($solicitud as $usuconformid){
            $this->usuconform_id = $usuconformid->usuconformulario_id;
        }

        $usufor=usuconformulario::where('id',$this->usuconform_id)->get();
       
        foreach($usufor as $formulario){
            $this->tipoFormulario = $formulario->formulario;
        }

      

        $inspectores=user::where('Tipo',$this->tipo)->get();
        $solicitud=solicitudeproceso::where('id',$id)->get();
        $documentos=solicituddocumento::where('solicitudeproceso_id',$id)->get();

            if ($this->tipoFormulario==1){
                    return view('Admin.edicionAsignacionSolicitud',compact('solicitud','inspectores','documentos'));
            }elseif($this->tipoFormulario==2){
                return view('Admin.edicionAsignacionSolicitudDocumentos',compact('solicitud','inspectores','documentos'));
            }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $solicitud = solicitudeproceso::where('id',$id)->get();
        foreach($solicitud as $usuario_id){
            $usuario=user::where('id',$usuario_id->user_id)->get();
                foreach($usuario as $mail_usuario){
                    $this->mail=$mail_usuario->email;
                }
        }
        //dd($request);
        $user = auth()->User()->id;
         //bitacora de asignada



         if($request->estado=='Asignada'){
             if ($request->observaciones!="")
                $this->comentario="Solicitud Asignada"."- Observaci??n:??".$request->observaciones;
            else
                $this->comentario="Solicitud Asignada".$request->observaciones;
                seguimiento::create([
                    'solicitudeproceso_id'=>$id,
                    'comentario'=>$this->comentario,
                    'user_id'=>$user,
                    'inspector_id'=>$user,
                 ]);
                 $this->fechaActual= new \DateTime();
                 $act=solicitudeproceso::where('id',$id)->update(['inspector_id'=>$request->inspector_id,'estado'=>$request->estado,'observaciones'=>$request->observaciones,'fechaAsignacion'=>$this->fechaActual]);
                 
                 $zohoUpdate=zoho::where('id_solicitud',$id)->update(['ejecutivo'=>$request->inspector_id,'estado'=>$request->estado]);
         }
         // fin bitacora
         //bitacora de asignada
        //  if($request->estadoNuevo=='Declaracion'){
        //     if ($request->observaciones!="")
        //        $this->comentario="Solicitud de Declaraci??n Jurada Asignada"."- Observaci??n:??".$request->observaciones;
        //    else
        //        $this->comentario="Solicitud de Declaraci??n Jurada Asignada".$request->observaciones;
        //     seguimiento::create([
        //         'solicitudeproceso_id'=>$id,
        //         'comentario'=>$this->comentario,
        //         'user_id'=>$user,
        //         'inspector_id'=>$user,
        //         ]);
        // }
        // fin bitacora
          //bitacora de asignada
          if($request->estado=='Rechazada'){
            $this->comentario="Solicitud Observada"."- Observaci??n:??".$request->observaciones;
            seguimiento::create([
                'solicitudeproceso_id'=>$id,
                'comentario'=>$this->comentario,
                'user_id'=>$user,
                'inspector_id'=>$user,
            ]);
            
            $act=solicitudeproceso::where('id',$id)->update(['inspector_id'=>$request->inspector_id,'estado'=>$request->estado,'observaciones'=>$request->observaciones]);
            $actZoho=zoho::where('id_solicitud',$id)->update(['ejecutivo'=>$request->inspector_id,'estado'=>$request->estado]);
    
            Mail::to($this->mail)->send(new NotificacionSolicitudObservada($id));
         
        }
        // fin bitacora
        
        
        //$id->update($request->all());
        // if($request->estado!='Declaracion'){
        //     $act=solicitudeproceso::where('id',$id)->update(['inspector_id'=>$request->inspector_id,'estado'=>$request->estado,'observaciones'=>$request->observaciones]);
        // }else{
        //     $act=solicitudeproceso::where('id',$id)->update(['inspector_id'=>$request->inspector_id]); //'estado'=>$request->estado,'observaciones'=>$request->observaciones
        // }

        $primerEnvio=seguimiento::where('comentario',$this->leyenda)->get();
        $solicitudes=solicitudeproceso::where('inspector_id',NULL)->where('estado','Enviada')->get();
        Alert::success('Solicitud Procesada Correctamente');
        return view('Admin.solicitudesNuevas',compact('solicitudes','primerEnvio'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function Aprobar(){
        $solicitudes=solicitudeproceso::where('certificado','!=',0)->where('estado',$this->aprobada)->get();
       
        return view('Admin.solicitudesxAprobar',compact('solicitudes'));
    }

    public function ApruebaCertificado($id){

        // $solicitud = solicitudeproceso::where('id',$id)->get();
        // foreach($solicitud as $usuario_id){
        //     $usuario=user::where('id',$usuario_id->user_id)->get();
        //         foreach($usuario as $mail_usuario){
        //             $this->mail=$mail_usuario->email;
        //         }
        // }

        // Mail::to($this->mail)->send(new NotificacionSolicitudLiberada($id));

         //bitacora de Reenv??o por rechazo
        
         $this->comentario="Aprobada";
         seguimiento::create([
             'solicitudeproceso_id'=>$id,
             'comentario'=>$this->comentario,
             'user_id'=>1,
             'inspector_id'=>1,
             ]);
         // fin bitacora

        $act=solicitudeproceso::where('id',$id)->update(['estado'=>$this->liberada]);
        $actZoho=zoho::where('id_solicitud',$id)->update(['estado'=>$this->liberada]);

        
        return;
        
        

    }

    public function Liberadas(){

      
        $this->estado="Liberada";
        $solicitudesNuevas=solicitudeproceso::where('estado',$this->estado)->get();
        $primerEnvio=seguimiento::where('comentario',$this->leyenda)->get();
        return view('Admin.solicitudesFinalizadasLiberadas',compact('solicitudesNuevas','primerEnvio'));
    }

    public function ccolpxfechasForm(){
        return view('Admin.ccolpxfechas');
    }

    public function ccolpxfechasReporte(request $request){

        $users=user::where('Tipo',$this->tipo)->get();
        //$primerEnvio=seguimiento::where('comentario',$this->leyenda)->get();
        $solicitudes=solicitudeproceso::wheredate('fechaEnvio',">=",$request->fechai)->wheredate('fechaEnvio',"<=",$request->fechaf)->get();
        return view('Admin.ccolpExcel',compact('solicitudes')); //,'primerEnvio'
        //return (new SolicitudesExport($request->fechai,$request->fechaf))->download('invoices.xlsx');
    }

    public function reasignaSolicitud(){
        $inspectores=user::where('Tipo',$this->tipo)->get();
        return view('Admin.reasignarSolicitudes',compact('inspectores'));
    }

    public function reasignarSolicitudstore(Request $request){
        $buscar=solicitudeproceso::where('id',$request->solicitud_id)->get();
        foreach($buscar as $solicitud){
             $this->comentario=$solicitud->id;
        }
           
        

        if(empty($this->comentario)){
            Alert::error('N??mero de Solicitud no Existe');
        }else{
            $act=solicitudeproceso::where('id',$request->solicitud_id)->update(['inspector_id'=>$request->inspector_id]);
            $actZoho=zoho::where('id_solicitud',$request->solicitud_id)->update(['ejecutivo'=>$request->inspector_id]);

            $this->comentario="Solicitud Reasignada al Nuevo Inspector";
            seguimiento::create([
                'solicitudeproceso_id'=>$request->solicitud_id,
                'comentario'=>$this->comentario,
                'user_id'=>1,
                'inspector_id'=>$request->inspector_id,
            ]);

            Alert::success('Solicitud Reasignada con Exito');
        }
        
        $inspectores=user::where('Tipo',$this->tipo)->get();
        return view('Admin.reasignarSolicitudes',compact('inspectores'));
    }

    public function RechazaCertificado($id){

       
         //bitacora de Reenv??o por rechazo
        
         $this->comentario="En Revisi??n";
         seguimiento::create([
             'solicitudeproceso_id'=>$id,
             'comentario'=>$this->comentario,
             'user_id'=>1,
             'inspector_id'=>1,
             ]);
         // fin bitacora

        $act=solicitudeproceso::where('id',$id)->update(['estado'=>$this->asignada,'certificado'=>$this->cero]);
        $actZoho=zoho::where('id_solicitud',$id)->update(['estado'=>$this->asignada,'certificado'=>$this->cero]);
        
        return;
        
        

    }

    public function zoho(){
        //return response()->download(public_path('/Archivos/zoho/excel.xlsx'));
        return Excel::download(new ZohoExport, 'excel.xlsx');
    }

    public function zohovolcado(){
        //$solicitudes=solicitudeproceso::all();
        $solicitudes=solicitudeproceso::where('id',">=",201)->where('id',"<=",20000)->get();

        foreach($solicitudes as $solicitud){

            $estructura=estructura::where('id',$solicitud->estructura_id)->get();

                foreach($estructura as $contratista){
                    $this->contratista_id=$contratista->empresa_id;
                     $empresas=empresa::where('id',$this->contratista_id)->get();
                            foreach($empresas as $datoContratista){
                                $this->nombreContratista=$datoContratista->nombre;
                                $this->rutContratista=$datoContratista->rut;

                            
                                $this->proyecto_id=$contratista->proyecto_id;
                                $this->contrato=$contratista->contrato;

                       
                               
                                
                                    $datoProyecto=proyecto::where('id',$this->proyecto_id)->get();
                                        foreach($datoProyecto as $datoMandante){
                                                $this->proyecto=$datoMandante->proyecto;
                                                $this->mandante_id=$datoMandante->empresa_id;
                                                    $mandantes=empresa::where('id',$this->mandante_id)->get();
                                                        foreach($mandantes as $mandante){
                                                            $this->nombreMandante=$mandante->nombre;
                                                            $this->rutMandante=$mandante->rut;

                                                        }
                                        }

                            }

                }
                $inspector=User::where('id',$solicitud->ejecutivo_id)->get();
                    foreach($inspector as $inspectorAsignado){
                        $this->nombreInspector=$inspectorAsignado->name;
                    }
            

            $periodo=$solicitud->mes."/".$solicitud->ano;
                    $zoho=zoho::create([
                        'id_solicitud'=>$solicitud->id,                                     //
                        'razon_mandante'=>$this->nombreMandante,                                  //
                        'rut_mandante'=>$this->rutMandante,                                       //
                        'obra'=>$this->proyecto,                                                  //
                        'razon_contratista'=>$this->nombreContratista,                            //
                        'rut_contratista'=>$this->rutContratista,                                 //
                        'periodo_ccolp'=>$periodo,                                          //
                        'periodo_a_ccolp_mes'=>0,                                           //
                        'n_trabajadores_certificar'=>$solicitud->contratados,               //
                        'contrato'=>$this->contrato,                                              //
                        'servicio_contratista'=>0,                                          //
                        'contacto_nombre'=>'N/D',                                           //
                        'contacto_telefono'=>'N/D',                                         //
                        'contacto_email'=>'N/D',                                            //
                        'estado'=>$solicitud->estado,                                       //
                        'fecha_recepcion'=>$solicitud->fechaEnvio,                          //
                        'fecha_emision'=>0,                                                 //
                        'ejecutivo'=>$this->nombreInspector,                                      //
                        'n_certificado'=>$solicitud->certificado,                           //
                        'factura'=>0,                                                       //
                        'pagado'=>0,                                                        //
                        'dias_habiles'=>0,                                                  //
            
                    ]);

                        
        }
        return "ok";
    }
}
