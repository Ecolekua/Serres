<?php

namespace App\Http\Controllers;
use App\solicitudeproceso;
use App\usuconfomulario;
use App\User;
use App\usuconformulario;
use App\estructura;
use App\proyecto;
use App\certificado;
use App\zoho;
use App\certificadoserresve;
use App\empresa;
use App\documento;
use App\seguimiento;
use App\solicituddocumento;
use App\planillacertificado;
use App\empleadoscertificado;
use Mail;
use App\Mail\NotificacionSolicitudObservada;
use App\Mail\NotificacionSolicitudLiberada;
use App\Exports\SolicitudesExport;
use Illuminate\Http\Request;
use Alert;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Exports\ZohoExport;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Conner\Tagging\Model\Tag;
use Conner\Tagging\Model\Tagged;
use Conner\Tagging\Model\TagGroup;
use App\Imports\EmpleadosCertificadoImport;

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
    public $estadoFinal;
    public $nombreContacto;
    public $telefonoContacto;
    public $fechaActual;
    public $nomInspector;
    public $nombreCertificado;
    public $est;
    public $estado;
    // zoho

    public $asigna_enrevision="EN REVISION";
    public $rechazada_conobservaciones="CON OBSERVACIONES";
    public $liberada_certificado="CERTIFICADO";
    
    public $firma="Solicitud Enviada a Firma";
    public $mensajeFirma;
    public $SolicitudObservada="Solicitud Observada";
    public $alias;
    public $nombreMandante;
    public $rutMandante;
    public $nombreInspector;
    public $nombreContratista;
    public $rutContratista;
    public $contratista_id;
    public $proyecto_id;
    public $proyecto;
    public $contrato;
    public $ncert;
    public $control_doc_trab;
    public $control_doc_emp;
    public $evaluacion_fin;
    public $otra_observacion;
    public $n_solicitud;
    public $tipo_fecha;
    public $estado_anulada="Anulada";
    public $pivoteModificado;
    public $pivoteyestado;
    public $tipo_solicitud;
    public $Rechazada="Rechazada";
    public $fila=1;
    public $colu=0;
    public $vacio;
    public $matrizTgas=array();
    public $rutaArchivoBorrar;
    public $nomInspectorZ;
    public $estadoActualizado;
    public $solicitudid;
    public $inspectorid;
    public $cont=0;
    public function index()
    {
        
        //$solicitudes=solicitudeproceso::where('inspector_id',NULL)->where('estado',$this->enviada)->orWhere('estado',$this->declaracion)->where('inspector_id',NULL)->get();
        //$primerEnvio=seguimiento::where('comentario',$this->leyenda)->get();
        $solicitudes=solicitudeproceso::with('solicituddocumento')->where('estado',$this->enviada)->orWhere('estado',$this->declaracion)->where('inspector_id',NULL)->get();
        $inspectores=user::where('Tipo','Admin')->get();
        return view('Admin.solicitudesNuevas',compact('solicitudes','inspectores')); //,'primerEnvio'
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
                 $inspectorNombre=User::where('id',$request->inspector_id)->get();
                 foreach($inspectorNombre as $inspector){
                     $this->nomInspector=$inspector->name;
                 }
                 
                 $zohoUpdate=zoho::where('id_solicitud',$id)->update(['ejecutivo'=>$this->nomInspector,'estado'=>$this->asigna_enrevision,'marcaultimocambio'=>$this->fechaActual]);
         }
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
            $inspectorNombre=User::where('id',$request->inspector_id)->get();
            foreach($inspectorNombre as $inspector){
                $this->nomInspector=$inspector->name;
            }
            $actZoho=zoho::where('id_solicitud',$id)->update(['ejecutivo'=>$this->nomInspector,'estado'=>$this->rechazada_conobservaciones,'marcaultimocambio'=>$this->fechaActual]);
    
            Mail::to($this->mail)->send(new NotificacionSolicitudObservada($id));
         
        }
        // fin bitacora
        
        
        //$id->update($request->all());
        // if($request->estado!='Declaracion'){
        //     $act=solicitudeproceso::where('id',$id)->update(['inspector_id'=>$request->inspector_id,'estado'=>$request->estado,'observaciones'=>$request->observaciones]);
        // }else{
        //     $act=solicitudeproceso::where('id',$id)->update(['inspector_id'=>$request->inspector_id]); //'estado'=>$request->estado,'observaciones'=>$request->observaciones
        // }
            ///este parte es de update
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
        return "ok";
    }

    public function Aprobar(){
        $solicitudes=solicitudeproceso::where('certificado','!=','')->where('estado',$this->aprobada)->get();
       
        return view('Admin.solicitudesxAprobar',compact('solicitudes'));
    }

    public function ApruebaCertificado($id,$nfact){

      
        
         $this->comentario="Aprobada";
         seguimiento::create([
             'solicitudeproceso_id'=>$id,
             'comentario'=>$this->comentario,
             'user_id'=>1,
             'inspector_id'=>1,
             ]);
         // fin bitacora
            //numero de solicitud asignada una vez liberada
            $solicitudNumero=solicitudeproceso::where('id',$id)->get();
            foreach($solicitudNumero as $ncertificado){
                $this->ncert = $ncertificado->certificado;
                $this->n_solicitud=$ncertificado->certificado;
                $this->tipo_fecha=$ncertificado->ano;
            }
            $this->fechaActual= new \DateTime();
            
            if ( $this->n_solicitud==10){
                $this->liberada_certificado="SIN MOVIMIENTO";
                if ($this->tipo_fecha==NULL){
                    $this->liberada_certificado="AUDITADO";
                }
                $actZoho=zoho::where('id_solicitud',$id)->update(['estado'=>$this->liberada_certificado,'n_certificado'=>null,'fecha_emision'=>$this->fechaActual,'factura'=>$nfact,'marcaultimocambio'=>$this->fechaActual]);
                $act=solicitudeproceso::where('id',$id)->update(['estado'=>$this->liberada,'nfactura'=>$nfact]);
            }else{

                $actZoho=zoho::where('id_solicitud',$id)->update(['estado'=>$this->liberada_certificado,'n_certificado'=>$this->ncert,'fecha_emision'=>$this->fechaActual,'factura'=>$nfact,'marcaultimocambio'=>$this->fechaActual]);
                $act=solicitudeproceso::where('id',$id)->update(['estado'=>$this->liberada,'nfactura'=>$nfact]);
            }
        
        
        return;
        
        

    }

    
    public function liberadasFecha(){
        return view('Admin.LiberadasxFecha');
    }
    
    public function resultadolliberadasxfecha(request $request){

      
        $this->estado="Liberada";
        
        $solicitudesNuevas=solicitudeproceso::with('solicituddocumento')->where('estado',$this->estado)->wheredate('fechaEnvio',">=",$request->fechai)->wheredate('fechaEnvio',"<=",$request->fechaf)->get();
        
        return view('Admin.solicitudesFinalizadasLiberadas',compact('solicitudesNuevas'));
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
            $inspectorNombre=User::where('id',$request->inspector_id)->get();
            foreach($inspectorNombre as $inspector){
                $this->nomInspector=$inspector->name;


            }
            $actZoho=zoho::where('id_solicitud',$request->solicitud_id)->update(['ejecutivo'=>$this->nomInspector]); // no se marca el cambio por reasignaci??n de inspector

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

    public function RechazaCertificado($id,$obs){

       
         //bitacora de Reenv??o por rechazo
        
         $this->comentario="En Revisi??n";
         seguimiento::create([
             'solicitudeproceso_id'=>$id,
             'comentario'=>$this->comentario,
             'user_id'=>1,
             'inspector_id'=>1,
             ]);
         // fin bitacora

         $act=solicitudeproceso::where('id',$id)->update(['estado'=>$this->Rechazada,'certificado'=>$this->cero,'observacionRechazo'=>$obs]);
         
         return;
         zoho::where('id_solicitud',$id)->update(['estado'=>$this->asigna_enrevision,'certificado'=>$this->cero,'marcaultimocambio'=>$this->fechaActual]);
        
        

    }

    public function zoho(){
      
    return Excel::download(new ZohoExport, 'excel.xlsx');



    }

    
    public function zohovolcado(){
        //$solicitudes=solicitudeproceso::all();
        //$solicitudes=solicitudeproceso::where('id',">=",100000)->where('id',"<=",200000)->get();

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
                                                            $this->alias=$mandante->mutualidad;
                                                        }
                                        }

                            }

                }
                $inspector=User::where('id',$solicitud->inspector_id)->get();
                    foreach($inspector as $inspectorAsignado){
                        $this->nombreInspector=$inspectorAsignado->name;
                    }
            
          if($solicitud->estado=='Rechazada'){
               $obs=seguimiento::where('solicitudeproceso_id',$solicitud->id)->where('comentario', "like", "%" . $this->SolicitudObservada . "%")->take(1)->get();
                foreach($obs as $comen){
                    $this->mensajeFirma=$comen->comentario;
            }
          }else{
            $this->mensajeFirma="";
          }
           
           
            $periodo=$solicitud->ano."-".$solicitud->mes."-01";

            if ($periodo=='--01'){
                $solicitud->fechaEnvio=$solicitud->created_at;
            }


            $this->fechaActual= new \DateTime();
            if ($solicitud->estado=="Liberada"){
                $zoho=zoho::create([
                    'mandante'=>$this->alias,
                    'id_solicitud'=>$solicitud->id,                                     //
                    'razon_mandante'=>$this->nombreMandante,                                  //
                    'rut_mandante'=>$this->rutMandante,                                       //
                    'obra'=>$this->proyecto,                                                  //
                    'razon_contratista'=>$this->nombreContratista,                            //
                    'rut_contratista'=>$this->rutContratista,                                 //
                    'periodo_ccolp'=>$periodo,                                          //
                    'periodo_a_ccolp_mes'=>0,                                           //
                    'n_trabajadores_certificar'=>$solicitud->totalvigentes,               //
                    'contrato'=>$this->contrato,                                              //
                    //'servicio_contratista'=>0,                                          //
                    'contacto_nombre'=>'N/D',                                           //
                    'contacto_telefono'=>'N/D',                                         //
                    'contacto_email'=>'N/D',                                            //
                    'estado'=>$solicitud->estado,                                       //
                    'fecha_recepcion'=>$solicitud->fechaEnvio,                          //
                    'fecha_emision'=>$solicitud->updated_at,                                                 //
                    'ejecutivo'=>$this->nombreInspector,                                      //
                    'n_certificado'=>$solicitud->certificado,                           //
                    'factura'=>0,                                                       //
                    'pagado'=>0,                                                        //
                    'dias_habiles'=>0,       
                    'observacion'=>$this->mensajeFirma,                                           //
                 
                    'otraobservacion'=>$solicitud->otraopcion,
                    'marcaultimocambio'=>$this->fechaActual,
                ]);
            }else{ 
           // no liberada $periodo=$solicitud->ano."-".$solicitud->mes."-01";
                    $zoho=zoho::create([
                        'mandante'=>$this->alias,
                        'id_solicitud'=>$solicitud->id,                                     //
                        'razon_mandante'=>$this->nombreMandante,                                  //
                        'rut_mandante'=>$this->rutMandante,                                       //
                        'obra'=>$this->proyecto,                                                  //
                        'razon_contratista'=>$this->nombreContratista,                            //
                        'rut_contratista'=>$this->rutContratista,                                 //
                        'periodo_ccolp'=>$periodo,                                          //
                        'periodo_a_ccolp_mes'=>0,                                           //
                        'n_trabajadores_certificar'=>$solicitud->totalvigentes,               //
                        'contrato'=>$this->contrato,                                              //
                        //'servicio_contratista'=>0,                                          //
                        'contacto_nombre'=>'N/D',                                           //
                        'contacto_telefono'=>'N/D',                                         //
                        'contacto_email'=>'N/D',                                            //
                        'estado'=>$solicitud->estado,                                       //
                        'fecha_recepcion'=>$solicitud->fechaEnvio,                          //
                        'fecha_emision'=>"",                                                 //
                        'ejecutivo'=>$this->nombreInspector,                                      //
                        'n_certificado'=>"",                           //
                        'factura'=>0,                                                       //
                        'pagado'=>0,                                                        //
                        'dias_habiles'=>0,       
                        'observacion'=>$this->mensajeFirma,                                           //
                        'otraobservacion'=>$solicitud->otroobser,
                        'marcaultimocambio'=>$this->fechaActual,
                    ]);
            // fin sin certificado                
            }          
        }
        return "ok";
    }

    public function busquedasolicitudes(){
        return view('Admin.buscadorsolicitudesadmin');
    }

    public function eliminaolicitudes(){
        return view('Admin.eliminadorsolicitudesadmin');
    }

    public function resultadobusquedaadmin(Request $request){
        $solicitudesEnviadas=solicitudeproceso::where('id',$request->solicitud_id)->get();
        foreach($solicitudesEnviadas as $solicitudes){
            $this->resp=$solicitudes->id;
        }
        if (empty($this->resp)){
            Alert::error('N?? de Solicitud no Existe');
            return view('Admin.buscadorsolicitudesadmin');
        }else{
            return view('Admin.resultadobusquedaadmin',compact('solicitudesEnviadas'));
        }
    }

    public function eliminabusquedaadmin(Request $request){
          
        $solicitudesEnviadas=solicitudeproceso::where('id',$request->solicitud_id)->get();
         
        foreach($solicitudesEnviadas as $solicitudes){
            $this->resp=$solicitudes->id;
        }
        if (empty($this->resp)){
            Alert::error('N?? de Solicitud no Existe');
            return view('Admin.eliminadorsolicitudesadmin');
        }else{
            $eliminasdocumentos=solicituddocumento::where('solicitudeproceso_id',$request->solicitud_id)->delete();
            $eliminaseguimiento=seguimiento::where('solicitudeproceso_id',$request->solicitud_id)->delete();
            $eliminarsolicitud=solicitudeproceso::where('id',$request->solicitud_id)->delete();
            $eliminarsolicitudzoho=zoho::where('id_solicitud',$request->solicitud_id)->delete();
            Alert::success('Solicitud Eliminada Correctamente');
            return view('Admin.eliminadorsolicitudesadmin',compact('solicitudesEnviadas'));
        }
    }

    public function solicitudesAdminShow($id){
        $solicitud=solicitudeproceso::where('id',$id)->get();
        foreach($solicitud as $usuconformid){
            $this->usuconform_id = $usuconformid->usuconformulario_id;
        }

         $usufor=usuconformulario::where('id',$this->usuconform_id)->get();
       
        foreach($usufor as $formulario){
            $this->tipoFormulario = $formulario->formulario;
        }

        $documentos=solicituddocumento::where('solicitudeproceso_id',$id)->get();

        if ($this->tipoFormulario==1){
            return view('Admin.solicitudAdminShow',compact('solicitud','documentos'));

        }elseif($this->tipoFormulario==2){
            return view('Admin.solicitudDocumentosAdminShow',compact('solicitud','documentos'));
        }




    }

    public function solicitudAnular(request $request){

        $verifica=solicitudeproceso::where('id',$request->solicitud_id)->get();
       // dd($verifica);
        foreach($verifica as $solicitud){
            if($solicitud->estado=='Anulada'){
                Alert::error('Solicitud ya se encuentra Anulada');
                return view('Admin.eliminadorsolicitudesadmin');
            }
        }

        $pivoteOriginal=solicitudeproceso::where('id',$request->solicitud_id)->get();
        foreach($pivoteOriginal as $pivote){
            $this->pivoteModificado=$pivote->pivote.'***'.$pivote->estado;
        }
        $act=solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>$this->estado_anulada,'pivote'=>$this->pivoteModificado]);
        $eliminarsolicitud=zoho::where('id_solicitud',$request->solicitud_id)->delete();
        Alert::success('Solicitud Anulada Correctamente');
        return view('Admin.eliminadorsolicitudesadmin');
    }

    public function solicitudesAnuladas(){
        $solicitudes=solicitudeproceso::where('estado',$this->estado_anulada)->get();
       
        return view('Admin.solicitudesAnuladas',compact('solicitudes'));
    }

    public function restauraSolicitud($id){

        $pivoteCambiado=solicitudeproceso::where('id',$id)->get();
        foreach($pivoteCambiado as $solicitud){
            $this->pivoteModificado=explode('***',$solicitud->pivote);
            $this->pivoteyestado=explode('***',$solicitud->pivote);
            $this->pivoteModificado=$this->pivoteModificado[0];
           
            $solicitudExisteNueva=solicitudeproceso::where('pivote',$this->pivoteModificado)->get();
     
            if (count($solicitudExisteNueva)>0){
               
                    return 0;
            }else{
                   
                    
                    $act=solicitudeproceso::where('id',$id)->update(['estado'=>$this->pivoteyestado[1],'pivote'=>$this->pivoteyestado[0]]);
                    //return $act->id;

                    //reposici??n en Zoho
                     $SolicitudFinal=solicitudeproceso::where('id',$id)->get();

                    foreach($SolicitudFinal as $solicitud){
                        $periodo=$solicitud->ano."-".$solicitud->mes."-01";
                        if ($periodo=='--01'){
                             $this->tipo_solicitud='Formulario ??nico de Certificaci??n de Documentos';
                        }else{
                             $this->tipo_solicitud='Certificaci??n Laboral';
                        }
                        $user=user::where('id',$solicitud->user_id)->get();
                        
                        foreach($user as $usuarioD){
                            
                            $this->mail=$usuarioD->email;
                            $this->nombreContacto=$usuarioD->name;

                            if ($solicitud->estado=='Enviada'){
                                $this->estadoFinal='RECIBIDO';
                            }elseif($solicitud->estado=='Liberada'){
                                $this->estadoFinal='CERTIFICADO';
                            }elseif($solicitud->estado=='Rechazada'){
                                $this->estadoFinal='CON OBSERVACIONES';
                            }elseif($solicitud->estado=='Asignada'){
                                $this->estadoFinal='EN REVISION';
                            }

                         

                            $inspector=User::where('id',$solicitud->inspector_id)->get();
                                foreach($inspector as $inspectorNombre){
                                    $this->nomInspector=$inspectorNombre->name;
                                }


                            $zoho=zoho::create([
                                'mandante'=>$solicitud->estructura->proyecto->empresa->mutualidad,
                                'id_solicitud'=>$solicitud->id,
                                'razon_mandante'=>$solicitud->estructura->proyecto->empresa->nombre,
                                'rut_mandante'=>$solicitud->estructura->proyecto->empresa->rut,
                                'obra'=>$solicitud->estructura->proyecto->proyecto,
                                'razon_contratista'=>$solicitud->estructura->empresa->nombre,
                                'rut_contratista'=>$solicitud->estructura->empresa->rut,
                                'periodo_ccolp'=>$periodo,
                                'periodo_a_ccolp_mes'=>0,
                                'n_trabajadores_certificar'=>$solicitud->totalvigentes,
                                'contrato'=>$solicitud->estructura->contrato,

                                'contacto_nombre'=>$this->nombreContacto,
                                'contacto_telefono'=>'N/D',
                                'contacto_email'=>$this->mail,
                                'estado'=>$this->estadoFinal,
                                'fecha_emision'=>0,
                                'ejecutivo'=>$this->nomInspector,
                                'n_certificado'=>0,
                                'factura'=>0,
                                'pagado'=>0,
                                'dias_habiles'=>0,
                                'tipo_solicitud'=>$this->tipo_solicitud,
                                'marcaultimocambio'=>$this->fechaActual,
                            ]);

                            return 1;
                        }
                    }        
            }
                    // fin reposici??n en Zoho
        }
       
    }

    public function zoholaravel(){
        // LECTURA DEL ARCHIVO YA CREADO             
        //$inputFileName = 'Archivos/Zoho/Planilla Zoho.xlsx';

        /** Load $inputFileName to a Spreadsheet Object  **/
        //$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        


        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator("Aqu?? va el creador, como cadena")
            ->setLastModifiedBy('Parzibyte') // ??ltima vez modificado por
            ->setTitle('Mi primer documento creado con PhpSpreadSheet')
            ->setSubject('El asunto')
            ->setDescription('Este documento fue generado para parzibyte.me')
            ->setKeywords('etiquetas o palabras clave separadas por espacios')
            ->setCategory('La categor??a');

            $hoja = $documento->getActiveSheet();
            $hoja->setTitle("solicitudes Zoho");
            
            $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,'Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,'Id');
            $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'Raz??n Social Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,'Rut Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,'Obra');
            $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,'Raz??n Social Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,'Rut Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,'Per??odo CCOLP');
            $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,'Periodo a CCOLP Mes');
            $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,'N?? de Trabajadores a Certificar');
            $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,'N?? Contrato o Servicio Prestado Informa Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'Contacto Nombre');
            $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'Contacto Tel.');
            $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'Contacto Email');
            $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,'Estado Certificaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'Fecha Recepci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,'Fecha Emisi??n');
            $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'Ejecutivo Asignado');
            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'N?? Certificado');
            $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'N?? Factura');
            $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'Pagado Si/No');
            $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'D??as H??biles');
            $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'Observaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,'Tipo de Solicitud');
            $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,'Tipo de Documento');
            $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,'Observaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,'cantidad_reenvios');
            $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,'updated_at');
            $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,'marcaultimocambio');


            // $hoja->setCellValue("B2", "Este va en B2");
            // $hoja->setCellValue("A3", "Parzibyte");

            
            $zoho=zoho::whereYear('periodo_ccolp','>=',2020)->get();

            foreach($zoho as $dato){
                    $this->fila = $this->fila + 1;
                    $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,$dato->mandante);
                    $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,$dato->id_solicitud);
                    $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,$dato->razon_mandante);
                    $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,$dato->rut_mandante);//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+3,$f,$rr['rut_mandante']); //razon mandante
                
                    $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,$dato->obra);
                    $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,$dato->razon_contratista);
                    $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,$dato->rut_contratista);
                    if ($dato->periodo_ccolp!='--01')
                        $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$dato->periodo_ccolp);
                    else{
                        $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$this->vacio);
                    }
                    $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,$dato->periodo_a_ccolp_mes);
                    $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,$dato->n_trabajadores_certificar);
                    $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,$dato->contrato);
                    // $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,$dato->Contacto Nombre');
                    // $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,$dato->Contacto Tel.');
                    // $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,$dato->Contacto Email');
                    $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,strtoupper($dato->estado));
                    $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,$dato->fecha_recepcion);
                    if($dato->fecha_emision!=NULL){
                    
                        $solicitud=solicitudeproceso::where('id',$dato->id_solicitud)->get();
                        foreach($solicitud as $fechaUpdate){
                            $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,$fechaUpdate->updated_at);
                        }

                    }
                    

                    $solicitud=solicitudeproceso::where('id',$dato->id_solicitud)->get();
                    foreach($solicitud as $SD){
                        if ($SD->inspector_id==1652){
                                $this->nomInspectorZ='V3';
                                }elseif($SD->inspector_id==3){
                                    $this->nomInspectorZ='IZ';
                                }elseif($SD->inspector_id==1626){
                                    $this->nomInspectorZ='KS';
                                }elseif($SD->inspector_id==1627){
                                    $this->nomInspectorZ='JQ';
                                }elseif($SD->inspector_id==1628){
                                    $this->nomInspectorZ='LV';
                                }elseif($SD->inspector_id==1629){
                                    $this->nomInspectorZ='RM';
                                }elseif($SD->inspector_id==1630){
                                    $this->nomInspectorZ='YA';
                                }elseif($SD->inspector_id==1631){
                                    $this->nomInspectorZ='AQ';
                                }elseif($SD->inspector_id==1632){
                                    $this->nomInspectorZ='CG';
                                }elseif($SD->inspector_id==1633){
                                    $this->nomInspectorZ='MD';
                                }elseif($SD->inspector_id==1634){
                                    $this->nomInspectorZ='KM';
                                }elseif($SD->inspector_id==1635){
                                    $this->nomInspectorZ='VVL';
                                }elseif($SD->inspector_id==1669){
                                    $this->nomInspectorZ='Ricardo Jorquera';
                                }elseif($SD->inspector_id==1733){
                                    $this->nomInspectorZ='ricardo jorquera diaz';
                                }elseif($SD->inspector_id==1){
                                    $this->nomInspectorZ='AdministradorGeneral';
                                }elseif($SD->inspector_id==4){
                                    $this->nomInspectorZ='Vladimir Varas Vial';
                                }elseif($SD->inspector_id==6){
                                    $this->nomInspectorZ='Pedro Vargas';
                                }elseif($SD->inspector_id==1774){
                                    $this->nomInspectorZ='EE';
                                }elseif($SD->inspector_id==2083){
                                    $this->nomInspectorZ='CM';
                                }elseif($SD->inspector_id==1813){
                                    $this->nomInspectorZ='RO';
                                }elseif($SD->inspector_id==2267){
                                    $this->nomInspectorZ='PR';
                                }elseif($SD->inspector_id==2465){
                                    $this->nomInspectorZ='CMO';
                                }elseif($SD->inspector_id==2267){
                                    $this->nomInspectorZ='Prev-Riesgos1';
                                }elseif($SD->inspector_id==1822){
                                    $this->nomInspectorZ='Arturo Aros Queglas';
                                }elseif($SD->inspector_id==2142){
                                    $this->nomInspectorZ='AE';
                                }elseif($SD->inspector_id==2714){
                                    $this->nomInspectorZ='DP';
                                }elseif($SD->inspector_id==2218){
                                    $this->nomInspectorZ='typecode@typecode.cl';
                                }elseif($SD->inspector_id==2265){
                                    $this->nomInspectorZ='Marilu Miranda';
                                }elseif($SD->inspector_id==2163){
                                    $this->nomInspectorZ='CC';
                                }elseif($SD->inspector_id==2570){
                                    $this->nomInspectorZ='TC';
                                }elseif($SD->inspector_id==2686){
                                    $this->nomInspectorZ='AG';
                                }elseif($SD->inspector_id==2456){
                                    $this->nomInspectorZ='ADMINISTRATIVO 2';
                                }elseif($SD->inspector_id==2082){
                                    $this->nomInspectorZ='TypeCode SpA';
                                }elseif($SD->inspector_id==2945){
                                    $this->nomInspectorZ='DG';
                                }elseif($SD->inspector_id==2946){
                                    $this->nomInspectorZ='DS';
                                }
                        $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,strtoupper($this->nomInspectorZ));
                        if($SD->certificadoNombre==NULL){
                            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'??'.$dato->n_certificado);
                        }else{
                            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'??'.'C-'.$SD->certificadoNombre);
                        }
                    }

                    // $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,$dato->N?? Factura');
                    // $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,$dato->Pagado Si/No');
                    // $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,$dato->D??as H??biles');
                    $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,$dato->observacion);
                    $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,$dato->tipo_solicitud);
                    $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,$dato->tipo_documento);
                    $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,$dato->otraobservacion);
                    $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,$dato->cantidad_reenvios);
                    $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,$dato->updated_at);
                    $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,$dato->marcaultimocambio);
            }


        
        $nombreDelDocumento = "Planilla Zoho.xlsx";
        /**
         * Los siguientes encabezados son necesarios para que
         * el navegador entienda que no le estamos mandando
         * simple HTML
         * Por cierto: no hagas ning??n echo ni cosas de esas; es decir, no imprimas nada
         */
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($documento, 'Xlsx');
        $writer->save('php://output');
        exit;
        
    }

    public function zoholaravel2018(){
                 
        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator("Aqu?? va el creador, como cadena")
            ->setLastModifiedBy('Parzibyte') // ??ltima vez modificado por
            ->setTitle('Mi primer documento creado con PhpSpreadSheet')
            ->setSubject('El asunto')
            ->setDescription('Este documento fue generado para parzibyte.me')
            ->setKeywords('etiquetas o palabras clave separadas por espacios')
            ->setCategory('La categor??a');

            $hoja = $documento->getActiveSheet();
            $hoja->setTitle("solicitudes Zoho");
            
            $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,'Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,'Id');
            $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'Raz??n Social Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,'Rut Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,'Obra');
            $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,'Raz??n Social Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,'Rut Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,'Per??odo CCOLP');
            $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,'Periodo a CCOLP Mes');
            $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,'N?? de Trabajadores a Certificar');
            $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,'N?? Contrato o Servicio Prestado Informa Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'Contacto Nombre');
            $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'Contacto Tel.');
            $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'Contacto Email');
            $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,'Estado Certificaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'Fecha Recepci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,'Fecha Emisi??n');
            $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'Ejecutivo Asignado');
            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'N?? Certificado');
            $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'N?? Factura');
            $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'Pagado Si/No');
            $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'D??as H??biles');
            $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'Observaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,'Tipo de Solicitud');
            $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,'Tipo de Documento');
            $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,'Observaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,'cantidad_reenvios');
            $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,'updated_at');
            $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,'marcaultimocambio');


            // $hoja->setCellValue("B2", "Este va en B2");
            // $hoja->setCellValue("A3", "Parzibyte");

            
            $zoho=zoho::whereYear('periodo_ccolp','<=',2019)->get();

            foreach($zoho as $dato){
                    $this->fila = $this->fila + 1;
                    $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,$dato->mandante);
                    $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,$dato->id_solicitud);
                    $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,$dato->razon_mandante);
                    $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,$dato->rut_mandante);//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+3,$f,$rr['rut_mandante']); //razon mandante
                
                    $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,$dato->obra);
                    $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,$dato->razon_contratista);
                    $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,$dato->rut_contratista);
                    if ($dato->periodo_ccolp!='--01')
                        $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$dato->periodo_ccolp);
                    else{
                        $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$this->vacio);
                    }
                    $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,$dato->periodo_a_ccolp_mes);
                    $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,$dato->n_trabajadores_certificar);
                    $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,$dato->contrato);
                    // $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,$dato->Contacto Nombre');
                    // $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,$dato->Contacto Tel.');
                    // $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,$dato->Contacto Email');
                    $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,strtoupper($dato->estado));
                    $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,$dato->fecha_recepcion);
                    $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,$dato->fecha_emision);

                    $solicitud=solicitudeproceso::where('id',$dato->id_solicitud)->get();
                    foreach($solicitud as $SD){
                        if ($SD->inspector_id==1652){
                                $this->nomInspectorZ='V3';
                                }elseif($SD->inspector_id==3){
                                    $this->nomInspectorZ='IZ';
                                }elseif($SD->inspector_id==1626){
                                    $this->nomInspectorZ='KS';
                                }elseif($SD->inspector_id==1627){
                                    $this->nomInspectorZ='JQ';
                                }elseif($SD->inspector_id==1628){
                                    $this->nomInspectorZ='LV';
                                }elseif($SD->inspector_id==1629){
                                    $this->nomInspectorZ='RM';
                                }elseif($SD->inspector_id==1630){
                                    $this->nomInspectorZ='YA';
                                }elseif($SD->inspector_id==1631){
                                    $this->nomInspectorZ='AQ';
                                }elseif($SD->inspector_id==1632){
                                    $this->nomInspectorZ='CG';
                                }elseif($SD->inspector_id==1633){
                                    $this->nomInspectorZ='MD';
                                }elseif($SD->inspector_id==1634){
                                    $this->nomInspectorZ='KM';
                                }elseif($SD->inspector_id==1635){
                                    $this->nomInspectorZ='VVL';
                                }elseif($SD->inspector_id==1669){
                                    $this->nomInspectorZ='Ricardo Jorquera';
                                }elseif($SD->inspector_id==1733){
                                    $this->nomInspectorZ='ricardo jorquera diaz';
                                }elseif($SD->inspector_id==1){
                                    $this->nomInspectorZ='AdministradorGeneral';
                                }elseif($SD->inspector_id==4){
                                    $this->nomInspectorZ='Vladimir Varas Vial';
                                }elseif($SD->inspector_id==6){
                                    $this->nomInspectorZ='Pedro Vargas';
                                }elseif($SD->inspector_id==1774){
                                    $this->nomInspectorZ='EE';
                                }elseif($SD->inspector_id==2083){
                                    $this->nomInspectorZ='CM';
                                }elseif($SD->inspector_id==1813){
                                    $this->nomInspectorZ='RO';
                                }elseif($SD->inspector_id==2267){
                                    $this->nomInspectorZ='PR';
                                }elseif($SD->inspector_id==2465){
                                    $this->nomInspectorZ='CMO';
                                }elseif($SD->inspector_id==2267){
                                    $this->nomInspectorZ='Prev-Riesgos1';
                                }elseif($SD->inspector_id==1822){
                                    $this->nomInspectorZ='Arturo Aros Queglas';
                                }elseif($SD->inspector_id==2142){
                                    $this->nomInspectorZ='AE';
                                }elseif($SD->inspector_id==2714){
                                    $this->nomInspectorZ='DP';
                                }elseif($SD->inspector_id==2218){
                                    $this->nomInspectorZ='typecode@typecode.cl';
                                }elseif($SD->inspector_id==2265){
                                    $this->nomInspectorZ='Marilu Miranda';
                                }elseif($SD->inspector_id==2163){
                                    $this->nomInspectorZ='CC';
                                }elseif($SD->inspector_id==2570){
                                    $this->nomInspectorZ='TC';
                                }elseif($SD->inspector_id==2686){
                                    $this->nomInspectorZ='AG';
                                }elseif($SD->inspector_id==2456){
                                    $this->nomInspectorZ='ADMINISTRATIVO 2';
                                }elseif($SD->inspector_id==2082){
                                    $this->nomInspectorZ='TypeCode SpA';
                                }
                        $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,strtoupper($this->nomInspectorZ));
                        if($SD->certificadoNombre==NULL){
                            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'??'.$dato->n_certificado);
                        }else{
                            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'??'.'C-'.$SD->certificadoNombre);
                        }
                    }

                    // $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,$dato->N?? Factura');
                    // $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,$dato->Pagado Si/No');
                    // $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,$dato->D??as H??biles');
                    $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,$dato->observacion);
                    $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,$dato->tipo_solicitud);
                    $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,$dato->tipo_documento);
                    $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,$dato->otraobservacion);
                    $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,$dato->cantidad_reenvios);
                    $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,$dato->updated_at);
                    $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,$dato->marcaultimocambio);
            }


        
        $nombreDelDocumento = "Planilla Zoho.xlsx";
        /**
         * Los siguientes encabezados son necesarios para que
         * el navegador entienda que no le estamos mandando
         * simple HTML
         * Por cierto: no hagas ning??n echo ni cosas de esas; es decir, no imprimas nada
         */
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($documento, 'Xlsx');
        $writer->save('php://output');
        exit;
        
    }
    // zohoo serresvre
    public function zohoSerresve(){
                 
        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator("Aqu?? va el creador, como cadena")
            ->setLastModifiedBy('Parzibyte') // ??ltima vez modificado por
            ->setTitle('Mi primer documento creado con PhpSpreadSheet')
            ->setSubject('El asunto')
            ->setDescription('Este documento fue generado para parzibyte.me')
            ->setKeywords('etiquetas o palabras clave separadas por espacios')
            ->setCategory('La categor??a');

            $hoja = $documento->getActiveSheet();
            $hoja->setTitle("serres Zoho");
            
            $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,'Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,'Id');
            $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'Raz??n Social Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,'Rut Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,'Obra');
            $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,'Raz??n Social Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,'Rut Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,'Per??odo CCOLP');
            $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,'Periodo a CCOLP Mes');
            $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,'N?? de Trabajadores a Certificar');
            $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,'N?? Contrato o Servicio Prestado Informa Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'Contacto Nombre');
            $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'Contacto Tel.');
            $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'Contacto Email');
            $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,'Estado Certificaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'Fecha Recepci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,'Fecha Emisi??n');
            $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'Ejecutivo Asignado');
            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'N?? Certificado');
            $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'N?? Factura');
            $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'Pagado Si/No');
            $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'D??as H??biles');
            $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'Observaci??n');


            
            $zoho=certificado::all();
            //$zoho=certificado::where('anio','>',2020)->where('nmes','>',7)->get();
            //dd($zoho);
            foreach($zoho as $dato){
                    $this->fila = $this->fila + 1;
                    $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,$dato->estructura->proyecto->empresa->mutualidad);
                    //dd($dato->estructura->proyecto->empresa->mutualidad);
                    $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,$dato->solicitud_id);
                    
                    $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,$dato->estructura->proyecto->empresa->nombre);
                    $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,$dato->estructura->proyecto->empresa->rut);//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+3,$f,$rr['rut_mandante']); //razon mandante
                    //dd($dato->estructura->proyecto->empresa->nombre);
                    $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,$dato->estructura->proyecto->proyecto);
                    $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,$dato->estructura->empresa->nombre);
                    //dd($dato->estructura->empresa->nombre);
                    $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,$dato->estructura->empresa->rut);
                     
                    $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$dato->anio.'-'.$dato->mes.'-01');
               
                      
           
                    $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,$dato->mes);
                    $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,$dato->totalRevizados);
                    $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,$dato->estructura->contrato);
                    $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'N/D');//$dato->estructura->proyecto->empresa->nomContacto
                    //dd($dato->estructura->proyecto->empresa->nomContacto);
                    $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'N/D'); //$dato->estructura->proyecto->empresa->fonContacto
                    $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'N/D');//$dato->estructura->proyecto->empresa->emailContacto
                    
                    if($dato->estado=='Enviada a Firma')
                    {
                        $dato->estado='ENVIADO A FIRMA';
                        $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,strtoupper($dato->estado));  
                    }else{
                        $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,strtoupper($dato->estado));
                    }
                    
                    
                    $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'N/D'); 
                    $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,$dato->fechaEmision);
                    $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'N/D');
                    $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'C-'.$dato->id);
                    $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'0');
                    $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'');
                    $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'');
                    $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'');
                   
            }


        
        $nombreDelDocumento = "Planilla ZohoSerresve.xlsx";
        /**
         * Los siguientes encabezados son necesarios para que
         * el navegador entienda que no le estamos mandando
         * simple HTML
         * Por cierto: no hagas ning??n echo ni cosas de esas; es decir, no imprimas nada
         */
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($documento, 'Xlsx');
        $writer->save('php://output');
        exit;
        
    }


    //fin zoho serresve

    public function firmaCertificado(request $request){
        //dd($request);
        $user = auth()->User()->id;
        $this->fechaActual= new \DateTime();
        $act=solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>$this->liberada,'firma_id'=>$user]); //,'nfactura'=>$request->factura
        $actCertificado=certificado::where('id',$request->certificado_id)->update(['estado'=>$this->liberada_certificado,'firma_id'=>$user,'fechaEmision'=>$request->fEmision,'fechaInicioInspeccion'=>$request->fInicioInspeccion,'fechaFinInspeccion'=>$request->fTerminoInspeccion]);
        // $actZoho=zoho::where('id_solicitud',$request->solicitud_id)->update(['estado'=>$this->liberada_certificado,'n_certificado'=>null,'fecha_emision'=>$request->fEmision,'factura'=>$request->factura,'marcaultimocambio'=>$this->fechaActual,'FIRMA'=>$request->$user]);
        $actZoho=zoho::where('id_solicitud',$request->solicitud_id)->update(['estado'=>$this->liberada_certificado,'n_certificado'=>null,'fecha_emision'=>$this->fechaActual,'factura'=>$request->factura,'marcaultimocambio'=>$this->fechaActual,'FIRMA'=>$request->$user]);

        $actualizaPlanillaCertificado=planillacertificado::where('CERTIFICADO',$request->certificado_id)->update(['ESTADO'=>$this->liberada_certificado,'FIRMA'=>$user]);
        // // guardado del pdf
         //$certificado=certificado::with('empleadoscertificado')->where('id',$request->certificado_id)->get();
         //$certificado=certificado::with(['empleadoscertificado'=>function($query) {$query->orderBy('estado','desc');}])->where('id',$request->certificado_id)->get();
         $certificado=certificado::with(['empleadoscertificado'=>function($query) {$query->orderBy('estado','desc')->orderBy('nombre','asc');}])->where('id',$request->certificado_id)->get();

         $dompdf = App::make("dompdf.wrapper");
         $insp=solicitudeproceso::where('id',$request->solicitud_id)->get();
         foreach($insp as $solicitud){
             $this->est_id=$solicitud->estructura_id;
         }
         //glob(public_path('archivos/'.$this->ano.'/'.$archivo->documento))
         $this->nombreCertificado='CERT-'.$request->certificado_id.'-'.$request->mes.'-'.$request->anio.'-Solicitud-'.$request->solicitud_id;
         $dompdf->loadView("Certificados.certificadoFirmadoPDF",compact('certificado','insp'))->setPaper('letter')->save(public_path('Archivos/'.$request->anio.'/') .$this->nombreCertificado.'.pdf');
         $solicitudes=solicitudeproceso::where('certificado','!=','')->where('estado',$this->aprobada)->get();
         $destinationPath='Archivos/'.$request->anio.'/';
         $documentos=documento::create([
             'documento'=>$this->nombreCertificado.".pdf",
             'ubicacion'=>$destinationPath,
             'estructura_id'=>$this->est_id,
             //'mes'=>$request->mes,
             'anio'=>$request->anio,
             //'registro_id'=>$request->idRegistro,

         ]);
        $this->matrizTags=explode(',','CERTIFICACION LABORAL');
        $documentos->tag($this->matrizTags);

        $rutaAbsoluta=$destinationPath.$this->nombreCertificado.".pdf";
        $rutaCertificado=solicitudeproceso::where('id',$request->solicitud_id)->update(['certificadoRuta'=>$rutaAbsoluta]);
        Alert::success('Solicitud Liberada y Certificado Disponibilizado...');
        return view('Admin.solicitudesxAprobar',compact('solicitudes'));
        
    }

   public function eliminaCertificado(request $request){
        $deletePlanillaCertificado=planillacertificado::where('CERTIFICADO',$request->certificado_id)->delete();
        $deleteEmpleadosCertificado=empleadoscertificado::where('certificado_id',$request->certificado_id)->delete();
        $deleteCertificado=certificado::where('id',$request->certificado_id)->delete();
        
        $this->liberada="Asignada";
        $act=solicitudeproceso::where('certificadoNombre',$request->certificado_id)->update(['estado'=>$this->liberada,'firma_id'=>null, 'certificadoRuta'=>null,'certificadoNombre'=>null, 'certificado'=>'']); //,'nfactura'=>$request->factura

        $user = auth()->User()->id;
        $seguimiento=seguimiento::all();
        $this->estado="Asignada";
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->Orwhere('inspector_id',$user)->where('estado',$this->declaracion)->get();
        $solicitudesReenviadas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada','>',0)->get();
        $solicitudRechazadaFirma=solicitudeproceso::where('inspector_id',$user)->where('estado','=','Rechazada')->where('observacionRechazo','!=',NULL)->get();
        $solicitudDeclaracionesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->declaracion)->get();
        $actualizaSolicitud=solicitudeproceso::where('id',$request->solicitud_id)->update(['observacionRechazo'=>NULL]);
        return view('Inspector.index',compact('solicitudesNuevas','solicitudDeclaracionesNuevas','solicitudRechazadaFirma','solicitudesReenviadas','solicitudDeclaracionesNuevas'));
   }

   public function firmaCertificadoReemplazo(request $request){
    $user = auth()->User()->id;
    planillacertificado::where('CERTIFICADO',$request->certificadoReemplazo)->update(['ESTADO'=>'REEMPLAZADO']);

    $actualizaPlanillaCertificado=planillacertificado::where('CERTIFICADO',$request->certificado_id)->update(['ESTADO'=>$this->liberada_certificado,'FIRMA'=>$user]);
    certificado::where('id',$request->certificado_id)->update(['estado'=>'CERTIFICADO']);
    //dd($request);
    // cambio de estado certificado reemplazado
                $certificadoReemplazado=certificado::where('id',$request->certificadoReemplazo)->update(['estado'=>'REEMPLAZADO','abreviacion'=>$request->certificado_id,'pivote'=>'REEMPLAZADO']);
                $trabajdorcertificadoreemplazado=empleadoscertificado::where('certificado_id',$request->certificadoReemplazo)->update(['pivote'=>'REEMPLAZADO']);
                /// 



    // creacion del certificado reemplazador
                $certificado=certificado::with('empleadoscertificado')->where('id',$request->certificadoReemplazo)->get();
             
                $insp=solicitudeproceso::where('id',$request->solicitud_id)->get();
                foreach($insp as $solicitud){
                    $this->est_id=$solicitud->estructura_id;
                    $this->RutaArchivoBorrar=$solicitud->certificadoRuta;
                }
                             
                $this->nombreCertificado='CERT-'.$request->certificadoReemplazo.'-'.$request->mes.'-'.$request->anio.'-Solicitud-'.$request->solicitud_id;
          
                $dompdf = App::make("dompdf.wrapper");
                $dompdf->loadView("Certificados.certificadoFirmadoPDF",compact('certificado','insp'))->setPaper('letter')->save(public_path('Archivos/'.$request->anio.'/') .$this->nombreCertificado.'-Reemplazado.pdf');
                $solicitudes=solicitudeproceso::where('certificado','!=','')->where('estado',$this->aprobada)->get();
                $destinationPath='Archivos/'.$request->anio.'/';
                $documentos=documento::create([
                    'documento'=>$this->nombreCertificado."-Reemplazado.pdf",
                     'ubicacion'=>$destinationPath,
                     'estructura_id'=>$this->est_id,
                ]);
                $this->matrizTags=explode(',','CERTIFICADO REEMPLAZADO POR');// C-'.$request->certificado_id);
                //$documentos->tag($this->matrizTags);

                $rutaAbsoluta=$destinationPath.$this->nombreCertificado."-Reemplazado.pdf";
                $rutaCertificado=solicitudeproceso::where('id',$request->solicitud_id)->update(['certificadoRutaReemplazo'=>$rutaAbsoluta]);
    // fin de creacion del certificado reemplazador
    
     //eliminacion del certificado a modificar //
    $this->RutaArchivoBorrar=explode('/',$this->RutaArchivoBorrar);
    $eliminaDocumento=documento::where('documento',$this->RutaArchivoBorrar[2])->delete();
    //fin de eliminacion de certificado a modificar //

    //creacion del certificado Nuevo
    $certificado=certificado::with('empleadoscertificado')->where('id',$request->certificado_id)->get();
             
    $insp=solicitudeproceso::where('id',$request->solicitud_id)->get();
    foreach($insp as $solicitud){
        $this->est_id=$solicitud->estructura_id;
        $this->RutaArchivoBorrar=$solicitud->certificadoRuta;
    }
                 
    $this->nombreCertificado='CERT-'.$request->certificado_id.'-'.$request->mes.'-'.$request->anio.'-Solicitud-'.$request->solicitud_id;

    $dompdf = App::make("dompdf.wrapper");
    $dompdf->loadView("Certificados.certificadoFirmadoPDF",compact('certificado','insp'))->setPaper('letter')->save(public_path('Archivos/'.$request->anio.'/') .$this->nombreCertificado.'.pdf');
    $solicitudes=solicitudeproceso::where('certificado','!=','')->where('estado',$this->aprobada)->get();
    $destinationPath='Archivos/'.$request->anio.'/';
    $documentos=documento::create([
        'documento'=>$this->nombreCertificado.".pdf",
         'ubicacion'=>$destinationPath,
         'estructura_id'=>$this->est_id,

   ]);
    $this->matrizTags=explode(',','CERTIFICACION LABORAL');
    $documentos->tag($this->matrizTags);

    $rutaAbsoluta=$destinationPath.$this->nombreCertificado.".pdf";
    $rutaCertificado=solicitudeproceso::where('id',$request->solicitud_id)->update(['certificadoRuta'=>$rutaAbsoluta]);
    // fin del certificado nuevo///
    // Cambio de Estado de la Solicitud a Liberada//
    $solicitudUpdate=solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>'Liberada']);
    $solicitudes=solicitudeproceso::where('certificado','!=','')->where('estado',$this->aprobada)->get();
    return view('Admin.solicitudesxAprobar',compact('solicitudes'));
    
   }

   public function reporteDotacion(){
    $documento = new Spreadsheet();
    $documento
        ->getProperties()
        ->setCreator("Aqu?? va el creador, como cadena")
        ->setLastModifiedBy('Parzibyte') // ??ltima vez modificado por
        ->setTitle('Mi primer documento creado con PhpSpreadSheet')
        ->setSubject('El asunto')
        ->setDescription('Este documento fue generado para parzibyte.me')
        ->setKeywords('etiquetas o palabras clave separadas por espacios')
        ->setCategory('La categor??a');

        $hoja = $documento->getActiveSheet();
        $hoja->setTitle("Serresve SpA Dotaci??n");
        
        $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,'id');
        $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,'HOLDING_ASOCIADO');
        $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'CERTIFICADO');
        $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,'RUT_CONTRATISTA_SC');
        $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,'RUT_CONTRATISTA_CC');
        $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,'RAZON_SOCIAL_CONTRATISTA');
        $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,'RUT_MANDANTE');
        $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,'RAZON_SOCIAL_MANDANTE');
        $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,'RUT_TRABAJADOR');
        $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,'NOMBRE_TRABAJADOR');
        $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,'PERIODO_MES');
        $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'PERIODO_ANIO');
        $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'PERIODO');
        $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'ESTADO_TRABAJADOR');
        $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,'LIQUIDO_A_PAGO');
        $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'TOTAL_HABERES');
        $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,'TOTAL_IMPONIBLE');
        $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'OBSERVACION_PLANILLA');
        $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'OBSERVACION_REMUNERACIONAL');
        $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'OBSERVACION_PREVISIONAL');
        $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'CONTRATO_CONTRATISTA');
        $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'PROYECTO_CONTRATISTA');
        $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'RUT_CONTRATISTA_X_SUBCONTRATISTA');
        $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,'NUMERO_SOLICITUD');
        $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,'OBSERVACION_CONTRATO');
        $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,'OBSERVACION_DESVICULACION');
        $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,'PRE_FACTURA');
        $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,'FIRMA');
        $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,'DIAS_TRABAJADOS');
        $hoja->setCellValueByColumnAndRow($this->colu+30,$this->fila,'NUMERO_LOCAL');

        
        //$zoho=planillacertificado::where('PERIODO_MES',2021)->get();
        $zoho=planillacertificado::all();
        
        //dd($zoho);
        foreach($zoho as $dato){
                $this->fila = $this->fila + 1;
                $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,$dato->id);
                $holding=empresa::where('rut',$dato->RUT_MANDANTE)->get();
                foreach($holding as $holding){
                    $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,strtoupper($holding->mutualidad));
                }
                $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'C-'.$dato->CERTIFICADO);
                
                $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,$dato->RUT_CONTRATISTA_SC);
                $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,$dato->RUT_CONTRATISTA);//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+3,$f,$rr['rut_mandante']); //razon mandante
            
                 $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,$dato->RAZON_SOCIAL_CONTRATISTA);
                 $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,$dato->RUT_MANDANTE);
                 $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$dato->RAZON_SOCIAL_MANDANTE);
                 $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,$dato->RUT_TRABAJADOR);
           
                  
       
                 $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,$dato->NOMBRE_TRABAJADOR);
                 $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,$dato->PERIODO_MES);
                 $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,$dato->PERIODO_ANIO);
                 $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,$dato->PERIODO_ANIO.'-'.$dato->PERIODO_MES.'-01');
                 $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,strtoupper($dato->ESTADO_TRABAJADOR));
                 $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,$dato->LIQUIDO_A_PAGO);
                 $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,$dato->TOTAL_HABERES);
                 $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,$dato->TOTAL_IMPONIBLE);
                 $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,$dato->OBSERVACION_PLANILLA);
                 $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,$dato->OBSERVACION_REMUNERACIONAL);
                 $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,$dato->OBSERVACION_PREVISIONAL);
                 $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,$dato->CONTRATO_CONTRATISTA);
                 $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,$dato->PROYECTO_CONTRATISTA);
                 $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,$dato->RUT_CONTRATISTA_X_SUBCONTRATISTA);
                 $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,$dato->NUMERO_SOLICITUD);
                 $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,$dato->OBSERVACION_CONTRATO);
                 $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,$dato->OBSERVACION_DESVICULACION);
                 $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,$dato->PRE_FACTURA);
                 $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,$dato->FIRMA);
                 $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,$dato->DIAS_TRABAJADOS);
                 $hoja->setCellValueByColumnAndRow($this->colu+30,$this->fila,$dato->NUMERO_LOCAL);
                              
        }


    
    $nombreDelDocumento = "Planilla Dotacion.xlsx";
    /**
     * Los siguientes encabezados son necesarios para que
     * el navegador entienda que no le estamos mandando
     * simple HTML
     * Por cierto: no hagas ning??n echo ni cosas de esas; es decir, no imprimas nada
     */
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
    header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($documento, 'Xlsx');
    $writer->save('php://output');
    exit;
   }

   public function pruebaCertificado(){
       return view('Cliente.prueba');
   }

   // zoho guarda disco duro //
   public function zoholaravelSave(){
                 
    $documento = new Spreadsheet();
    $documento
        ->getProperties()
        ->setCreator("Aqu?? va el creador, como cadena")
        ->setLastModifiedBy('Parzibyte') // ??ltima vez modificado por
        ->setTitle('Mi primer documento creado con PhpSpreadSheet')
        ->setSubject('El asunto')
        ->setDescription('Este documento fue generado para parzibyte.me')
        ->setKeywords('etiquetas o palabras clave separadas por espacios')
        ->setCategory('La categor??a');

        $hoja = $documento->getActiveSheet();
        $hoja->setTitle("solicitudes Zoho");
        
        $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,'Mandante');
        $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,'Id');
        $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'Raz??n Social Mandante');
        $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,'Rut Mandante');
        $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,'Obra');
        $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,'Raz??n Social Contratista');
        $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,'Rut Contratista');
        $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,'Per??odo CCOLP');
        $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,'Periodo a CCOLP Mes');
        $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,'N?? de Trabajadores a Certificar');
        $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,'N?? Contrato o Servicio Prestado Informa Contratista');
        $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'Contacto Nombre');
        $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'Contacto Tel.');
        $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'Contacto Email');
        $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,'Estado Certificaci??n');
        $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'Fecha Recepci??n');
        $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,'Fecha Emisi??n');
        $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'Ejecutivo Asignado');
        $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'N?? Certificado');
        $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'N?? Factura');
        $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'Pagado Si/No');
        $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'D??as H??biles');
        $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'Observaci??n');
        $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,'Tipo de Solicitud');
        $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,'Tipo de Documento');
        $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,'Observaci??n');
        $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,'cantidad_reenvios');
        $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,'updated_at');
        $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,'marcaultimocambio');


        // $hoja->setCellValue("B2", "Este va en B2");
        // $hoja->setCellValue("A3", "Parzibyte");

        
        $zoho=zoho::whereYear('periodo_ccolp','>=',2020)->get();

        foreach($zoho as $dato){
                $this->fila = $this->fila + 1;
                $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,$dato->mandante);
                $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,$dato->id_solicitud);
                $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,$dato->razon_mandante);
                $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,$dato->rut_mandante);//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+3,$f,$rr['rut_mandante']); //razon mandante
            
                $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,$dato->obra);
                $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,$dato->razon_contratista);
                $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,$dato->rut_contratista);
                if ($dato->periodo_ccolp!='--01')
                    $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$dato->periodo_ccolp);
                else{
                    $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$this->vacio);
                }
                $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,$dato->periodo_a_ccolp_mes);
                $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,$dato->n_trabajadores_certificar);
                $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,$dato->contrato);
                // $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,$dato->Contacto Nombre');
                // $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,$dato->Contacto Tel.');
                // $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,$dato->Contacto Email');
                $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,strtoupper($dato->estado));
                $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,$dato->fecha_recepcion);
                if($dato->fecha_emision!=NULL){
                
                    $solicitud=solicitudeproceso::where('id',$dato->id_solicitud)->get();
                    foreach($solicitud as $fechaUpdate){
                        $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,$fechaUpdate->updated_at);
                    }

                }
                

                $solicitud=solicitudeproceso::where('id',$dato->id_solicitud)->get();
                foreach($solicitud as $SD){
                    if($SD->inspector_id!=NULL){
                        if ($SD->inspector_id==1652){
                                $this->nomInspectorZ='V3';
                                }elseif($SD->inspector_id==3){
                                    $this->nomInspectorZ='IZ';
                                }elseif($SD->inspector_id==1626){
                                    $this->nomInspectorZ='KS';
                                }elseif($SD->inspector_id==1627){
                                    $this->nomInspectorZ='JQ';
                                }elseif($SD->inspector_id==1628){
                                    $this->nomInspectorZ='LV';
                                }elseif($SD->inspector_id==1629){
                                    $this->nomInspectorZ='RM';
                                }elseif($SD->inspector_id==1630){
                                    $this->nomInspectorZ='YA';
                                }elseif($SD->inspector_id==1631){
                                    $this->nomInspectorZ='AQ';
                                }elseif($SD->inspector_id==1632){
                                    $this->nomInspectorZ='CG';
                                }elseif($SD->inspector_id==1633){
                                    $this->nomInspectorZ='MD';
                                }elseif($SD->inspector_id==1634){
                                    $this->nomInspectorZ='KM';
                                }elseif($SD->inspector_id==1635){
                                    $this->nomInspectorZ='VVL';
                                }elseif($SD->inspector_id==1669){
                                    $this->nomInspectorZ='Ricardo Jorquera';
                                }elseif($SD->inspector_id==1733){
                                    $this->nomInspectorZ='ricardo jorquera diaz';
                                }elseif($SD->inspector_id==1){
                                    $this->nomInspectorZ='AdministradorGeneral';
                                }elseif($SD->inspector_id==4){
                                    $this->nomInspectorZ='Vladimir Varas Vial';
                                }elseif($SD->inspector_id==6){
                                    $this->nomInspectorZ='Pedro Vargas';
                                }elseif($SD->inspector_id==1774){
                                    $this->nomInspectorZ='EE';
                                }elseif($SD->inspector_id==2083){
                                    $this->nomInspectorZ='CM';
                                }elseif($SD->inspector_id==1813){
                                    $this->nomInspectorZ='RO';
                                }elseif($SD->inspector_id==2267){
                                    $this->nomInspectorZ='PR';
                                }elseif($SD->inspector_id==2465){
                                    $this->nomInspectorZ='CMO';
                                }elseif($SD->inspector_id==2267){
                                    $this->nomInspectorZ='Prev-Riesgos1';
                                }elseif($SD->inspector_id==1822){
                                    $this->nomInspectorZ='Arturo Aros Queglas';
                                }elseif($SD->inspector_id==2142){
                                    $this->nomInspectorZ='AE';
                                }elseif($SD->inspector_id==2714){
                                    $this->nomInspectorZ='DP';
                                }elseif($SD->inspector_id==2218){
                                    $this->nomInspectorZ='typecode@typecode.cl';
                                }elseif($SD->inspector_id==2265){
                                    $this->nomInspectorZ='Marilu Miranda';
                                }elseif($SD->inspector_id==2163){
                                    $this->nomInspectorZ='CC';
                                }elseif($SD->inspector_id==2570){
                                    $this->nomInspectorZ='TC';
                                }elseif($SD->inspector_id==2686){
                                    $this->nomInspectorZ='AG';
                                }elseif($SD->inspector_id==2456){
                                    $this->nomInspectorZ='ADMINISTRATIVO 2';
                                }elseif($SD->inspector_id==2082){
                                    $this->nomInspectorZ='TypeCode SpA';
                                }elseif($SD->inspector_id==2945){
                                    $this->nomInspectorZ='DG';
                                }elseif($SD->inspector_id==2946){
                                    $this->nomInspectorZ='DS';
                                }elseif($SD->inspector_id==3052){
                                    $this->nomInspectorZ='RR';
                                }elseif($SD->inspector_id==3080){
                                    $this->nomInspectorZ='JR';
                                }elseif($SD->inspector_id==3107){
                                    $this->nomInspectorZ='MM';
                                }elseif($SD->inspector_id==3115){
                                    $this->nomInspectorZ='LU';
                                }elseif($SD->inspector_id==2327){
                                    $this->nomInspectorZ='Valentina Vargas';
                                }elseif($SD->inspector_id==3175){
                                    $this->nomInspectorZ='RN';
                                } elseif($SD->inspector_id==3174){
                                    $this->nomInspectorZ='AR';
                                }   

                                
                        }else{
                            $this->nomInspectorZ='';
                        }   
                    $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,strtoupper($this->nomInspectorZ));
                    if($SD->certificadoNombre==NULL){
                        $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'??'.$dato->n_certificado);
                    }else{
                        $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'??'.'C-'.$SD->certificadoNombre);
                    }
                }

                // $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,$dato->N?? Factura');
                // $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,$dato->Pagado Si/No');
                // $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,$dato->D??as H??biles');
                $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,$dato->observacion);
                $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,$dato->tipo_solicitud);
                $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,$dato->tipo_documento);
                $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,$dato->otraobservacion);
                $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,$dato->cantidad_reenvios);
                $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,$dato->updated_at);
                $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,$dato->marcaultimocambio);
        }


        //unlink('Archivos/Reportes/PlanillaZoho.xlsx');
     
    $nombreDelDocumento = "Planilla Zoho.xlsx";
    /*
     * Los siguientes encabezados son necesarios para que
     * el navegador entienda que no le estamos mandando
     * simple HTML
     * Por cierto: no hagas ning??n echo ni cosas de esas; es decir, no imprimas nada
     */
    
    //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
    //header('Cache-Control: max-age=0');
    
    $writer = IOFactory::createWriter($documento, 'Xlsx');
    //$writer->save('php://output');
    $writer->save('Archivos/Reportes/PlanillaZoho.xlsx');
    
    exit;

    }
   ///
    public function cambiarEstadoSolicitud(){
        return view('Admin.cambiarEstado');
    }
    public function actualizaEstadoSolicitud(request $request){
       
        $actualizaSolicitud=solicitudeproceso::where('id',$request->numeroSolicitud)->update(['estado'=>$request->nuevoEstado]);
        Alert::success('Cambio de Estado Exitoso');
        return view('Admin.cambiarEstado');
    }

    // descargas de documentos

    public function reporteDotacionSave(){
        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator("Aqu?? va el creador, como cadena")
            ->setLastModifiedBy('Parzibyte') // ??ltima vez modificado por
            ->setTitle('Mi primer documento creado con PhpSpreadSheet')
            ->setSubject('El asunto')
            ->setDescription('Este documento fue generado para parzibyte.me')
            ->setKeywords('etiquetas o palabras clave separadas por espacios')
            ->setCategory('La categor??a');
    
            $hoja = $documento->getActiveSheet();
            $hoja->setTitle("Serresve SpA Dotaci??n");
            
            $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,'id');
            $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,'HOLDING_ASOCIADO');
            $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'CERTIFICADO');
            $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,'RUT_CONTRATISTA_SC');
            $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,'RUT_CONTRATISTA_CC');
            $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,'RAZON_SOCIAL_CONTRATISTA');
            $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,'RUT_MANDANTE');
            $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,'RAZON_SOCIAL_MANDANTE');
            $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,'RUT_TRABAJADOR');
            $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,'NOMBRE_TRABAJADOR');
            $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,'PERIODO_MES');
            $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'PERIODO_ANIO');
            $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'PERIODO');
            $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'ESTADO_TRABAJADOR');
            $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,'LIQUIDO_A_PAGO');
            $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'TOTAL_HABERES');
            $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,'TOTAL_IMPONIBLE');
            $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'OBSERVACION_PLANILLA');
            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'OBSERVACION_REMUNERACIONAL');
            $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'OBSERVACION_PREVISIONAL');
            $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'CONTRATO_CONTRATISTA');
            $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'PROYECTO_CONTRATISTA');
            $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'RUT_CONTRATISTA_X_SUBCONTRATISTA');
            $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,'NUMERO_SOLICITUD');
            $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,'OBSERVACION_CONTRATO');
            $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,'OBSERVACION_DESVICULACION');
            $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,'PRE_FACTURA');
            $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,'FIRMA');
            $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,'DIAS_TRABAJADOS');
            $hoja->setCellValueByColumnAndRow($this->colu+30,$this->fila,'NUMERO_LOCAL');
    
    
            
            //$zoho=planillacertificado::where('PERIODO_MES',2021)->get();
            $zoho=planillacertificado::all();
            
            //dd($zoho);
            foreach($zoho as $dato){
                    $this->fila = $this->fila + 1;
                    $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,$dato->id);
                    $holding=empresa::where('rut',$dato->RUT_MANDANTE)->get();
                    foreach($holding as $holding){
                        $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,strtoupper($holding->mutualidad));
                    }
                    $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'C-'.$dato->CERTIFICADO);
                    
                    $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,$dato->RUT_CONTRATISTA_SC);
                    $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,$dato->RUT_CONTRATISTA);//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+3,$f,$rr['rut_mandante']); //razon mandante
                
                     $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,$dato->RAZON_SOCIAL_CONTRATISTA);
                     $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,$dato->RUT_MANDANTE);
                     $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$dato->RAZON_SOCIAL_MANDANTE);
                     $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,$dato->RUT_TRABAJADOR);
               
                      
           
                     $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,$dato->NOMBRE_TRABAJADOR);
                     $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,$dato->PERIODO_MES);
                     $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,$dato->PERIODO_ANIO);
                     $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,$dato->PERIODO_ANIO.'-'.$dato->PERIODO_MES.'-01');
                     $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,strtoupper($dato->ESTADO_TRABAJADOR));
                     $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,$dato->LIQUIDO_A_PAGO);
                     $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,$dato->TOTAL_HABERES);
                     $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,$dato->TOTAL_IMPONIBLE);
                     $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,$dato->OBSERVACION_PLANILLA);
                     $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,$dato->OBSERVACION_REMUNERACIONAL);
                     $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,$dato->OBSERVACION_PREVISIONAL);
                     $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,$dato->CONTRATO_CONTRATISTA);
                     $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,$dato->PROYECTO_CONTRATISTA);
                     $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,$dato->RUT_CONTRATISTA_X_SUBCONTRATISTA);
                     $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,$dato->NUMERO_SOLICITUD);
                     $hoja->setCellValueByColumnAndRow($this->colu+25,$this->fila,$dato->OBSERVACION_CONTRATO);
                     $hoja->setCellValueByColumnAndRow($this->colu+26,$this->fila,$dato->OBSERVACION_DESVICULACION);
                     $hoja->setCellValueByColumnAndRow($this->colu+27,$this->fila,$dato->PRE_FACTURA);
                     $hoja->setCellValueByColumnAndRow($this->colu+28,$this->fila,$dato->FIRMA);
                     $hoja->setCellValueByColumnAndRow($this->colu+29,$this->fila,$dato->DIAS_TRABAJADOS);
                     $hoja->setCellValueByColumnAndRow($this->colu+30,$this->fila,$dato->NUMERO_LOCAL);
                                  
            }
    
    
        
        $nombreDelDocumento = "Planilla Dotacion.xlsx";
        /**
         * Los siguientes encabezados son necesarios para que
         * el navegador entienda que no le estamos mandando
         * simple HTML
         * Por cierto: no hagas ning??n echo ni cosas de esas; es decir, no imprimas nada
         */
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($documento, 'Xlsx');
        
        $writer->save('Archivos/Reportes/Planilla Dotacion.xlsx');
        exit;
       }

       //zerresve
    public function zohoSerresveSave(){
                 
        $documento = new Spreadsheet();
        $documento
            ->getProperties()
            ->setCreator("Aqu?? va el creador, como cadena")
            ->setLastModifiedBy('Parzibyte') // ??ltima vez modificado por
            ->setTitle('Mi primer documento creado con PhpSpreadSheet')
            ->setSubject('El asunto')
            ->setDescription('Este documento fue generado para parzibyte.me')
            ->setKeywords('etiquetas o palabras clave separadas por espacios')
            ->setCategory('La categor??a');

            $hoja = $documento->getActiveSheet();
            $hoja->setTitle("serres Zoho");
            
            $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,'Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,'Id');
            $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,'Raz??n Social Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,'Rut Mandante');
            $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,'Obra');
            $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,'Raz??n Social Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,'Rut Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,'Per??odo CCOLP');
            $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,'Periodo a CCOLP Mes');
            $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,'N?? de Trabajadores a Certificar');
            $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,'N?? Contrato o Servicio Prestado Informa Contratista');
            $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'Contacto Nombre');
            $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'Contacto Tel.');
            $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'Contacto Email');
            $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,'Estado Certificaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'Fecha Recepci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,'Fecha Emisi??n');
            $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'Ejecutivo Asignado');
            $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'N?? Certificado');
            $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'N?? Factura');
            $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'Pagado Si/No');
            $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'D??as H??biles');
            $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'Observaci??n');
            $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,'Reemplaza A');

            
            $zoho=certificado::all();
            //$zoho=certificado::where('anio','>',2020)->where('nmes','>',7)->get();
            //dd($zoho);
            foreach($zoho as $dato){
                    $this->fila = $this->fila + 1;
                    $hoja->setCellValueByColumnAndRow($this->colu+1,$this->fila,$dato->estructura->proyecto->empresa->mutualidad);
                    //dd($dato->estructura->proyecto->empresa->mutualidad);
                    $hoja->setCellValueByColumnAndRow($this->colu+2,$this->fila,$dato->solicitud_id);
                    
                    $hoja->setCellValueByColumnAndRow($this->colu+3,$this->fila,$dato->estructura->proyecto->empresa->nombre);
                    $hoja->setCellValueByColumnAndRow($this->colu+4,$this->fila,$dato->estructura->proyecto->empresa->rut);//             $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($c+3,$f,$rr['rut_mandante']); //razon mandante
                    //dd($dato->estructura->proyecto->empresa->nombre);
                    $hoja->setCellValueByColumnAndRow($this->colu+5,$this->fila,$dato->estructura->proyecto->proyecto);
                    $hoja->setCellValueByColumnAndRow($this->colu+6,$this->fila,$dato->estructura->empresa->nombre);
                    //dd($dato->estructura->empresa->nombre);
                    $hoja->setCellValueByColumnAndRow($this->colu+7,$this->fila,$dato->estructura->empresa->rut);
                     
                    $hoja->setCellValueByColumnAndRow($this->colu+8,$this->fila,$dato->anio.'-'.$dato->mes.'-01');
                                                
                    $hoja->setCellValueByColumnAndRow($this->colu+9,$this->fila,$dato->mes);
                    $hoja->setCellValueByColumnAndRow($this->colu+10,$this->fila,$dato->totalRevizados);
                    $hoja->setCellValueByColumnAndRow($this->colu+11,$this->fila,$dato->estructura->contrato);
                    $hoja->setCellValueByColumnAndRow($this->colu+12,$this->fila,'N/D');//$dato->estructura->proyecto->empresa->nomContacto
                    //dd($dato->estructura->proyecto->empresa->nomContacto);
                    $hoja->setCellValueByColumnAndRow($this->colu+13,$this->fila,'N/D'); //$dato->estructura->proyecto->empresa->fonContacto
                    $hoja->setCellValueByColumnAndRow($this->colu+14,$this->fila,'N/D');//$dato->estructura->proyecto->empresa->emailContacto
                    if($dato->estado=='Enviada a Firma')
                    {
                        $dato->estado='ENVIADO A FIRMA';
                        $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,strtoupper($dato->estado));  
                    }else{
                        $hoja->setCellValueByColumnAndRow($this->colu+15,$this->fila,strtoupper($dato->estado));
                    }
                    
                    
                    $hoja->setCellValueByColumnAndRow($this->colu+16,$this->fila,'N/D'); 
                    $hoja->setCellValueByColumnAndRow($this->colu+17,$this->fila,$dato->fechaEmision);
                    $hoja->setCellValueByColumnAndRow($this->colu+18,$this->fila,'N/D');
                    $hoja->setCellValueByColumnAndRow($this->colu+19,$this->fila,'C-'.$dato->id);
                    $hoja->setCellValueByColumnAndRow($this->colu+20,$this->fila,'0');
                    $hoja->setCellValueByColumnAndRow($this->colu+21,$this->fila,'');
                    $hoja->setCellValueByColumnAndRow($this->colu+22,$this->fila,'');
                    $hoja->setCellValueByColumnAndRow($this->colu+23,$this->fila,'');
                    if($dato->solicitud->certificadoReemplazo!=''){
                        $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,'R-'.$dato->solicitud->certificadoReemplazo);
                    }else{
                        $hoja->setCellValueByColumnAndRow($this->colu+24,$this->fila,'');
                    }
            }


        
        $nombreDelDocumento = "Planilla ZohoSerresve.xlsx";
        /**
         * Los siguientes encabezados son necesarios para que
         * el navegador entienda que no le estamos mandando
         * simple HTML
         * Por cierto: no hagas ning??n echo ni cosas de esas; es decir, no imprimas nada
         */
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($documento, 'Xlsx');
        
        $writer->save('Archivos/Reportes/Planilla ZohoSerresve.xlsx');
        exit;
        
    }

    public function asignacionsolicitudesInspectores(){
        return view('Admin.solicitudesainspectores');
    }

    public function cargasolicitudesainspectores(request $request){
 
         
        $array = (new EmpleadosCertificadoImport)->toArray($request->excel);
       
        //dd($array);
                    //while($this->num==0){
                    for($i=0;$i<count($array[0]);$i++){
                        
                        if(trim($array[0][$this->cont]['SOLICITUD_ID'])!=''){
                            $this->solicitudid=trim($array[0][$this->cont]['SOLICITUD_ID']);
                            $this->inspectorid=trim($array[0][$this->cont]['INSPECTOR_ID']);
                            
                            $act=solicitudeproceso::where('id',$this->solicitudid)->update(['estado'=>'Asignada','inspector_id'=>$this->inspectorid]);
                            if ($this->inspectorid==1652){
                                $this->nomInspectorZ='V3';
                                }elseif($this->inspectorid==3){
                                    $this->nomInspectorZ='IZ';
                                }elseif($this->inspectorid==1626){
                                    $this->nomInspectorZ='KS';
                                }elseif($this->inspectorid==1627){
                                    $this->nomInspectorZ='JQ';
                                }elseif($this->inspectorid==1628){
                                    $this->nomInspectorZ='LV';
                                }elseif($this->inspectorid==1629){
                                    $this->nomInspectorZ='RM';
                                }elseif($this->inspectorid==1630){
                                    $this->nomInspectorZ='YA';
                                }elseif($this->inspectorid==1631){
                                    $this->nomInspectorZ='AQ';
                                }elseif($this->inspectorid==1632){
                                    $this->nomInspectorZ='CG';
                                }elseif($this->inspectorid==1633){
                                    $this->nomInspectorZ='MD';
                                }elseif($this->inspectorid==1634){
                                    $this->nomInspectorZ='KM';
                                }elseif($this->inspectorid==1635){
                                    $this->nomInspectorZ='VVL';
                                }elseif($this->inspectorid==1669){
                                    $this->nomInspectorZ='Ricardo Jorquera';
                                }elseif($this->inspectorid==1733){
                                    $this->nomInspectorZ='ricardo jorquera diaz';
                                }elseif($this->inspectorid==1){
                                    $this->nomInspectorZ='AdministradorGeneral';
                                }elseif($this->inspectorid==4){
                                    $this->nomInspectorZ='Vladimir Varas Vial';
                                }elseif($this->inspectorid==6){
                                    $this->nomInspectorZ='Pedro Vargas';
                                }elseif($this->inspectorid==1774){
                                    $this->nomInspectorZ='EE';
                                }elseif($this->inspectorid==2083){
                                    $this->nomInspectorZ='CM';
                                }elseif($this->inspectorid==1813){
                                    $this->nomInspectorZ='RO';
                                }elseif($this->inspectorid==2267){
                                    $this->nomInspectorZ='PR';
                                }elseif($this->inspectorid==2465){
                                    $this->nomInspectorZ='CMO';
                                }elseif($this->inspectorid==2267){
                                    $this->nomInspectorZ='Prev-Riesgos1';
                                }elseif($this->inspectorid==1822){
                                    $this->nomInspectorZ='Arturo Aros Queglas';
                                }elseif($this->inspectorid==2142){
                                    $this->nomInspectorZ='AE';
                                }elseif($this->inspectorid==2714){
                                    $this->nomInspectorZ='DP';
                                }elseif($this->inspectorid==2218){
                                    $this->nomInspectorZ='typecode@typecode.cl';
                                }elseif($this->inspectorid==2265){
                                    $this->nomInspectorZ='Marilu Miranda';
                                }elseif($this->inspectorid==2163){
                                    $this->nomInspectorZ='CC';
                                }elseif($this->inspectorid==2570){
                                    $this->nomInspectorZ='TC';
                                }elseif($this->inspectorid==2686){
                                    $this->nomInspectorZ='AG';
                                }elseif($this->inspectorid==2456){
                                    $this->nomInspectorZ='ADMINISTRATIVO 2';
                                }elseif($this->inspectorid==2082){
                                    $this->nomInspectorZ='TypeCode SpA';
                                }
                          
                            
                            
                            $actualizacionZoho=zoho::where('id_solicitud',$this->solicitudid)->update(['estado'=>'EN REVISION','ejecutivo'=>$this->nomInspectorZ]);
                            
                            $this->cont++;
                        }
                    } 
                    //dd($this->inspectorid);
                    return view('Admin.solicitudesainspectores');
        
    }


}