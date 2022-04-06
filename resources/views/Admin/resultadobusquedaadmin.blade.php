@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Solicitudes Aprobadas y Guardadas
                    <span class="float-right">
                        <!-- @can('usuconforms.create')
                            <a href="{{ route('usuconforms.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Asignar Contratistas a Usuarios para Administrar Solicitudes</a>
                        @endcan   -->
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Contenido -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Rut Contratista</th>
                                <th scope="col">Contratista</th>
                                <th scope="col">Tipo de Solcitud</th>
                                <th scope="col">Periodo a Certificar</th>
                                <th scope="col">Fecha Recepción</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Certificado</th>
                                <th scope="col">Inspector</th>
                                <th scope="col">Bitácora</th>
                                <th scope="col">Ver Solicitud</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($solicitudesEnviadas as $solicitud)
                            <tr>
                                <th scope="row">{{ $solicitud->id}}</th>
                                <th scope="row">{{ $solicitud->estructura->empresa->rut}}</th>
                                <th scope="row">{{ $solicitud->estructura->empresa->nombre}}</th>
                                <th>
                                @if($solicitud->usuconformulario->formulario==1)
                                    Certificación
                                @elseif($solicitud->usuconformulario->formulario==2)
                                    Certificación de Documentación
                                @endif
                                </th>  
                                <th scope="row">{{ $solicitud->mes}}-{{ $solicitud->ano}}</th> 
                                <th scope="row">{{ $solicitud->created_at}}</th> 
                                <!-- <th scope="row">{{ $solicitud->fechaEnvio}}</th> -->
                               
                                
                               
                                <th>
                                @if ($solicitud->estado=="Guardada")
                                        INICIADA
                                    
                                    @elseif ($solicitud->estado=="Enviada")
                                        RECIBIDO
                                    @elseif($solicitud->estado=="Asignada")
                                        @if ($solicitud->nreenviada>0)
                                                REENVIADA
                                            @else
                                                EN REVISION
                                            @endif
                                    @elseif($solicitud->estado=="Rechazada")
                                        CON OBSERVACIONES
                                               
                                    @elseif($solicitud->estado=="Liberada")
                                        APROBADA
                                        @elseif($solicitud->estado=="Aprobada")
                                        APROBADA
                                
                                    @endif
                                
                            
                            
                                </th>

                                

                                 <th scope="row">
                                    <!-- @if($solicitud->estado=="Liberada")
                                        <a href="<?php echo 'http://www.serresverificadora.cl/administrador/generador_certificado.php?ncert='.$solicitud->certificado ?>" target="_blank">Certificado</a>
                                    @endif -->

                                @if($solicitud->certificadoNombre!=null AND $solicitud->firma_id!='')
                                    <a href="../{{$solicitud->certificadoRuta}}" target="_blank">CERTIFICADO</a>
                                @endif
                                @if($solicitud->estado=="Liberada" and $solicitud->certificadoNombre==null)
                                    <a href="<?php echo 'http://www.serresverificadora.cl/administrador/generador_certificado.php?ncert='.$solicitud->certificado ?>" target="_blank">CERTIFICADO</a>
                                @endif
                                @if($solicitud->estado!="Liberada" and $solicitud->certificadoNombre==null)
                                    N/D
                                @endif
                                   
                                </th> 
                                <th>
                                @if ($solicitud->inspector_id==1652)
                                    V3
                                @elseif($solicitud->inspector_id==3)
                                    IZ
                                @elseif($solicitud->inspector_id==1626)
                                    KS
                                @elseif($solicitud->inspector_id==1627)
                                    JQ
                                @elseif($solicitud->inspector_id==1628)
                                    LV
                                @elseif($solicitud->inspector_id==1629)
                                    RM
                                @elseif($solicitud->inspector_id==1630)
                                    YA
                                @elseif($solicitud->inspector_id==1631)
                                    AQ
                                @elseif($solicitud->inspector_id==1632)
                                    CG
                                @elseif($solicitud->inspector_id==1633)
                                    MD
                                @elseif($solicitud->inspector_id==1634)
                                    KM
                                @elseif($solicitud->inspector_id==1635)
                                    VVL
                                @elseif($solicitud->inspector_id==1669)
                                    Ricardo Jorquera
                                @elseif($solicitud->inspector_id==1733)
                                    ricardo jorquera diaz
                                @elseif($solicitud->inspector_id==1)
                                    AdministradorGeneral
                                @elseif($solicitud->inspector_id==4)
                                    Vladimir Varas Vial
                                @elseif($solicitud->inspector_id==6)
                                    Pedro Vargas
                                @elseif($solicitud->inspector_id==1774)
                                    EE
                                @elseif($solicitud->inspector_id==2083)
                                    CM
                                @elseif($solicitud->inspector_id==1813)
                                    RO
                                @elseif($solicitud->inspector_id==2267)
                                    PR
                                @elseif($solicitud->inspector_id==2465)
                                    CMO
                                @elseif($solicitud->inspector_id==2267)
                                    Prev-Riesgos1
                                @elseif($solicitud->inspector_id==1822)
                                    Arturo Aros Queglas
                                @elseif($solicitud->inspector_id==2142)
                                    AE
                                @elseif($solicitud->inspector_id==2714)
                                    DP
                                @elseif($solicitud->inspector_id==2218)
                                    typecode@typecode.cl
                                @elseif($solicitud->inspector_id==2265)
                                    Marilu Miranda
                                @elseif($solicitud->inspector_id==2163)
                                    CC
                                @elseif($solicitud->inspector_id==2570)
                                    TC
                                @elseif($solicitud->inspector_id==2686)
                                    AG
                                @elseif($solicitud->inspector_id==2456)
                                    ADMINISTRATIVO 2
                                @elseif($solicitud->inspector_id==2082)
                                    TypeCode SpA
                                @elseif($solicitud->inspector_id==2945)
                                    DG
                                @elseif($solicitud->inspector_id==2946)
                                    DS
                                @elseif($solicitud->inspector_id==3052)
                                    RR  
                                @elseif($solicitud->inspector_id==3080)
                                    JR 
                                @elseif($solicitud->inspector_id==3107)
                                    MM
                                @elseif($solicitud->inspector_id==3115)
                                    LU 
                                @elseif($solicitud->inspector_id==2327)
                                    Valentina Vargas  
                                @elseif($solicitud->inspector_id==3175)
                                    RN 
                                @elseif($solicitud->inspector_id==3174)
                                    AR  
                                @endif
                                </th>
                                 <th>
                                    <center><a href="{{ route('bitacora.index',$solicitud->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard-list"></i></a></center>
                              <!--  -->  </th>
                               <!-- <th scope="row">{{ $solicitud->estructura->contrato}}</th> -->

                            <th>
                            <center><a href="{{ route('solicitudesAdmin.show',$solicitud->id)}}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></a></center>
                            </th>
                        
                            </tr>
                        @endforeach    
                        </tbody>
                    </table>
                    <!-- fin contenido  -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection