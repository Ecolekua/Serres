<?php

namespace App\Http\Controllers;
use App\usuconformulario;
use App\solicitudeproceso;
use App\solicituddocumento;
use App\seguimiento;
use App\empresa;
use App\User;
use App\zoho;
use App\documento;
use Conner\Tagging\Model\Tagged;
use App\proyecto;
use Mail;
use App\Mail\NotificacionSolicitud;
use Illuminate\Http\Request;
use Alert;
use App\estructura;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $valor=0;
    public $idSolicitudNueva;
    public $inspector=0;
    public $estado="Enviada";
    public $estadoRechazada="Rechazada";
    public $estadoAsignada="Asignada";
    public $estadoGuardada="Guardada";
    public $aprobada="Aprobada";
    public $actualizar="Actualizar";
    public $estadoZoho;
    public $guardada_iniciada="INICIADA";
    public $enviada_recibido="RECIBIDO";
    public $asigna_enrevision="EN REVISION";
    public $comentario;
    public $inspector_ids;
    public $tipoFormulario;
    public $usuconform_id;
    public $numerodeformulario;
    public $resp;
    public $estructura;
    public $nomMandante;
    public $rutMandante;
    public $solicitudesArray = array();
    public $documentosArray = array();
    public $etiquetasArray = array();
    public $f=0;
    public $c=0;
    public $f2=0;
    public $c2=0;
    public $fechaActual;
    public $alias;
    public $control_doc_trab;
    public $control_doc_emp;
    public $evaluacion_fin;
    public $otra_observacion;
    public $tipo_solicitud;
    public $nreenvio=0;
    public $valors;
    public $cert = array();
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create()
    {
        $user = auth()->User()->id;
        
        $dia=date('j');
        $formulacioContratista=usuconformulario::where('user_id',$user)->get();
        return view('Cliente.solicitudesCreate',compact('formulacioContratista','dia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $user = auth()->User()->id;
                
        $email = auth()->User()->email;
        
        $user = auth()->User()->id;
        $ano=$request->ano;


        $identificaForm=usuconformulario::where('id',$request->usuConFomulario_id)->get();
        foreach($identificaForm as $formtipo){
            $this->tipoFormulario = $formtipo->formulario;
        }


        // solicitud enviada por rechazo del inspector

        $siinspector=solicitudeproceso::where('id',$request->solicitud_id)->get();  //saca id del inspector
        foreach($siinspector as $inspector){
            $this->inspector_ids=$inspector->inspector_id;
            $this->nreenvio = $inspector->nreenviada+1;
        }
        $this->fechaActual= new \DateTime();
        $nreenvios=solicitudeproceso::where('id',$request->solicitud_id)->update(['nreenviada'=>$this->nreenvio]);
        $nreenviosZoho=zoho::where('id_solicitud',$request->solicitud_id)->update(['cantidad_reenvios'=>$this->nreenvio,'marcaultimocambio'=>$this->fechaActual]);
        // INICIO DE ACTUALIZACION Y REEENVIO POR DEVOLUCION

        if($request->actualizar==$this->actualizar){

            $solicitud=solicitudeproceso::where('id',$request->usuConFomulario_id)->get();
            foreach($solicitud as $usuconformid){
                $this->usuconform_id = $usuconformid->usuconformulario_id;
            }
    
            $usufor=usuconformulario::where('id',$this->usuconform_id)->get();
           
            foreach($usufor as $formulario){
                $this->tipoFormulario = $formulario->formulario;
            }

             
            
            //bitacora de Reenv??o por rechazo
                    $this->comentario="Solicitud reenviada por Observaci??n";
                    seguimiento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'comentario'=>$this->comentario,
                        'user_id'=>$user,
                        'inspector_id'=>$user,
                        ]);
                    // fin bitacora


                    if($this->inspector_ids!=0){
                        $this->estado="Asignada";
                        // $this->estadoZoho=$this->asigna_enrevision;
                        $this->estadoZoho='REENVIADA';
                    }else{
                        $this->estado="Enviada";
                        $this->estadoZoho=$this->enviada_recibido;
                    }
            
            if($this->tipoFormulario==1){    
                    $this->fechaActual= new \DateTime();
                    $act=solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>$this->estado,'totalvigentes'=>$request->totalvigentes,'contratados'=>$request->contratados,'desvinculados'=>$request->desvinculados,'otrascausas'=>$request->otrascausas,'mes'=>$request->mes,'ano'=>$request->ano,'rutSub'=>$request->rutSub,'nomSub'=>$request->nomSub,'dirSub'=>$request->dirSub,'comSub'=>$request->comSub,'telSub'=>$request->telSub]);
                    $feP=$request->mes.'/'.$request->ano;
                    $actZoho=zoho::where('id_solicitud',$request->solicitud_id)->update(['estado'=>$this->estadoZoho,'marcaultimocambio'=>$this->fechaActual]); //,'n_trabajadores_certificar'=>$request->totalvigentes,'periodo_ccolp'=>$feP

                    if ($request->hasFile('cot')){
                        $cot=$request->file('cot');
                        $nombrecot=time().'-Cotizacion-'.$cot->getClientOriginalName();
                        $cot->move(public_path().'/Archivos/'.$ano.'/',$nombrecot);
                        // return $nombre;
                    }
                    if ($request->hasFile('con')){
                        $con=$request->file('con');
                        $nombrecon=time().'-Contrato-'.$con->getClientOriginalName();
                        $con->move(public_path().'/Archivos/'.$ano.'/',$nombrecon);
                        // return $nombre;
                    }
                    if ($request->hasFile('liq')){
                        $liq=$request->file('liq');
                        $nombreliq=time().'-Liquidacion-'.$liq->getClientOriginalName();
                        $liq->move(public_path().'/Archivos/'.$ano.'/',$nombreliq);
                        // return $nombre;
                    }
                    if ($request->hasFile('fin')){
                        $fin=$request->file('fin');
                        $nombrefin=time().'-Finiquito-'.$fin->getClientOriginalName();
                        $fin->move(public_path().'/Archivos/'.$ano.'/',$nombrefin);
                        // return $nombre;
                    }
                    // archivo nuevos

                    if ($request->hasFile('lib')){
                        $lib=$request->file('lib');
                        $nombrelib=time().'-LibroRemuneraciones-'.$lib->getClientOriginalName();
                        $lib->move(public_path().'/Archivos/'.$ano.'/',$nombrelib);
                        // return $nombre;
                    }
                    if ($request->hasFile('nom')){
                        $nom=$request->file('nom');
                        $nombrenom=time().'-NominaTrabajadores-'.$nom->getClientOriginalName();
                        $nom->move(public_path().'/Archivos/'.$ano.'/',$nombrenom);
                        // return $nombre;
                    }

                    // fin archivos nuevo

                    $tipodocumento='Cotizaci??n';
                    $orden=1;
                    $observaciones="Env??o por Rechazo";
                    $estado="OK";
                    if ($request->hasFile('cot')){
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrecot,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                    }
                    $tipodocumento='Contrato';
                    $orden=2;
                    if ($request->hasFile('con')){
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrecon,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                    }
                    $tipodocumento='Liquidaci??n';
                    $orden=3;
                    if ($request->hasFile('liq')){
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombreliq,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                    }
                    $tipodocumento='Finiquito';
                    $orden=4;
                    if ($request->hasFile('fin')){
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrefin,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                    }

                    // archivos nunevos
                    $tipodocumento='Libro de Remuneraciones';
                    $orden=5;
                    if ($request->hasFile('lib')){
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrelib,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                    }

                    $tipodocumento='Nomina de Trabajadores';
                    $orden=6;
                    if ($request->hasFile('nom')){
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrenom,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                    }
                


                    // fin archivos nuevo

                    Alert::success('Solicitud Reenviada a Revisi??n exitosamente');

                    $user = auth()->User()->id;
                
                    $dia=date('j');
                    $formulacioContratista=usuconformulario::where('user_id',$user)->get();
                    return view('Cliente.solicitudesCreate',compact('formulacioContratista','dia'));


            }elseif($this->tipoFormulario==2){
                $this->fechaActual= new \DateTime();
                solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>$this->estado,'totalvigentes'=>$request->totalvigentes,'rectCert'=>$request->rectCert,'contdocutrab'=>$request->contdocutrab,'contdocuempr'=>$request->contdocuempr,'evalfina'=>$request->evalfina,'otro'=>$request->otro,'otroobser'=>$request->otraopcion]);
                zoho::where('id_solicitud',$request->solicitud_id)->update(['estado'=>$this->estado,'marcaultimocambio'=>$this->fechaActual]);

                if ($request->hasFile('pla')){
                    $pla=$request->file('pla');
                    $nombrepla=time().'-Planilla de Carga de Trabajadores-'.$pla->getClientOriginalName();
                    $pla->move(public_path().'/Archivos/'.$ano.'/',$nombrepla);
                    // return $nombre;
                }
                if ($request->hasFile('set')){
                    $set=$request->file('set');
                    $nombreset=time().'-Set de Archivos ZIP-'.$set->getClientOriginalName();
                    $set->move(public_path().'/Archivos/'.$ano.'/',$nombreset);
                    // return $nombre;
                }

                //eliminar
                    $tipodocumento='Planilla de Trabajadores';
                    $orden=1;
                    $observaciones="Env??o por Observaci??n";
                    $estado="OK";
                    if ($request->hasFile('pla')){
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrepla,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                    }
                //fin eliminar

                $tipodocumento='Set de Archivos';
                $orden=1;
                $observaciones="Env??o por Observaci??n";
                $estado="OK";
                if ($request->hasFile('set')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$request->solicitud_id,
                    'documento'=>$nombreset,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }

                Alert::success('Solicitud Reenviada a Revisi??n exitosamente');

                    $user = auth()->User()->id;
                
                    $dia=date('j');
                    $formulacioContratista=usuconformulario::where('user_id',$user)->get();
                    return view('Cliente.solicitudesCreate',compact('formulacioContratista','dia'));
            }
               
                
        }
        // FIN DE ACTUALIZACION Y REENVIO POR DEVOLUCION
        

        //inicio nuevo certificado / comprobacion si existe

        if ($this->tipoFormulario==1){
            $ano=$request->ano;
            $pivote=$request->usuConFomulario_id.'-'.$request->mes.'-'.$request->ano;
            $siexiste=solicitudeproceso::where('pivote',$pivote)->get();
            foreach($siexiste as $datos){
                if ($datos->pivote==""){
                    $this->valor=0;
                }else{
                    $this->valor=1;
                }

            }
        }elseif($this->tipoFormulario==2){
            // $pivote=$request->usuConFomulario_id.'-'.$request->numerocertificado;
            // $siexiste=solicitudeproceso::where('pivote',$pivote)->get();
            // foreach($siexiste as $datos){
            //     if ($datos->pivote==""){
                    $this->valor=0;
                // }else{
                //     $this->valor=1;
                // }

            // }
        }
        

        if($this->valor==0){

               // inicio si no existe y es nuevo

            if ($this->tipoFormulario==1){   

                if ($request->hasFile('cot')){
                    $cot=$request->file('cot');
                    $nombrecot=time().'-Cotizacion-'.$cot->getClientOriginalName();
                    $cot->move(public_path().'/Archivos/'.$ano.'/',$nombrecot);
                    // return $nombre;
                }
                if ($request->hasFile('con')){
                    $con=$request->file('con');
                    $nombrecon=time().'-Contrato-'.$con->getClientOriginalName();
                    $con->move(public_path().'/Archivos/'.$ano.'/',$nombrecon);
                    // return $nombre;
                }
                if ($request->hasFile('liq')){
                    $liq=$request->file('liq');
                    $nombreliq=time().'-Liquidacion-'.$liq->getClientOriginalName();
                    $liq->move(public_path().'/Archivos/'.$ano.'/',$nombreliq);
                    // return $nombre;
                }
                if ($request->hasFile('fin')){
                    $fin=$request->file('fin');
                    $nombrefin=time().'-Finiquito-'.$fin->getClientOriginalName();
                    $fin->move(public_path().'/Archivos/'.$ano.'/',$nombrefin);
                    // return $nombre;
                }

                // archivos nuevos
                if ($request->hasFile('lib')){
                    $lib=$request->file('lib');
                    $nombrelib=time().'-LibroRemuneraciones-'.$lib->getClientOriginalName();
                    $lib->move(public_path().'/Archivos/'.$ano.'/',$nombrelib);
                    // return $nombre;
                }
                if ($request->hasFile('nom')){
                    $nom=$request->file('nom');
                    $nombrenom=time().'-NominaTrabajadores-'.$nom->getClientOriginalName();
                    $nom->move(public_path().'/Archivos/'.$ano.'/',$nombrenom);
                    // return $nombre;
                }
                // fin archivos nuevos

                $pivote=$request->usuConFomulario_id.'-'.$request->mes.'-'.$request->ano;

                $this->fechaActual= date('Y-m-d H:i:s'); 

              //solicitudes guardadas
                
                if($request->noenviar==1){
                     //dd($request);
                    $estado='Guardada';
                    $idgb=solicitudeproceso::create([
                        'user_id'=>$user,
                        'estructura_id'=>$request->estructura_id,
                        'usuconformulario_id'=>$request->usuConFomulario_id,
                        'mes'=>$request->mes,
                        'ano'=>$request->ano,
                        'contratados'=>$request->contratados,
                        'desvinculados'=>$request->desvinculados,
                        'otrascausas'=>$request->otrascausas,
                        'totalvigentes'=>$request->totalvigentes,
                        'estado'=>$estado,
                        'pivote'=>$pivote,
                        'rutSub'=>$request->rutSub,
                        'nomSub'=>$request->nomSub,
                        'dirSub'=>$request->dirSub,
                        'comSub'=>$request->comSub,
                        'telSub'=>$request->telSub,
                        'tipo_documento'=>$request->tipo_documento,
                       //'fechaEnvio' => $this->fechaActual,
                        // 'inspector_id'=>$this->inspector,
    
                    ]);

                     // inicio tabla zoho

                     $user = auth()->User()->id;
                     $cont=user::where('id',$user)->get();
                     foreach($cont as $conts){
                         $nombre=$conts->name;
                         $mail=$conts->email;
                     }
     
                    
                     $periodo=$request->ano."-".$request->mes."-01";
                     $alias=empresa::where('rut',$request->rutMandante,['mutualidad'])->get();
                     foreach($alias as $mandante){
                         $this->alias=$mandante->mutualidad;
                     }

                     if ($periodo=='--01'){
                         $this->tipo_solicitud='Formulario ??nico de Certificaci??n de Documentos';
                     }else{
                        $this->tipo_solicitud='Certificaci??n Laboral';
                     }

                    
                     $zoho=zoho::create([
                         'mandante'=>$this->alias,
                         'id_solicitud'=>$idgb->id,
                         'razon_mandante'=>$request->nombreMandante,
                         'rut_mandante'=>$request->rutMandante,
                         'obra'=>$request->proyecto,
                         'razon_contratista'=>$request->nombreContratista,
                         'rut_contratista'=>$request->rutContratista,
                         'periodo_ccolp'=>$periodo,
                         'periodo_a_ccolp_mes'=>0,
                         'n_trabajadores_certificar'=>$request->totalvigentes,
                         'contrato'=>$request->contrato,
                         //'servicio_contratista'=>0,
                         'contacto_nombre'=>$nombre,
                         'contacto_telefono'=>'N/D',
                         'contacto_email'=>$mail,
                         'estado'=>$this->guardada_iniciada,
                         //'fecha_recepcion'=>0,
                         'fecha_emision'=>0,
                         'ejecutivo'=>'N/D',
                         'n_certificado'=>0,
                         'factura'=>0,
                         'pagado'=>0,
                         'dias_habiles'=>0,
                         'tipo_solicitud'=>$this->tipo_solicitud,
             
                     ]);
                             //fin tabla zoho
                }else{
                    
                    $estado='Enviada';
                    if($request->noenviar==2){
                         $decla="Declaracion";
                    }else{
                        $decla="";
                    }
                   
                    $idgb=solicitudeproceso::create([
                        'user_id'=>$user,
                        'estructura_id'=>$request->estructura_id,
                        'usuconformulario_id'=>$request->usuConFomulario_id,
                        'mes'=>$request->mes,
                        'ano'=>$request->ano,
                        'contratados'=>$request->contratados,
                        'desvinculados'=>$request->desvinculados,
                        'otrascausas'=>$request->otrascausas,
                        'totalvigentes'=>$request->totalvigentes,
                        'estado'=>$estado,
                        'pivote'=>$pivote,
                        'fechaEnvio' => $this->fechaActual,
                        'rutSub'=>$request->rutSub,
                        'nomSub'=>$request->nomSub,
                        'dirSub'=>$request->dirSub,
                        'comSub'=>$request->comSub,
                        'telSub'=>$request->telSub,
                        'identificacion'=>$decla,
                        'tipo_documento'=>$request->tipo_documento,
                        'checkleyempleo'=>$request->checkleyempleo,
                        'obserleyempleo'=>$request->obserleyempleo,
    
                    ]);


                    if($request->noenviar==2){
                        $decla="SIN MOVIMIENTO";
                         // inicio tabla zoho

                    $user = auth()->User()->id;
                    $cont=user::where('id',$user)->get();
                    foreach($cont as $conts){
                        $nombre=$conts->name;
                        $mail=$conts->email;
                    }
    
                   $alias=empresa::where('rut',$request->rutMandante,['mutualidad'])->get();
                    foreach($alias as $mandante){
                        $this->alias=$mandante->mutualidad;
                    }

                    $periodo=$request->ano."-".$request->mes."-01";

                    if ($periodo=='--01'){
                        $this->tipo_solicitud='Formulario ??nico de Certificaci??n de Documentos';
                    }else{
                        
                        if ($decla==''){
                            $this->tipo_solicitud='Certificaci??n Laboral';
                        }else{
                            $this->tipo_solicitud='Certificaci??n Laboral - Sin Movimiento';
                        }
                        
                    }

                  
                    $zoho=zoho::create([
                        'mandante'=>$this->alias,
                        'id_solicitud'=>$idgb->id,
                        'razon_mandante'=>$request->nombreMandante,
                        'rut_mandante'=>$request->rutMandante,
                        'obra'=>$request->proyecto,
                        'razon_contratista'=>$request->nombreContratista,
                        'rut_contratista'=>$request->rutContratista,
                        'periodo_ccolp'=>$periodo,
                        'periodo_a_ccolp_mes'=>0,
                        'n_trabajadores_certificar'=>$request->totalvigentes,
                        'contrato'=>$request->contrato,
                        //'servicio_contratista'=>0,
                        'contacto_nombre'=>$nombre,
                        'contacto_telefono'=>'N/D',
                        'contacto_email'=>$mail,
                        'estado'=>$decla,
                        //'fecha_recepcion'=>0,
                        'fecha_emision'=>0,
                        'ejecutivo'=>'N/D',
                        'n_certificado'=>0,
                        'factura'=>0,
                        'pagado'=>0,
                        'dias_habiles'=>0,
                        'tipo_solicitud'=>$this->tipo_solicitud,
                    ]);
                            //fin tabla zoho
                   }else{
                       $decla="";

                        // inicio tabla zoho

                    $user = auth()->User()->id;
                    $cont=user::where('id',$user)->get();
                    foreach($cont as $conts){
                        $nombre=$conts->name;
                        $mail=$conts->email;
                    }
    
                    $alias=empresa::where('rut',$request->rutMandante,['mutualidad'])->get();
                     foreach($alias as $mandante){
                         $this->alias=$mandante->mutualidad;
                     }


                    $periodo=$request->ano."-".$request->mes."-01";

                    if ($periodo=='--01'){
                        $this->tipo_solicitud='Formulario ??nico de Certificaci??n de Documentos';
                    }else{
                       $this->tipo_solicitud='Certificaci??n Laboral';
                    }

                   
                    $zoho=zoho::create([
                        'mandante'=>$this->alias,
                        'id_solicitud'=>$idgb->id,
                        'razon_mandante'=>$request->nombreMandante,
                        'rut_mandante'=>$request->rutMandante,
                        'obra'=>$request->proyecto,
                        'razon_contratista'=>$request->nombreContratista,
                        'rut_contratista'=>$request->rutContratista,
                        'periodo_ccolp'=>$periodo,
                        'periodo_a_ccolp_mes'=>0,
                        'n_trabajadores_certificar'=>$request->totalvigentes,
                        'contrato'=>$request->contrato,
                        //'servicio_contratista'=>0,
                        'contacto_nombre'=>$nombre,
                        'contacto_telefono'=>'N/D',
                        'contacto_email'=>$mail,
                        'estado'=>$this->enviada_recibido,
                        //'fecha_recepcion'=>0,
                        'fecha_emision'=>0,
                        'ejecutivo'=>'N/D',
                        'n_certificado'=>0,
                        'factura'=>0,
                        'pagado'=>0,
                        'dias_habiles'=>0,
                        'tipo_solicitud'=>$this->tipo_solicitud,
                    ]);
                            //fin tabla zoho
                   }



                       
                    
                }
                    
           
                foreach($idgb as $idSolicitud){
                    $this->idSolicitudNueva = $idgb->id;
                }

                  if($request->noenviar!=1)  {

                      Mail::to($email)->send(new NotificacionSolicitud($this->idSolicitudNueva));
                  }

                if($request->noenviar==1){
                    //bitacora de Reenv??o por rechazo
                   $this->comentario="Solicitud Guardada";
                   seguimiento::create([
                       'solicitudeproceso_id'=>$idgb->id,
                       'comentario'=>$this->comentario,
                       'user_id'=>$user,
                       'inspector_id'=>$user,
                       ]);
                   // fin bitacora
                   
               }else{
                    //bitacora de Reenv??o por rechazo
                   $this->comentario="Solicitud Ingresada por Primera Vez";
                   $this->fechaActual= new \DateTime();
                   //dd($this->fechaActual);
                   seguimiento::create([
                       'solicitudeproceso_id'=>$idgb->id,
                       'comentario'=>$this->comentario,
                       'user_id'=>$user,
                       'inspector_id'=>$user,
                       'fechaEnvio' => $this->fechaActual,
                       ]);
                    //dd($this->fechaActual);
                       solicitudeproceso::where('id',$idgb->id)->update(['fechaEnvio'=>$this->fechaActual]);
                       zoho::where('id_solicitud',$idgb->id)->update(['fecha_recepcion'=>$this->fechaActual,'marcaultimocambio'=>$this->fechaActual]);
                   // fin bitacora
                   
               }


                $tipodocumento='Cotizaci??n';
                $orden=1;
                $observaciones="Primer Env??o";
                $estado="OK";
                if ($request->hasFile('cot')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$idgb->id,
                    'documento'=>$nombrecot,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }
                $tipodocumento='Contrato';
                $orden=2;
                if ($request->hasFile('con')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$idgb->id,
                    'documento'=>$nombrecon,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }
                $tipodocumento='Liquidaci??n';
                $orden=3;
                if ($request->hasFile('liq')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$idgb->id,
                    'documento'=>$nombreliq,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }
                $tipodocumento='Finiquito';
                $orden=4;
                if ($request->hasFile('fin')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$idgb->id,
                    'documento'=>$nombrefin,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }

                // archivos nuevos
                $tipodocumento='Libro de Remuneraciones';
                $orden=5;
                if ($request->hasFile('lib')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$idgb->id,
                    'documento'=>$nombrelib,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }

                $tipodocumento='Nomina de Trabajadores';
                $orden=6;
                if ($request->hasFile('nom')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$idgb->id,
                    'documento'=>$nombrenom,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }
                // fin archivos nuevo

               
                if($request->noenviar==1){
                    $estado='Guardada';
                   
                    $resp=1;
                }else{
                    $estado='Enviada';
                   
                    $resp=2;
                }
            
                // fin si n no existe y es nuevo


            }elseif($this->tipoFormulario==2){ // guardado nuevo del formulario 2 de documentos
//eliminar
                if ($request->hasFile('pla')){
                    $pla=$request->file('pla');
                    $nombrepla=time().'-Planilla-'.$pla->getClientOriginalName();
                    $pla->move(public_path().'/Archivos/'.$ano.'/',$nombrepla);
                    // return $nombre;
                }
//fin eliminar
                if ($request->hasFile('set')){
                    $set=$request->file('set');
                    $nombreset=time().'-Set ZIP-'.$set->getClientOriginalName();
                    $set->move(public_path().'/Archivos/'.$ano.'/',$nombreset);
                    // return $nombre;
                }

                if($request->noenviar==1){
                    $estado='Guardada';
                   
                    $resp=1;
                }else{
                    $estado='Enviada';
                   
                    $resp=2;
                }

               // dd($request->tipo_documento);
                    $this->fechaActual= new \DateTime();
                //dd($this->fechaActual);
                $idgb=solicitudeproceso::create([
                    'user_id'=>$user,
                    'estructura_id'=>$request->estructura_id,
                    'usuconformulario_id'=>$request->usuConFomulario_id,
                    'numerocertificado'=>$request->numerocertificado,
                    'rectCert'=>$request->rectCert,
                    // 'contdocutrab'=>$request->contdocutrab,
                    // 'contdocuempr'=>$request->contdocuempr,
                    // 'evalfina'=>$request->evalfina,
                    // 'totalvigentes'=>$request->totalvigentes,
                    'otro'=>$request->otro,
                    'tipo_documento'=>$request->tipo_documento,
                    'observacion_documento'=>$request->otraopcion,
                    'otroobser'=>$request->otraopcion,
                    'estado'=>$estado,
                    'pivote'=>$this->fechaActual,
                    'rutSub'=>$request->rutSub,
                    'nomSub'=>$request->nomSub,
                    'dirSub'=>$request->dirSub,
                    'comSub'=>$request->comSub,
                    'telSub'=>$request->telSub,
                    'tipo_documento'=>$request->tipo_documento,
                    'checkleyempleo'=>$request->checkleyempleo,
                    'obserleyempleo'=>$request->obserleyempleo,
                    // 'inspector_id'=>$this->inspector,

                ]);

                //zoho ingreso a la tabla zoho por primera vez //
                $user = auth()->User()->id;
                $cont=user::where('id',$user)->get();
                foreach($cont as $conts){
                    $nombre=$conts->name;
                    $mail=$conts->email;
                }

                $alias=empresa::where('rut',$request->rutMandante)->get();
                     foreach($alias as $mandante){
                         $this->alias=$mandante->mutualidad;
                     }

                Mail::to($email)->send(new NotificacionSolicitud($idgb->id));
                $periodo=$request->ano."-".$request->mes."-01";

                    //  if($request->contdocutrab>0)
                    //  {
                    //     $this->control_doc_trab='Control Documental Trabajadores';
                    //  }
                    //  if($request->contdocuempr>0)
                    //  {
                    //     $this->control_doc_emp='Control Documental Empresa';
                    //  }
                    //  if($request->evalfina>0)
                    //  {
                    //     $this->evaluacion_fin='Evaluaci??n Financiera';
                    //  }
                    //  if($request->otraopcion!='')
                    //  {
                    //     $this->otra_observacion=$request->otraopcion;
                    //  }

                      if ($periodo=='--01'){
                    $this->tipo_solicitud='Formulario ??nico de Certificaci??n de Documentos';
                     }else{
                        $this->tipo_solicitud='Certificaci??n Laboral';
                     }
                 

                $zoho=zoho::create([
                    'mandante'=>$this->alias,
                    'id_solicitud'=>$idgb->id,
                    'razon_mandante'=>$request->nombreMandante,
                    'rut_mandante'=>$request->rutMandante,
                    'obra'=>$request->proyecto,
                    'razon_contratista'=>$request->nombreContratista,
                    'rut_contratista'=>$request->rutContratista,
                    'periodo_ccolp'=>$periodo,
                    'periodo_a_ccolp_mes'=>0,
                   
                    'contrato'=>$request->contrato,
                   
                    'contacto_nombre'=>$nombre,
                    'contacto_telefono'=>'N/D',
                    'contacto_email'=>$mail,
                    'estado'=>$this->enviada_recibido,
                    'fecha_recepcion'=>$idgb->created_at,
                   
                    'ejecutivo'=>'N/D',
                    
                    // 'control_documental_trabajadores'=>$this->control_doc_trab,
                    // 'control_documental_empresa'=>$this->control_doc_emp,
                    // 'evaluacion_financiera'=>$this->evaluacion_fin,
                    'tipo_documento'=>$request->tipo_documento,
                    'otraobservacion'=>$request->otraopcion,
                    'tipo_solicitud'=>$this->tipo_solicitud,

                ]);


                //fin ingreso zoho por primera vez

              

                if($request->noenviar==1){
                    //bitacora de Reenv??o por rechazo
                   $this->comentario="Solicitud de Documentos Guardada";
                   seguimiento::create([
                       'solicitudeproceso_id'=>$idgb->id,
                       'comentario'=>$this->comentario,
                       'user_id'=>$user,
                       'inspector_id'=>$user,
                       ]);
                   // fin bitacora
                   
               }else{
                    //bitacora de Reenv??o por primera vez
                   $this->comentario="Solicitud de Documentos Ingresada por Primera Vez";
                   
                   seguimiento::create([
                       'solicitudeproceso_id'=>$idgb->id,
                       'comentario'=>$this->comentario,
                       'user_id'=>$user,
                       'inspector_id'=>$user,
                       ]);
                   // fin bitacora
                   
               }


                $tipodocumento='Planilla';
                $orden=1;
                $observaciones="Primer Env??o";
                $estado="OK";
                if ($request->hasFile('pla')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$idgb->id,
                    'documento'=>$nombrepla,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }
                $tipodocumento='Set de Archivos';
                $orden=2;
                if ($request->hasFile('set')){
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$idgb->id,
                    'documento'=>$nombreset,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
                }


            }   

        }else{
           
            $resp=3;
          
        }
        if($resp==1){
            Alert::success('Solicitud Guardada con Exito, (No Recepcionada)');
        }
        if($resp==2){
            Alert::success('Solicitud Enviada con Exito');
        }
        if($resp==3){
            Alert::error('Solicitud ya Existe');
            if($request->noenviar==2){
                $user = auth()->User()->id;
        
                    $dia=date('j');
                    $formulacioContratista=usuconformulario::where('user_id',$user)->get();
                    return view('Cliente.solicitudesCreate',compact('formulacioContratista','dia'));
            }

        }
        
        $user = $request->usuConFomulario_id;
        
        $usuconfor=usuconformulario::where('id',$user)->get();
        
        if ($this->tipoFormulario==1){ 
            return view('Cliente.formulacioCertificacion',compact('usuconfor'));
        }elseif($this->tipoFormulario==2){
            return view('Cliente.formulacioDocumentosCertificacion',compact('usuconfor'));
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
            return view('Cliente.solicitudShow',compact('solicitud','documentos'));

        }elseif($this->tipoFormulario==2){
            return view('Cliente.solicitudDocumentosShow',compact('solicitud','documentos'));
        }

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

        $documentos=solicituddocumento::where('solicitudeproceso_id',$id)->get();

        if ($this->tipoFormulario==1){
            return view('Cliente.RechazadaEdit',compact('solicitud','documentos'));

        }elseif($this->tipoFormulario==2){
            return view('Cliente.RechazadaEditDocumentos',compact('solicitud','documentos'));
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function CrearFormulario($id){
                 
        $usuconfor=usuconformulario::where('id',$id)->get();
        //dd($usuconfor);
        foreach($usuconfor as $form)
        if ($form->formulario==1)
            return view('Cliente.formulacioCertificacion',compact('usuconfor'));

        if (($form->formulario==2))
        return view('Cliente.formulacioDocumentosCertificacion',compact('usuconfor'));
    }

    public function CrearFormularioDeclaracion($id){
                 
        $usuconfor=usuconformulario::where('id',$id)->get();
        //dd($usuconfor);
        foreach($usuconfor as $form)
        if ($form->formulario==1)
            return view('Cliente.formulacioCertificacionDeclaracion',compact('usuconfor'));

        if (($form->formulario==2))
        return view('Cliente.formulacioDocumentosCertificacion',compact('usuconfor'));
    }


    public function indexEnviadas(){

        $user = auth()->User()->id;

        $solicitudesAdmin=solicitudeproceso::where('user_id',$user)->get();
        


    }

    public function solicitudesAdminContratistas(){
        $user = auth()->User()->id;

        $solicitudesAdmin=usuconformulario::where('user_id',$user)->get();
        //$solicitudesAdmin = usuconformulario::distinct()->select('estructura_id')->where('user_id',$user)->get();
        
        foreach($solicitudesAdmin as $estructura){
            //$solicitudesAdmin=solicitudeproceso::where('estructura_id',$estructura->estructura_id)->where('estructura->formulario',$estructura->formulario)->get();
            $solicitudesAdmin=solicitudeproceso::where('estructura_id',$estructura->estructura_id)->get();
            
            foreach($solicitudesAdmin as $datos){
                //dd($datos->usuconformulario->formulario);
                 if ($estructura->formulario==$datos->usuconformulario->formulario)
                 {
                                $this->solicitudesArray[$this->f][$this->c]=$datos->id;
                                $this->solicitudesArray[$this->f][$this->c+1]=$datos->mes;
                                $this->solicitudesArray[$this->f][$this->c+2]=$datos->ano;
                                $this->solicitudesArray[$this->f][$this->c+3]=$datos->contratados;
                                $this->solicitudesArray[$this->f][$this->c+4]=$datos->desvinculados;
                                $this->solicitudesArray[$this->f][$this->c+5]=$datos->otrascausas;
                                $this->solicitudesArray[$this->f][$this->c+6]=$datos->totalvigentes;
                                $this->solicitudesArray[$this->f][$this->c+7]=$datos->estado;
                                //dd($datos->usuconformulario_id);
                                $form=usuconformulario::where('id',$datos->usuconformulario_id)->get();
                                //dd($form);
                                foreach($form as $formulario){
                                // dd($formulario->formulario);
                                    $this->solicitudesArray[$this->f][$this->c+11]=$formulario->formulario;
                                }
                                
                                $datoContrato=estructura::where('id',$estructura->estructura_id)->get();
                                    foreach($datoContrato as $datoContrato){

                                    

                                        $this->solicitudesArray[$this->f][$this->c+10]=$datoContrato->contrato;
                                        //$this->solicitudesArray[$this->f][$this->c+11]=$estructura->formulario;
                                        $empresa=empresa::where('id',$datoContrato->empresa_id)->get();
                                            foreach($empresa as $datoEmpresa){
                                                $this->solicitudesArray[$this->f][$this->c+12]=$datoEmpresa->rut;
                                                $this->solicitudesArray[$this->f][$this->c+13]=$datoEmpresa->nombre;
                                            }

                                            $proyecto=proyecto::where('id',$datoContrato->proyecto_id)->get();
                                            foreach($proyecto as $empresa){
                                                $datoempresa=empresa::where('id',$empresa->empresa_id)->get();
                                                    foreach($datoempresa as $empresa){
                                                        $this->solicitudesArray[$this->f][$this->c+14]=$empresa->rut;
                                                        $this->solicitudesArray[$this->f][$this->c+15]=$empresa->nombre;
                                                    }
                                            }
                                    }
                                    $this->solicitudesArray[$this->f][$this->c+16]=$datos->certificado;
                                    $this->solicitudesArray[$this->f][$this->c+17]=$datos->created_at;
                                
                                $this->f++;
                }
            }

            $solicitudesAdmin=$this->solicitudesArray;

          // dd($solicitudesAdmin);
          
        }
        return view('Cliente.indexSolicitudesAdmin',compact('solicitudesAdmin'));
    }

    public function indexAprobGuard(){
        $user = auth()->User()->id;
        $this->estado="Liberada";
        $solicitudesEnviadas=solicitudeproceso::where('user_id',$user)->where('estado',$this->estado)->orWhere('estado',$this->estadoGuardada)->where('user_id',$user)->orWhere('estado',$this->aprobada)->where('user_id',$user)->get();
        return view('Cliente.indexAprobGuard',compact('solicitudesEnviadas'));
    }

    public function indexDeclaradas(){
        $user = auth()->User()->id;
        $this->identificacion="Declaracion";
        $solicitudesEnviadas=solicitudeproceso::where('user_id',$user)->where('estado',$this->identificacion)->get();
        return view('Cliente.indexDeclaradas',compact('solicitudesEnviadas'));
    }

    public function bitacora($id){
        //dd($id);
        $seguimiento=seguimiento::where('solicitudeproceso_id',$id)->get();
        $solicitud=solicitudeproceso::where('id',$id)->get();
        //dd($solicitud);
        return view('Cliente.bitacora',compact('seguimiento','solicitud'));
    }

    public function solicitudGuardadaEnviar($id){

        
        $solicitud=solicitudeproceso::where('id',$id)->get();
        $documentos=solicituddocumento::where('solicitudeproceso_id',$id)->get();
        foreach($solicitud as $usuconformid){
            $this->usuconform_id = $usuconformid->usuconformulario_id;
        }
        $numeroFormulario=usuconformulario::where('id',$this->usuconform_id)->get();
        foreach($numeroFormulario as $formulario){
            $this->numerodeformulario = $formulario->formulario;
        }
        
        

        if($this->numerodeformulario==1){
            return view('Cliente.SolicitudEnviarGb',compact('solicitud','documentos'));
        }elseif($this->numerodeformulario==2){
            return view('Cliente.SolicitudDocumentosEnviarGb',compact('solicitud','documentos'));
        }

    }

    public function storeGuardada(Request $request){


       

        $solicitud=solicitudeproceso::where('id',$request->usuConFomulario_id)->get();
        foreach($solicitud as $usuconformid){
            $this->usuconform_id = $usuconformid->usuconformulario_id;
        }

        $usufor=usuconformulario::where('id',$this->usuconform_id)->get();
       
        foreach($usufor as $formulario){
            $this->tipoFormulario = $formulario->formulario;
        }

   

                $ano=$request->ano;
                $this->estado="Enviada";
                $this->fechaActual= new \DateTime();
                $email = auth()->User()->email;
                Mail::to($email)->send(new NotificacionSolicitud($request->usuConFomulario_id));
        if ($this->tipoFormulario==1){    
                solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>$this->estado,'totalvigentes'=>$request->totalvigentes,'contratados'=>$request->contratados,'desvinculados'=>$request->desvinculados,'otrascausas'=>$request->otrascausas,'fechaEnvio'=>$this->fechaActual]);
                zoho::where('id_solicitud',$request->solicitud_id)->update(['estado'=>$this->enviada_recibido,'fecha_recepcion'=>$this->fechaActual]);

                $observaciones="Primer Env??o";
                $estado="OK";

                if ($request->hasFile('cot')){
                    $cot=$request->file('cot');
                    $nombrecot=time().'-Cotizacion-'.$cot->getClientOriginalName();
                    $cot->move(public_path().'/Archivos/'.$ano.'/',$nombrecot);
                    // return $nombre;
                    $tipodocumento='Cotizaci??n';
                    $orden=1;
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrecot,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                }
                if ($request->hasFile('con')){
                    $con=$request->file('con');
                    $nombrecon=time().'-Contrato-'.$con->getClientOriginalName();
                    $con->move(public_path().'/Archivos/'.$ano.'/',$nombrecon);
                    // return $nombre;
                    $tipodocumento='Contrato';
                    $orden=2;
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrecon,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                }
                if ($request->hasFile('liq')){
                    $liq=$request->file('liq');
                    $nombreliq=time().'-Liquidacion-'.$liq->getClientOriginalName();
                    $liq->move(public_path().'/Archivos/'.$ano.'/',$nombreliq);
                    // return $nombre;
                    $tipodocumento='Liquidaci??n';
                    $orden=3;
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombreliq,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                }
                if ($request->hasFile('fin')){
                    $fin=$request->file('fin');
                    $nombrefin=time().'-Finiquito-'.$fin->getClientOriginalName();
                    $fin->move(public_path().'/Archivos/'.$ano.'/',$nombrefin);
                    // return $nombre;
                    
                    $tipodocumento='Finiquito';
                    $orden=4;
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrefin,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                }

                // archivos nuevos
                if ($request->hasFile('lib')){
                    $lib=$request->file('lib');
                    $nombrelib=time().'-LibroRemuneraciones-'.$lib->getClientOriginalName();
                    $lib->move(public_path().'/Archivos/'.$ano.'/',$nombrelib);
                    // return $nombre;
                    
                    $tipodocumento='Libro de Remuneraciones';
                    $orden=5;
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrelib,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                }

                if ($request->hasFile('nom')){
                    $nom=$request->file('nom');
                    $nombrenom=time().'-NominaTrabajadores-'.$nom->getClientOriginalName();
                    $nom->move(public_path().'/Archivos/'.$ano.'/',$nombrenom);
                    // return $nombre;
                    
                    $tipodocumento='Nomina de Trabajadores';
                    $orden=6;
                    solicituddocumento::create([
                        'solicitudeproceso_id'=>$request->solicitud_id,
                        'documento'=>$nombrenom,
                        'tipodocumento'=>$tipodocumento,
                        'orden'=>$orden,
                        'observaciones'=>$observaciones,
                        'estado'=>$estado,
                    ]);
                }
                // fin archivos nuevos
                //bitacora de Reenv??o por rechazo
                $user = auth()->User()->id;
                $this->comentario="Solicitud Ingresada por Primera Vez";
                seguimiento::create([
                    'solicitudeproceso_id'=>$request->solicitud_id,
                    'comentario'=>$this->comentario,
                    'user_id'=>$user,
                    'inspector_id'=>$user,
                    ]);
                // fin bitacora

                $user = auth()->User()->id;
                $this->estado="Aprobada";
                $solicitudesEnviadas=solicitudeproceso::where('user_id',$user)->where('estado',$this->estado)->orWhere('estado',$this->estadoGuardada)->get();
                Alert::success('Solicitud Enviada con Exito');
                return view('Cliente.home',compact('solicitudesEnviadas'));
        
        }elseif($this->tipoFormulario==2){
            $this->fechaActual= new \DateTime();
            solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>$this->estado,'totalvigentes'=>$request->totalvigentes,'rectCert'=>$request->rectCert,'contdocutrab'=>$request->contdocutrab,'contdocuempr'=>$request->contdocuempr,'evalfina'=>$request->evalfina,'otro'=>$request->otro,'otroobser'=>$request->otraopcion]);
            zoho::where('id_solicitud',$request->solicitud_id)->update(['estado'=>$this->estado,'marcaultimocambio'=>$this->fechaActual]);

            $observaciones="Primer Env??o";
            $estado="OK";

            if ($request->hasFile('pla')){
                $pla=$request->file('pla');
                $nombrepla=time().'-Planilla excel de Trabajadores-'.$pla->getClientOriginalName();
                $pla->move(public_path().'/Archivos/'.$ano.'/',$nombrepla);
                // return $nombre;
                $tipodocumento='planilla';
                $orden=1;
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$request->solicitud_id,
                    'documento'=>$nombrepla,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
            }
            if ($request->hasFile('set')){
                $set=$request->file('set');
                $nombreset=time().'-Set de Archivos ZIP-'.$set->getClientOriginalName();
                $set->move(public_path().'/Archivos/'.$ano.'/',$nombreset);
                // return $nombre;
                $tipodocumento='Set de Archivos';
                $orden=1;
                solicituddocumento::create([
                    'solicitudeproceso_id'=>$request->solicitud_id,
                    'documento'=>$nombreset,
                    'tipodocumento'=>$tipodocumento,
                    'orden'=>$orden,
                    'observaciones'=>$observaciones,
                    'estado'=>$estado,
                ]);
            }

             //bitacora de Reenv??o por rechazo
             $user = auth()->User()->id;
             $this->comentario="Solicitud de Documentos Ingresada por Primera Vez";
             seguimiento::create([
                 'solicitudeproceso_id'=>$request->solicitud_id,
                 'comentario'=>$this->comentario,
                 'user_id'=>$user,
                 'inspector_id'=>$user,
                 ]);
             // fin bitacora

             $user = auth()->User()->id;
             $this->estado="Aprobada";
             $solicitudesEnviadas=solicitudeproceso::where('user_id',$user)->where('estado',$this->estado)->orWhere('estado',$this->estadoGuardada)->get();
             Alert::success('Solicitud Enviada con Exito');
             return view('Cliente.indexAprobGuard',compact('solicitudesEnviadas'));

        }
    }

    public function buscarSolicitudes(){
        return view('Cliente.bucarsolicitudes');
    }

    public function ResultadoBusquedaSolicitud(Request $request){
        $solicitudesEnviadas=solicitudeproceso::where('id',$request->solicitud_id)->get();
        foreach($solicitudesEnviadas as $solicitudes){
            $this->resp=$solicitudes->id;
        }
        if (empty($this->resp)){
            Alert::error('N?? de Solicitud no Existe');
            return view('Cliente.bucarsolicitudes');
        }else{
            return view('Cliente.ResultadoSolicitud',compact('solicitudesEnviadas'));
        }
    }

    public function documentosCliente(){


        $user = auth()->User()->id;

        //$estructuras=usuconformulario::where('user_id',$user)->distinct('estructura_id')->get();
        $estructuras = usuconformulario::distinct()->select('estructura_id')->where('user_id',$user)->get();

        //$ad->getcodes()->distinct('pid')->count('pid');
                foreach($estructuras as $estructura){
                        $documentos=documento::where('estructura_id',$estructura->estructura_id)->get();
                            foreach($documentos as $datos){
                              
                                $this->documentosArray[$this->f][$this->c]=$datos->id;
                                $this->documentosArray[$this->f][$this->c+1]=$datos->mes;
                                $this->documentosArray[$this->f][$this->c+2]=$datos->anio;
                                $this->documentosArray[$this->f][$this->c+3]=$datos->documento;
                                $this->documentosArray[$this->f][$this->c+4]=$datos->ubicacion;
                                $etiquetasr=Tagged::where('taggable_id',$datos->id)->get();
                                    foreach($etiquetasr as $etiquetas){
                                        $this->valors.=$etiquetas->tag_name.",";
                                    }
                                $this->documentosArray[$this->f][$this->c+5]=$this->valors;
                                $this->f++;
                                $this->valors='';
                            }
                        $certificados=solicitudeproceso::where('estructura_id',$estructura->estructura_id)->where('certificado','!=','')->where('estado','=','Liberada')->get();
                        foreach($certificados as $ccolp){
                            $this->cert[$this->f2][$this->c2]=$ccolp->id;
                            $this->cert[$this->f2][$this->c2+1]=$ccolp->estructura->empresa->rut;
                            $this->cert[$this->f2][$this->c2+2]=$ccolp->estructura->empresa->nombre;
                            $this->cert[$this->f2][$this->c2+3]=$ccolp->mes;
                            $this->cert[$this->f2][$this->c2+4]=$ccolp->ano;
                            $this->cert[$this->f2][$this->c2+5]=$ccolp->certificado;
                        }
                        $this->f2++;
                    }


        $documentos=$this->documentosArray;
        $certs=$this->cert;
        //dd($documentos);
                
           return view('Cliente.indexDocumentos',compact('documentos','certs'));
    }
}
