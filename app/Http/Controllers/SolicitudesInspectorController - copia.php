<?php

namespace App\Http\Controllers;
use App\solicitudeproceso;
use App\user;
use App\planillacertificado;
use App\zoho;
use App\seguimiento;
use App\usuconformulario;
use App\documento;
use App\solicituddocumento;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Alert;
use App\certificado;
use fpdf\fpdf;
use Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\empleadoscertificado;
use App\Imports\CargaEmpleados;
use App\Imports\EmpleadosCertificadoImport;
use App\Mail\NotificacionSolicitudObservada;
use Illuminate\Http\Request;


class SolicitudesInspectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    Public $estado="Asignada";
    Public $observadas="Rechazada";
    public $aprobada="Aprobada";
    public $declaracion="Declaracion";
    public $mail;
    public $rechazada_conobservaciones="CON OBSERVACIONES";
    public $aprobada_enviada_a_firma="ENVIADA A FIRMA";
    public $mes;
    public $anio;
    public $estructura_id;
    public $pivote;
    public $inspector;
    public $dato;
    public $num=0;
    public $cont=0;
    public $pivoteEmpleados;
    public $matrizArchivo;
    public $matrizAnterior=array();
    public $matrizActual=array();
    public $matrizSegundaNomina=array();
    public $fil=0;
    public $col=0;
    public $totalAnterior=0;
    public $empleadosNuevos=0;
    public $empleadoslRevisados=0;
    public $empleadosDesvinculados=0;
    public $totalDotacion=0;
    public $siExiste=0;
    public $noExiste=0;
    public $empleadosDesvinculadosSN=0;
    public $max=0;
    public $obs_pla;
    public $nMesBusqueda=1;
    public $periodo;
    public $recorrido=0;
    public $anteriorSegundaNomina=array();

    public function index()
    {
        
        $this->estado="Asignada";
        $user = auth()->User()->id;
        //$seguimiento=seguimiento::all();
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada',NULL)->get();
        //dd($solicitudesNuevas);
        $solicitudesReenviadas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada','>',0)->get();
        $solicitudRechazadaFirma=solicitudeproceso::where('inspector_id',$user)->where('estado','=','Rechazada')->where('observacionRechazo','!=',NULL)->get();
        $solicitudDeclaracionesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->declaracion)->get();
        //->Orwhere('inspector_id',$user)->where('estado',$this->declaracion)->get();
        return view('Inspector.index',compact('solicitudesNuevas','solicitudesReenviadas','solicitudRechazadaFirma','solicitudDeclaracionesNuevas'));
    }

    public function SolicitudesInspectorObsFirm()
    {
        $user = auth()->User()->id;
        if ($user==1 || $user==1669){
         
        
        $solicitudesNuevas=solicitudeproceso::with('solicituddocumento')->where('estado',$this->observadas)->where('observacionRechazo',NULL)->Orwhere('estado','Aprobada')->get(); //->wheredate('fechaEnvio',">=",$request->fechai)->wheredate('fechaEnvio',"<=",$request->fechaf)
        
        //$solicitudesNuevas=solicitudeproceso::where('estado',$this->observadas)->Orwhere('estado',$this->aprobada)->get();

        }else{

            $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->observadas)->where('observacionRechazo',NULL)->Orwhere('estado','=','Aprobada')->where('inspector_id',$user)->get();
        }
        
        return view('Inspector.indexObsFirm',compact('solicitudesNuevas'));
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
            return view('Inspector.solicitudInspectorShow',compact('solicitud','documentos'));

        }elseif($this->tipoFormulario==2){
            return view('Inspector.solicitudDocumentosInspectorShow',compact('solicitud','documentos'));
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
    
        $seguimiento=seguimiento::all();
        $solicitud=solicitudeproceso::where('id',$id)->get();
        $documentos=solicituddocumento::where('solicitudeproceso_id',$id)->get();
        return view('Inspector.editSolicitud',compact('solicitud','documentos','seguimiento'));
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
        $user = auth()->User()->id;
        
        if($request->certificado!=''){
            //bitacora de Reenv??o por rechazo
            $this->comentario="Solicitud Enviada a Firma";

            if ($request->observaciones!=""){

                seguimiento::create([
                'solicitudeproceso_id'=>$id,
                'comentario'=>$this->comentario." - Observaci??n:??".$request->observaciones,
                'user_id'=>$user,
                'inspector_id'=>$user,
                ]);
             }else{ 
            seguimiento::create([
                'solicitudeproceso_id'=>$id,
                'comentario'=>$this->comentario,
                'user_id'=>$user,
                'inspector_id'=>$user,
                ]);
             }  
            // fin bitacora


            $this->estado="Aprobada";
            $seguimiento=seguimiento::all();
            $act=solicitudeproceso::where('id',$id)->update(['estado'=>$this->estado,'observaciones'=>$request->observaciones,'certificado'=>$request->certificado]);
            
            //$actZoho=zoho::where('id_solicitud',$id)->update(['observacion'=>$this->aprobada_enviada_a_firma,'estado'=>$this->aprobada_enviada_a_firma]);
            

            Alert::success('Solicitud Enviada a Firma');
            $this->estado="Asignada";
        $user = auth()->User()->id;
        //$seguimiento=seguimiento::all();
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada',NULL)->get();
        //dd($solicitudesNuevas);
        $solicitudesReenviadas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada','>',0)->get();
        $solicitudRechazadaFirma=solicitudeproceso::where('inspector_id',$user)->where('estado','=','Rechazada')->where('observacionRechazo','!=',NULL)->get();
        $solicitudDeclaracionesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->declaracion)->get();
        //->Orwhere('inspector_id',$user)->where('estado',$this->declaracion)->get();
        return view('Inspector.index',compact('solicitudesNuevas','solicitudesReenviadas','solicitudRechazadaFirma','solicitudDeclaracionesNuevas'));
             
        }




        if($request->estado=="Rechazada"){

              //bitacora de Reenv??o por rechazo
              $this->comentario="Solicitud Observada por Inspector";
              seguimiento::create([
                  'solicitudeproceso_id'=>$id,
                  'comentario'=>$this->comentario." -??".$request->observaciones,
                  'user_id'=>$user,
                  'inspector_id'=>$user,
                  ]);
              // fin bitacora

            $this->fechaActual= new \DateTime();
            $seguimiento=seguimiento::all();
            $this->estado="Rechazada";
            $act=solicitudeproceso::where('id',$id)->update(['estado'=>$request->estado,'observaciones'=>$request->observaciones]);
            $actZoho=zoho::where('id_solicitud',$id)->update(['estado'=>$this->rechazada_conobservaciones,'marcaultimocambio'=>$this->fechaActual]);
            $actZoho=zoho::where('id_solicitud',$id)->update(['Observacion'=>$request->observaciones]);
            Alert::info('Solicitud Observada...');
            $solicitud = solicitudeproceso::where('id',$id)->get();
            foreach($solicitud as $usuario_id){
                $usuario=user::where('id',$usuario_id->user_id)->get();
                    foreach($usuario as $mail_usuario){
                        $this->mail=$mail_usuario->email;
                    }
            }

            Mail::to($this->mail)->send(new NotificacionSolicitudObservada($id));

            $this->estado="Asignada";
        $user = auth()->User()->id;
        //$seguimiento=seguimiento::all();
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada',NULL)->get();
        //dd($solicitudesNuevas);
        $solicitudesReenviadas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada','>',0)->get();
        $solicitudRechazadaFirma=solicitudeproceso::where('inspector_id',$user)->where('estado','=','Rechazada')->where('observacionRechazo','!=',NULL)->get();
        $solicitudDeclaracionesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->declaracion)->get();
        //->Orwhere('inspector_id',$user)->where('estado',$this->declaracion)->get();
        return view('Inspector.index',compact('solicitudesNuevas','solicitudesReenviadas','solicitudRechazadaFirma','solicitudDeclaracionesNuevas'));

        }

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

    public function finalizadas(){
        return "ok";
        $user = auth()->User()->id;
        $this->estado="Liberada";
        dd($this->estado);
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->get();

        return view('Inspector.solicitudesFinalizadas',compact('solicitudesNuevas'));
    }

    public function finalizada(){
        $user = auth()->User()->id;
        $this->estado="Liberada";
       // dd($this->estado);
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->get();

        return view('Inspector.solicitudesFinalizadas',compact('solicitudesNuevas'));
    }

    public function certificacionCreate($id){
        return $id;
    }

    public function CargaEmpleados(request $request)
    {
        //comprobaci??n de planilla correspondiente a la solicitud /////////////////////////////////////////////////////
        $user = auth()->User()->id;
        $nombreArchivo = $request->file('excel')->getClientOriginalName();
        $this->matrizArchivo=explode('-',$nombreArchivo);
        if($request->solicitud_id!=$this->matrizArchivo[0]){
            $this->estado="Asignada";
        $user = auth()->User()->id;
        //$seguimiento=seguimiento::all();
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada',NULL)->get();
        //dd($solicitudesNuevas);
        $solicitudesReenviadas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada','>',0)->get();
        $solicitudRechazadaFirma=solicitudeproceso::where('inspector_id',$user)->where('estado','=','Rechazada')->where('observacionRechazo','!=',NULL)->get();
        $solicitudDeclaracionesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->declaracion)->get();
        //->Orwhere('inspector_id',$user)->where('estado',$this->declaracion)->get();
        return view('Inspector.index',compact('solicitudesNuevas','solicitudesReenviadas','solicitudRechazadaFirma','solicitudDeclaracionesNuevas'));
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //Verificaci??n de existencia del certificado////////////////////////////////////////////////////////////////////
        $this->pivote='CERT-'.$request->estructura_id.'-'.$request->mes.'-'.$request->anio;
        $b_cert=certificado::where('pivote',$this->pivote)->first();
        if(!empty($b_cert)){
            Alert::info('Certificado Ya Existe...');
            $user = auth()->User()->id;
        //$seguimiento=seguimiento::all();
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada',NULL)->get();
        //dd($solicitudesNuevas);
        $solicitudesReenviadas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada','>',0)->get();
        $solicitudRechazadaFirma=solicitudeproceso::where('inspector_id',$user)->where('estado','=','Rechazada')->where('observacionRechazo','!=',NULL)->get();
        $solicitudDeclaracionesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->declaracion)->get();
        //->Orwhere('inspector_id',$user)->where('estado',$this->declaracion)->get();
        return view('Inspector.index',compact('solicitudesNuevas','solicitudesReenviadas','solicitudRechazadaFirma','solicitudDeclaracionesNuevas'));
        }
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //// matriz con todos los trabajadores  para identificar vigentes y desvinculados de primera nomina////////////////
        $array = (new EmpleadosCertificadoImport)->toArray($request->excel);
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
                    ////// recorrido de la matriz de los trabajadores de primera nomina //////////////////
                    while($this->num==0){
                        $this->matrizActual[$this->fil][$this->col]=trim($array[0][$this->cont]['RUT']);
                        $this->matrizActual[$this->fil][$this->col+1]=$array[0][$this->cont]['NOMBRE'];
                        $this->matrizActual[$this->fil][$this->col+2]=$array[0][$this->cont]['CARGO'];
                        
                        /// identificando estado del trabajador actual
                        if ($array[0][$this->cont]['FECHA-DESVINCULACION']!='' AND $array[0][$this->cont]['OBSERVACION']!=''){
                            $this->matrizActual[$this->fil][$this->col+3]=$array[0][$this->cont]['FECHA-DESVINCULACION'];
                            $this->matrizActual[$this->fil][$this->col+4]=$array[0][$this->cont]['OBSERVACION'];
                            $this->empleadosDesvinculados++;
                            $this->empleadoslRevisados++;
                        //// desvinculado en caso que solo traiga la fecha de desvinculaci??n
                        }elseif($array[0][$this->cont]['FECHA-DESVINCULACION']!='' AND $array[0][$this->cont]['OBSERVACION']==''){
                            $this->matrizActual[$this->fil][$this->col+4]='Desvinculado';
                            $this->empleadosDesvinculados++;
                            $this->empleadoslRevisados++;
                        }
        
                        //// proceso de identificado del vigente con alguna observaci??n
                        if ($array[0][$this->cont]['OBSERVACION']!='' AND $array[0][$this->cont]['FECHA-DESVINCULACION']==''){
                            $this->matrizActual[$this->fil][$this->col+4]=$array[0][$this->cont]['OBSERVACION'];
                            //$this->empleadosDesvinculados++;
                            $this->empleadoslRevisados++;
                        /// identificado del trabajor vigente sin ningun tipo de pbservaci??n
                        }elseif($array[0][$this->cont]['OBSERVACION']=='' AND $array[0][$this->cont]['FECHA-DESVINCULACION']==''){
                            $this->matrizActual[$this->fil][$this->col+4]='Vigente';
                            $this->empleadoslRevisados++;
                        }
            
                        $this->matrizActual[$this->fil][$this->col+5]=$array[0][$this->cont]['TOTAL-HABERES'];
                        $this->matrizActual[$this->fil][$this->col+6]=$array[0][$this->cont]['TOTAL-IMPONIBLE'];
                        $this->matrizActual[$this->fil][$this->col+7]=$array[0][$this->cont]['LIQUIDO-PAGO'];
                        $this->matrizActual[$this->fil][$this->col+8]=$array[0][$this->cont]['CONTINGENCIA-PREVISIONAL'];
                        $this->matrizActual[$this->fil][$this->col+9]=$array[0][$this->cont]['CONTINGENCIA-REMUNERACIONAL'];
                        $this->matrizActual[$this->fil][$this->col+10]=$array[0][$this->cont]['CONTINGENCIA-CONTRATO'];
                        $this->matrizActual[$this->fil][$this->col+11]=$array[0][$this->cont]['CONTINGENCIA-FINIQUITO'];
                        $this->matrizActual[$this->fil][$this->col+12]=$array[0][$this->cont]['FECHA-DESVINCULACION'];
                        $this->cont++;
                        $this->fil++;
                        if(trim($array[0][$this->cont]['RUT'])==NULL){
                            $this->num++;
                        }
                    } 
                    ///////////// fin de recorrido de la primera nomina para identificar vigentes del periodo y desvinculados del periodo
        
        
        
        // inicio de segunda nomina y busqueda de desvinculados
        $certificado=solicitudeproceso::where('id',$request->solicitud_id)->get();                      //datos para la solicitud
        $empleadosActuales=$this->matrizActual;                                                         //datos de los trabajadores actuales
        //dd($this->matrizActual);
        // busqueda del certificado 3 meses hacia atras
        $request->mes--;
        if ($request->mes==0){
            $request->mes=12;
            $request->anio--;
        }
        while($this->nMesBusqueda<4){
           
            if(strlen($request->mes)==1){
                $request->mes='0'.$request->mes;
            }
            //trabajadores del mes anterior
            $this->pivoteEmpleados='CERT-'.$request->estructura_id.'-'.$request->mes.'-'.$request->anio;    //pivote para trabajadores mes anterior 
           // dd($this->pivoteEmpleados);
            $certififcadoAnterior=certificado::where('pivote',$this->pivoteEmpleados)->get();
          //dd($certififcadoAnterior);
            foreach($certififcadoAnterior as $certAnt){
                if(!empty($certAnt->id)){
                    $this->nMesBusqueda=5;
                }else{
                    $request->mes--;
                    if ($request->mes==0){
                        $request->mes=12;
                        $request->anio--;
                    }
                }
            }
            $this->nMesBusqueda++;
        }
        foreach($certififcadoAnterior as $certAnt){
         
            if(!empty($certAnt->id)){
                $this->totalAnterior=$certAnt->dotacionFinal;
               
                // verificaci??n de segunda n??mina //////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////  
                        $certificado=solicitudeproceso::where('id',$request->solicitud_id)->get();                      //datos para la solicitud
                        $empleadosActuales=$this->matrizActual;                                                         //datos de los trabajadores actuales
                       
                        $certififcadoAnterior=certificado::where('pivote',$this->pivoteEmpleados)->get();
                        //dd(  $certififcadoAnterior);
                        foreach($certififcadoAnterior as $certificadoAnteriorDatos){
                            $this->totalAnterior=$certificadoAnteriorDatos->dotacionFinal;
                            $this->pivoteEmpleados=$certificadoAnteriorDatos->pivote;
                            //dd($this->pivoteEmpleados);
                        }

                        
                        $empleadosAnteriores=empleadoscertificado::where('pivote',$this->pivoteEmpleados)->get();
                        //dd($empleadosAnteriores);
                        $this->cont=0;
                        $this->fil=0;
                        $this->col=0;
                
                        foreach($empleadosAnteriores as $empleadoAnterior){
                            
                            $this->siExiste=0;   
                           
                            for($i=0;$i<count($empleadosAnteriores);$i++){
                       
                                if($empleadoAnterior->rut==$array[0][$i]['RUT'])
                                {
                                         $this->siExiste++;
                                }
                            }
                            
                                
                            if($this->siExiste==0 AND $empleadoAnterior->fechaRetiro==null)
                            {
                                $this->matrizSegundaNomina[$this->fil][$this->col]=$empleadoAnterior->rut;
                                $this->matrizSegundaNomina[$this->fil][$this->col+1]=$empleadoAnterior->nombre;
                                $this->empleadosDesvinculadosSN++;
                                $this->fil++;
                                $this->siExiste=0;
                            }

                
                        }
                        /////////////// trabajadores nuevooossssssssssssss//////////
                        $empleadosCertificadosAterior=certificado::with('empleadoscertificado')->where('pivote',$this->pivoteEmpleados)->get();
                        //dd($empleadosCertificadosAterior);
                        if(!empty($empleadosCertificadosAterior)){
                            foreach($empleadosCertificadosAterior as $Anteriores){
                                
                               $this->anteriorSegundaNomina=$Anteriores->empleadoscertificado;
                               //dd($this->anteriorSegundaNomina);
                            }
                            
                            //busqueda de los trabajadores nuevos en planilla actual y con fecha de desvinculacion anterior//////
                            $this->num=0;
                            $this->cont=0;
                            while ($this->num==0){
                                for($i=0;$i<count($this->anteriorSegundaNomina);$i++){
                                    if(trim($array[0][$this->cont]['RUT'])==$this->anteriorSegundaNomina[$i]->rut){
                                        $this->siExiste++;
                                        if($this->anteriorSegundaNomina[$i]->fechaRetiro!=null){
                                            $this->empleadosNuevos++;
                                            $this->siExiste--;
                                        }
                                        
                                    }
                                }
                                if($this->siExiste==0){
                                    $this->empleadosNuevos++;
                                }
                                $this->cont++;
                                if(trim($array[0][$this->cont]['RUT'])==NULL)
                                {
                                    $this->num++;
                                }
                            }
                            
                                   
                        }
                   
                        $observacionPlanilla=$array[0][0]['PLANILLA-OBSERVACION'];
                        $fechaPagoCotizaciones=$array[0][0]['FECHA-PAGO-COTIZACIONES'];
                        $TotalEmpleadosNuevos=$this->empleadosNuevos;
                        $empleadosSegundaNomina=$this->matrizSegundaNomina;
                        $DotacionFinalAnterior=$this->totalAnterior;
                        $RetirosOfiniquitos=$this->empleadosDesvinculados;
                        $totalRevisados=$this->empleadoslRevisados;
                        $totalDesvinculadosSN=$this->empleadosDesvinculadosSN;
                        return view('Certificados.certificado',compact('certificado','empleadosActuales','empleadosSegundaNomina','DotacionFinalAnterior','RetirosOfiniquitos','TotalEmpleadosNuevos','observacionPlanilla','fechaPagoCotizaciones','totalRevisados','totalDesvinculadosSN'));
                    
                // fin de verificaci??n para segunda n??mina /////////////////////////////////////////////////////////////////////////////
            }
        }


        $empleadosSegundaNomina=$this->matrizSegundaNomina;
        $DotacionFinalAnterior=$this->totalAnterior;
        $RetirosOfiniquitos=$this->empleadosDesvinculados;
        $TotalEmpleadosNuevos=$this->empleadoslRevisados;
        $observacionPlanilla=$array[0][0]['PLANILLA-OBSERVACION'];
        $fechaPagoCotizaciones=$array[0][0]['FECHA-PAGO-COTIZACIONES'];
        $totalRevisados=$this->empleadoslRevisados;
        $totalDesvinculadosSN=0;
        return view('Certificados.certificado',compact('certificado','empleadosActuales','empleadosSegundaNomina','DotacionFinalAnterior','RetirosOfiniquitos','TotalEmpleadosNuevos','observacionPlanilla','fechaPagoCotizaciones','totalRevisados','totalDesvinculadosSN'));

    }

    public function EnvioSolicitudCertificadoFirma(request $request){
  
        $user = auth()->User()->id;
        $solicitud=solicitudeproceso::where('id',$request->solicitud_id)->first();
        $certificado=certificado::create([
            'estructura_id'=>$solicitud->estructura_id,
            'mes'=>$solicitud->mes,
            'nmes'=>$solicitud->mes,
            'anio'=>$solicitud->ano,
            'obs1'=>$request->observacion_1,
            'obs2'=>$request->observacion_2,
            'obs3'=>$request->observacion_3,
            'obs4'=>$request->observacion_4,
            'montoRemuneracional'=>$request->monto_remumeracional,
            'montoPrevisional'=>$request->monto_previsional,
            'empleadosMesAnterior'=>$request->dotacionMesAnterior,
            'vistoContrato'=>$request->rev_contrato,
            'vistoFiniquito'=>$request->rev_finiquito,
            'vistoSueldo'=>$request->rev_planillaSueldos,
            'vistoPrevision'=>$request->rev_cotizacionesPrevisionales,
            'empleadoNuevos'=>$request->TotalEmpleadosNuevos,
            'retirosFiniquitos'=>$request->totalDesvinculados,
            'totalRevizados'=>$request->totalRevisados,
            'dotacionFinal'=>$request->dotacionFinal,
            'responsableInspeccion_id'=>$user,
            'solicitud_id'=>$request->solicitud_id,
            'estado'=>'Enviado a Firma',
            'pivote'=>'CERT-'.$solicitud->estructura_id.'-'.$solicitud->mes.'-'.$solicitud->ano,
            'abreviacion'=>'CERT-',
            'nominaExtendida'=>$request->nominaExtendida,
            'contratoVisible'=>$request->contratoVisible,
            'segundaNomina'=>$request->segundaNomina,
        ]);
      
        $this->matrizActual=$request->rut;
        $this->max=count($this->matrizActual);
        $this->fil=0;
        for($i=0;$i<$this->max;$i++){
            $empleadosCertificado=empleadoscertificado::create([
                'certificado_id'=>$certificado->id,
                'rut'=>$request->rut[$this->fil],
                'nombre'=>$request->nombre[$this->fil],
                'cargo'=>$request->cargo[$this->fil],
                'estado'=>$request->estado[$this->fil],
                'fechaRetiro'=>$request->fecha_retiro[$this->fil],
                'pivote'=>'CERT-'.$solicitud->estructura_id.'-'.$solicitud->mes.'-'.$solicitud->ano,
                'estado'=>$request->estado[$this->fil],
                'totalHaberes'=>$request->trabajador_haber[$this->fil],
                'totalImponibles'=>$request->trabajador_imponible[$this->fil],
                'liquidoPago'=>$request->liquidoPago[$this->fil],
                'contingenciaPrevisional'=>$request->contingenciaPrevisional[$this->fil],
                'contingenciaRemuneracional'=>$request->contingenciaRemuneracional[$this->fil],
                'contingenciaContrato'=>$request->contingenciaContrato[$this->fil],
                'contingenciaFiniquito'=>$request->contingenciaFiniquito[$this->fil],
                'hojaNomina'=>1,
            ]);
            $this->fil++;
        }
        $this->num=0;
        $this->fil=0;
        if($request->rut_sn!=null)
        {
            $this->matrizActual=$request->rut_sn;
            $this->max=count($this->matrizActual);
            for($i=0;$i<$this->max;$i++){
                $empleadosCertificado=empleadoscertificado::create([
                    'certificado_id'=>$certificado->id,
                    'rut'=>$request->rut_sn[$this->fil],
                    'nombre'=>$request->nombre_sn[$this->fil],
                   
                    'estado'=>$request->estado[$this->fil],
                 
                    'pivote'=>'CERT-'.$solicitud->estructura_id.'-'.$solicitud->mes.'-'.$solicitud->ano,
                    'estado'=>$request->causalSegundaNomina[$this->fil],
                    
                    'hojaNomina'=>2,
                ]);
                $this->fil++;
            }
        }
        //llenado de planilla certificado con nomina 1
        $this->matrizActual=$request->rut;
        $this->max=count($this->matrizActual);
        $this->fil=0;
        $this->obs_pla=explode(',',$request->observacion_1);
        for($i=0;$i<$this->max;$i++){
            $planillacertificado=planillacertificado::create([
                'HOLDING_ASOCIADO'=>$solicitud->estructura->empresa->mutualidad,
                'CERTIFICADO'=>$certificado->id,
                'RUT_CONTRATISTA'=>$solicitud->estructura->empresa->rut,
                'RAZON_SOCIAL_CONTRATISTA'=>$solicitud->estructura->empresa->nombre,
                'RUT_MANDANTE'=>$solicitud->estructura->proyecto->empresa->rut,
                'RAZON_SOCIAL_MANDANTE'=>$solicitud->estructura->proyecto->empresa->nombre,
                'RUT_TRABAJADOR'=>$request->rut[$i],
                'NOMBRE_TRABAJADOR'=>$request->nombre[$i],
                'PERIODO_MES'=>$solicitud->mes,
                'PERIODO_ANIO'=>$solicitud->ano,
                'ESTADO_TRABAJADOR'=>$request->estado[$i],
                'LIQUIDO_A_PAGO'=>$request->liquidoPago[$i],
                'TOTAL_HABERES'=>$request->trabajador_haber[$i],
                'TOTAL_IMPONIBLE'=>$request->trabajador_imponible[$i],
                'OBSERVACION_PLANILLA'=>$this->obs_pla[0],
                'OBSERVACION_REMUNERACIONAL'=>$request->monto_remumeracional,
                'OBSERVACION_PREVISIONAL'=>$request->monto_previsional,
                'CONTRATO_CONTRATISTA'=>$solicitud->estructura->contrato,
                'PROYECTO_CONTRATISTA'=>$solicitud->estructura->proyecto->proyecto,
                'RUT_CONTRATISTA_X_SUBCONTRATISTA'=>$solicitud->estructura->contratistasubcontrato->rut,
                'NUMERO_SOLICITUD'=>$request->solicitud_id,
                'OBSERVACION_CONTRATO'=>$request->contingenciaContrato[$i],
            ]);
        }
        // fin de llenado nomina 1
        //llenado de planilla certificado con nomina 2
        if($request->rut_sn!=null)
        {
            $this->matrizActual=$request->rut_sn;
            $this->max=count($this->matrizActual);
            $this->fil=0;
            $this->obs_pla=explode(',',$request->observacion_1);
            for($i=0;$i<$this->max;$i++){
                $planillacertificado=planillacertificado::create([
                    'HOLDING_ASOCIADO'=>$solicitud->estructura->empresa->mutualidad,
                    'CERTIFICADO'=>$certificado->id,
                    'RUT_CONTRATISTA'=>$solicitud->estructura->empresa->rut,
                    'RAZON_SOCIAL_CONTRATISTA'=>$solicitud->estructura->empresa->nombre,
                    'RUT_MANDANTE'=>$solicitud->estructura->proyecto->empresa->rut,
                    'RAZON_SOCIAL_MANDANTE'=>$solicitud->estructura->proyecto->empresa->nombre,
                    'RUT_TRABAJADOR'=>$request->rut_sn[$i],
                    'NOMBRE_TRABAJADOR'=>$request->nombre_sn[$i],
                    'PERIODO_MES'=>$solicitud->mes,
                    'PERIODO_ANIO'=>$solicitud->ano,
                    'ESTADO_TRABAJADOR'=>$request->causalSegundaNomina[$i],
                    'LIQUIDO_A_PAGO'=>0,
                    'TOTAL_HABERES'=>0,
                    'TOTAL_IMPONIBLE'=>0,
                    'OBSERVACION_PLANILLA'=>$this->obs_pla[0],
                    'OBSERVACION_REMUNERACIONAL'=>0,
                    'OBSERVACION_PREVISIONAL'=>0,
                    'CONTRATO_CONTRATISTA'=>$solicitud->estructura->contrato,
                    'PROYECTO_CONTRATISTA'=>$solicitud->estructura->proyecto->proyecto,
                    'RUT_CONTRATISTA_X_SUBCONTRATISTA'=>$solicitud->estructura->contratistasubcontrato->rut,
                    'NUMERO_SOLICITUD'=>$request->solicitud_id,
                    'OBSERVACION_CONTRATO'=>0,
                ]);
            }
        }
        // fin de llenado nomina 2
        $this->estado="Aprobada";
        $act=solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>$this->estado,'certificadoNombre'=>$certificado->id,'certificado'=>'Revisar Certificado']);
        //dd($act);
        
        $this->estado="Asignada";
        $user = auth()->User()->id;
        //$seguimiento=seguimiento::all();
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada',NULL)->get();
        //dd($solicitudesNuevas);
        $solicitudesReenviadas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada','>',0)->get();
        $solicitudRechazadaFirma=solicitudeproceso::where('inspector_id',$user)->where('estado','=','Rechazada')->where('observacionRechazo','!=',NULL)->get();
        $solicitudDeclaracionesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->declaracion)->get();
        //->Orwhere('inspector_id',$user)->where('estado',$this->declaracion)->get();
        return view('Inspector.index',compact('solicitudesNuevas','solicitudesReenviadas','solicitudRechazadaFirma','solicitudDeclaracionesNuevas'));
    }

    public function revisionCertificado(request $request){
//dd($request);
        $certificado=certificado::with('empleadoscertificado')->where('id',$request->certificado_id)->get();
        foreach($certificado as $cert){
            $this->mes=$cert->nmes;
            $this->anio=$cert->anio;
            $this->estructura_id=$cert->estructura_id;
            $this->periodo=$this->anio.'-'.$this->mes;
           // dd($this->periodo);
        }
        $evidencia=documento::where('estructura_id',$this->estructura_id)->where('documento', 'LIKE','%'.$this->periodo.'%')->get();
        $certificadoReemplazo=$request->certificadoReemplazo;
        //dd($documentos);
        //dd($request->certificado_id);
        return view('Certificados.certificadoRevision',compact('certificado','evidencia','certificadoReemplazo'));
    }

    public function rechazoCertificado(request $request){
        //dd($request);
        $this->estado="Rechazada";
        $actualizacionCertificado=certificado::where('id',$request->certificado_id)->update(['estado'=>'Rechazado','observacionRechazo'=>$request->observacionRechazo]);
        $actualizarSolicitud=solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>'Rechazada','observacionRechazo'=>$request->observacionRechazo]);
        $solicitudes=solicitudeproceso::where('certificado','!=','')->where('estado',$this->aprobada)->get();
        return view('Admin.solicitudesxAprobar',compact('solicitudes'));
    }
    public function certificadoRechazadoEdicion(request $request){
        //dd($request);
        $certificado=certificado::with('empleadoscertificado')->where('id',$request->certificado_id)->get();
        return view('Certificados.EdicionRechazoCertificado',compact('certificado'));

    }
    public function firmaCertificado(request $request){
        return "ok2";
    }
    public function verCertificado(request $request){
        //dd($request);
        $certificado=certificado::with('empleadoscertificado')->where('id',$request->certificado_id)->get();
        $dompdf = App::make("dompdf.wrapper");
        $insp=solicitudeproceso::where('id',$request->solicitud_id)->get();

        $dompdf->loadView("Certificados.certificadoPDF",compact('certificado','insp'))->setPaper('letter');
        return $dompdf->stream();
       
    }

    public function enviarXrechazo(request $request){
        $this->estado='Aprobada';
        $actualizacionSolicitud=solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>$this->estado,'observacionRechazo'=>$request->observacionRechazo,'certificado'=>'Revisar Certificado']);
        $actualizacionCertificado=certificado::where('id',$request->certificado_id)->update(['estado'=>'Enviada a Firma','observacionRechazo'=>$request->observacionRechazo]);

        $this->estado="Asignada";
        $user = auth()->User()->id;
        //$seguimiento=seguimiento::all();
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada',NULL)->get();
        //dd($solicitudesNuevas);
        $solicitudesReenviadas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->where('observacionRechazo',NULL)->where('nreenviada','>',0)->get();
        $solicitudRechazadaFirma=solicitudeproceso::where('inspector_id',$user)->where('estado','=','Rechazada')->where('observacionRechazo','!=',NULL)->get();
        $solicitudDeclaracionesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->declaracion)->get();
        //->Orwhere('inspector_id',$user)->where('estado',$this->declaracion)->get();
        return view('Inspector.index',compact('solicitudesNuevas','solicitudesReenviadas','solicitudRechazadaFirma','solicitudDeclaracionesNuevas'));
    }

    public function certificadoReemplazo(request $request){

        //dd($request);
        $array = (new EmpleadosCertificadoImport)->toArray($request->excel);
        //dd($array);
        ///// recorrido de la matriz //////
            ////// recorrido de la matriz de los trabajadores de primera nomina //////////////////
            while($this->num==0){
            
                $this->matrizActual[$this->fil][$this->col]=trim($array[0][$this->cont]['RUT']);
                        $this->matrizActual[$this->fil][$this->col+1]=$array[0][$this->cont]['NOMBRE'];
                        $this->matrizActual[$this->fil][$this->col+2]=$array[0][$this->cont]['CARGO'];
                        
                        /// identificando estado del trabajador actual
                        if ($array[0][$this->cont]['FECHA-DESVINCULACION']!='' AND $array[0][$this->cont]['OBSERVACION']!=''){
                            $this->matrizActual[$this->fil][$this->col+3]=$array[0][$this->cont]['FECHA-DESVINCULACION'];
                            $this->matrizActual[$this->fil][$this->col+4]=$array[0][$this->cont]['OBSERVACION'];
                            $this->empleadosDesvinculados++;
                            $this->empleadoslRevisados++;
                        //// desvinculado en caso que solo traiga la fecha de desvinculaci??n
                        }elseif($array[0][$this->cont]['FECHA-DESVINCULACION']!='' AND $array[0][$this->cont]['OBSERVACION']==''){
                            $this->matrizActual[$this->fil][$this->col+4]='Desvinculado';
                            $this->empleadosDesvinculados++;
                            $this->empleadoslRevisados++;
                        }
        
                        //// proceso de identificado del vigente con alguna observaci??n
                        if ($array[0][$this->cont]['OBSERVACION']!='' AND $array[0][$this->cont]['FECHA-DESVINCULACION']==''){
                            $this->matrizActual[$this->fil][$this->col+4]=$array[0][$this->cont]['OBSERVACION'];
                            //$this->empleadosDesvinculados++;
                            $this->empleadoslRevisados++;
                        /// identificado del trabajor vigente sin ningun tipo de pbservaci??n
                        }elseif($array[0][$this->cont]['OBSERVACION']=='' AND $array[0][$this->cont]['FECHA-DESVINCULACION']==''){
                            $this->matrizActual[$this->fil][$this->col+4]='Vigente';
                            $this->empleadoslRevisados++;
                        }
                $this->matrizActual[$this->fil][$this->col+5]=$array[0][$this->cont]['TOTAL-HABERES'];
                $this->matrizActual[$this->fil][$this->col+6]=$array[0][$this->cont]['TOTAL-IMPONIBLE'];
                $this->matrizActual[$this->fil][$this->col+7]=$array[0][$this->cont]['LIQUIDO-PAGO'];
                $this->matrizActual[$this->fil][$this->col+8]=$array[0][$this->cont]['CONTINGENCIA-PREVISIONAL'];
                $this->matrizActual[$this->fil][$this->col+9]=$array[0][$this->cont]['CONTINGENCIA-REMUNERACIONAL'];
                $this->matrizActual[$this->fil][$this->col+10]=$array[0][$this->cont]['CONTINGENCIA-CONTRATO'];
                $this->matrizActual[$this->fil][$this->col+11]=$array[0][$this->cont]['CONTINGENCIA-FINIQUITO'];
                $this->matrizActual[$this->fil][$this->col+12]=$array[0][$this->cont]['FECHA-DESVINCULACION'];
               
                $this->cont++;
                $this->fil++;
                if(trim($array[0][$this->cont]['RUT'])==NULL){
                    $this->num++;
                }
            } 

        //// fin recorrido de la matriz /////
        $empleadosActuales=$this->matrizActual;
        $observacionPlanilla=$array[0][0]['PLANILLA-OBSERVACION'];
        $fechaPagoCotizaciones=$array[0][0]['FECHA-PAGO-COTIZACIONES'];
        $certificado=solicitudeproceso::where('id',$request->solicitud_id)->get();
        $tipo=$request->tipo;
        return view('Certificados.certificadoReemplazo',compact('empleadosActuales','certificado','observacionPlanilla','fechaPagoCotizaciones','tipo'));
    }

    public function enviarCertificadoReemplazoRevision(request $request){

        //dd($request);
        // creaci??n del certificado en reemplazo //
        $user = auth()->User()->id;
        $solicitud=solicitudeproceso::where('id',$request->solicitud_id)->first();
        $certificado=certificado::create([
            'estructura_id'=>$solicitud->estructura_id,
            'mes'=>$solicitud->mes,
            'nmes'=>$solicitud->mes,
            'anio'=>$solicitud->ano,
            'obs1'=>$request->observacion_1,
            'obs2'=>$request->observacion_2,
            'obs3'=>$request->observacion_3,
            'obs4'=>$request->observacion_4,
            'montoRemuneracional'=>$request->monto_remumeracional,
            'montoPrevisional'=>$request->monto_previsional,
            'empleadosMesAnterior'=>$request->dotacionMesAnterior,
            'vistoContrato'=>$request->rev_contrato,
            'vistoFiniquito'=>$request->rev_finiquito,
            'vistoSueldo'=>$request->rev_planillaSueldos,
            'vistoPrevision'=>$request->rev_cotizacionesPrevisionales,
            'empleadoNuevos'=>$request->TotalEmpleadosNuevos,
            'retirosFiniquitos'=>$request->totalDesvinculados,
            'totalRevizados'=>$request->totalRevisados,
            'dotacionFinal'=>$request->dotacionFinal,
            'responsableInspeccion_id'=>$user,
            'solicitud_id'=>$request->solicitud_id,
            'estado'=>'Enviado a Firma',
            'pivote'=>'CERT-'.$solicitud->estructura_id.'-'.$solicitud->mes.'-'.$solicitud->ano,
            'abreviacion'=>'DEREEMPLAZO-',
            'nominaExtendida'=>$request->nominaExtendida,
            'contratoVisible'=>$request->contratoVisible,
            'segundaNomina'=>$request->segundaNomina,
        ]);
      
        $this->matrizActual=$request->rut;
        $this->max=count($this->matrizActual);
        $this->fil=0;
        for($i=0;$i<$this->max;$i++){
            $empleadosCertificado=empleadoscertificado::create([
                'certificado_id'=>$certificado->id,
                'rut'=>$request->rut[$this->fil],
                'nombre'=>$request->nombre[$this->fil],
                'cargo'=>$request->cargo[$this->fil],
                'estado'=>$request->estado[$this->fil],
                'fechaRetiro'=>$request->fecha_retiro[$this->fil],
                'pivote'=>'CERT-'.$solicitud->estructura_id.'-'.$solicitud->mes.'-'.$solicitud->ano,
                'estado'=>$request->estado[$this->fil],
                'totalHaberes'=>$request->trabajador_haber[$this->fil],
                'totalImponibles'=>$request->trabajador_imponible[$this->fil],
                'liquidoPago'=>$request->liquidoPago[$this->fil],
                'contingenciaPrevisional'=>$request->contingenciaPrevisional[$this->fil],
                'contingenciaRemuneracional'=>$request->contingenciaRemuneracional[$this->fil],
                'contingenciaContrato'=>$request->contingenciaContrato[$this->fil],
                'contingenciaFiniquito'=>$request->contingenciaFiniquito[$this->fil],
                'hojaNomina'=>1,
            ]);
            $this->fil++;
        }
            /// llenado de planilla certificado //
                 //llenado de planilla certificado con nomina 1
        $this->matrizActual=$request->rut;
        $this->max=count($this->matrizActual);
        $this->fil=0;
        $this->obs_pla=explode(',',$request->observacion_1);
        for($i=0;$i<$this->max;$i++){
            $planillacertificado=planillacertificado::create([
                'HOLDING_ASOCIADO'=>$solicitud->estructura->empresa->mutualidad,
                'CERTIFICADO'=>$certificado->id,
                'RUT_CONTRATISTA'=>$solicitud->estructura->empresa->rut,
                'RAZON_SOCIAL_CONTRATISTA'=>$solicitud->estructura->empresa->nombre,
                'RUT_MANDANTE'=>$solicitud->estructura->proyecto->empresa->rut,
                'RAZON_SOCIAL_MANDANTE'=>$solicitud->estructura->proyecto->empresa->nombre,
                'RUT_TRABAJADOR'=>$request->rut[$i],
                'NOMBRE_TRABAJADOR'=>$request->nombre[$i],
                'PERIODO_MES'=>$solicitud->mes,
                'PERIODO_ANIO'=>$solicitud->ano,
                'ESTADO_TRABAJADOR'=>$request->estado[$i],
                'LIQUIDO_A_PAGO'=>$request->liquidoPago[$i],
                'TOTAL_HABERES'=>$request->trabajador_haber[$i],
                'TOTAL_IMPONIBLE'=>$request->trabajador_imponible[$i],
                'OBSERVACION_PLANILLA'=>$this->obs_pla[0],
                'OBSERVACION_REMUNERACIONAL'=>$request->monto_remumeracional,
                'OBSERVACION_PREVISIONAL'=>$request->monto_previsional,
                'CONTRATO_CONTRATISTA'=>$solicitud->estructura->contrato,
                'PROYECTO_CONTRATISTA'=>$solicitud->estructura->proyecto->proyecto,
                'RUT_CONTRATISTA_X_SUBCONTRATISTA'=>$solicitud->estructura->contratistasubcontrato->rut,
                'NUMERO_SOLICITUD'=>$request->solicitud_id,
                'OBSERVACION_CONTRATO'=>$request->contingenciaContrato[$i],
            ]);
        }
        // fin de llenado nomina 1
            /// fin de llenado de planilla certificado //



        $this->num=0;
        $this->fil=0;
        if($request->rut_sn!=null)
        {
            $this->matrizActual=$request->rut_sn;
            $this->max=count($this->matrizActual);
            for($i=0;$i<$this->max;$i++){
                $empleadosCertificado=empleadoscertificado::create([
                    'certificado_id'=>$certificado->id,
                    'rut'=>$request->rut_sn[$this->fil],
                    'nombre'=>$request->nombre_sn[$this->fil],
                   
                    'estado'=>$request->estado[$this->fil],
                 
                    'pivote'=>'CERT-'.$solicitud->estructura_id.'-'.$solicitud->mes.'-'.$solicitud->ano,
                    'estado'=>$request->causalSegundaNomina[$this->fil],
                    
                    'hojaNomina'=>2,
                ]);
                $this->fil++;
            }
        }

        //dd($certificado);
        // fin de creaci??n de certificado en reemplazo //

        $solicitud=solicitudeproceso::where('id',$request->solicitud_id)->update(['certificadoReemplazo'=>$request->certificadoAnterior,'certificadoNombre'=>$certificado->id,'estado'=>'Aprobada']);
        // 1.- se crea el nuevo certificado con sus trabajadores y se reemplaza el numero de certificado en la solicitud
        // 2.- el numero de certificado original pasa a certificadoReemplazo
        // 3.- se vuelve la solicitud al estado de aprobada para ser visible por el administrador, donde continua el ciclo normal.
        $user = auth()->User()->id;
        $this->estado="Liberada";
       // dd($this->estado);
        $solicitudesNuevas=solicitudeproceso::where('inspector_id',$user)->where('estado',$this->estado)->get();

        return view('Inspector.solicitudesFinalizadas',compact('solicitudesNuevas'));

    }

    public function rechazosolicitudreemplazo(request $request){
        empleadoscertificado::where('certificado_id',$request->certificado_id)->delete();
        certificado::where('id',$request->certificado_id)->delete();
        solicitudeproceso::where('id',$request->solicitud_id)->update(['estado'=>'Liberada']);
        $solicitudes=solicitudeproceso::where('certificado','!=','')->where('estado',$this->aprobada)->get();
    return view('Admin.solicitudesxAprobar',compact('solicitudes'));
        //dd($request);
    }
}
