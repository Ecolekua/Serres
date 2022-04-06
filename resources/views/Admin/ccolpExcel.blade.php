@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Solicitudes Nuevas para Inspección Cuantitativa y Derivación a Inspectores
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
                   
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th>Mandante</th>
                                <th>Id</th>
                                <th>Razón Social Mandante</th>
                                <th>Rut Mandante</th>
                                <th>Obra</th>
                                <th>Razón Social Contratista</th>
                                <th>Rut Contratista  </th>
                                <th>Período CCOLP</th>
                                <th>Periodo a CCOLP Mes</th>
                                <th>N° de Trabajadores a Certificar</th>
                                <th>N° Contrato o Servicio Prestado Informa Contratista</th>
                                <th>Contacto Nombre</th>
                                <th>Contacto Tel.</th>
                                <th>Contacto Email</th>
                                <th>Estado Certificación</th>
                               
                                <th>Fecha Recepción</th>
                                <th>Fecha Emisión</th>
                                <th>Ejecutivo Asignado</th>
                                <th>N° Certificado</th>
                                <th>N° Factura</th>
                                <th>Pagado Si/No</th>
                                <th>Días Hábiles</th>
                                


                           
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($solicitudes as $solicitud)
                           <tr>
                                <th>{{ $solicitud->estructura->proyecto->empresa->mutualidad}} </th>
                                <th>{{ $solicitud->id}}</th>
                                <th>{{ $solicitud->estructura->proyecto->empresa->nombre}} </th>
                                <th>{{ $solicitud->estructura->proyecto->empresa->rut}}</th>
                                <th>{{ $solicitud->estructura->proyecto->proyecto}}</th>
                                <th>{{ $solicitud->estructura->empresa->nombre}}</th>
                                <th>{{ $solicitud->estructura->empresa->rut}}</th>
                              
                                <th>{{ $solicitud->mes}}-{{ $solicitud->ano}}</th> 
                                <th></th>
                                <th>{{ $solicitud->totalvigentes}}</th>
                                <th>{{ $solicitud->estructura->contrato}}</th>
                                <th>{{ $solicitud->estructura->empresa->nomContacto}}</th>
                                <th></th>
                                <th>{{ $solicitud->estructura->empresa->emailContacto}}</th>
                                <th>
                                @if ($solicitud->estado=="Guardada")
                                        INICIADA
                                    
                                    @elseif ($solicitud->estado=="Enviada")
                                        RECIBIDO
                                    @elseif($solicitud->estado=="Asignada")
                                        EN REVISION
                                        @elseif($solicitud->estado=="Rechazada")
                                        CON OBSERVACIONES
                                    @elseif($solicitud->estado=="Liberada")
                                        APROBADA
                                
                                    @endif
                                
                            
                            
                                </th>
                                <th>
                              
                                {{$solicitud->fechaEnvio}}

                                </th>
                                <th></th>
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
                                @endif
                               </th>

                                   

                                </th>
                                <th>{{ $solicitud->certificado}}</th>
                                <th>{{ $solicitud->nfactura}}</th>
                                <th></th>
                                <th></th>
                            </tr>
                        @endforeach    
                        </tbody>
                    <tfoot>
                        <tr>
                                <!-- <th>Id</th>
                                <th>Razón Social Mandante</th>
                                <th>Rut Mandante</th>
                                <th>Obra</th>
                                <th>Razón Social Contratista</th>
                                <th>Rut Contratista  </th>
                                <th>Período CCOLP</th>
                                <th>Periodo a CCOLP Mes</th>
                                <th>N° de Trabajadores a Certificar</th>
                                <th>N° Contrato o Servicio Prestado Informa Contratista</th>
                                <th>Contacto Nombre</th>
                                <th>Contacto Tel.</th>
                                <th>Contacto Email</th>
                                <th>Estado Certificación</th>
                                <th>Fecha Recepción</th>
                                <th>Fecha Emisión</th>
                                <th>Ejecutivo Asignado</th>
                                <th>N° Certificado</th>
                                <th>N° Factura</th>
                                <th>Pagado Si/No</th>
                                <th>Días Hábiles</th> -->
                                
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                        
                            
                            </tr>
                        </tfoot>
                    </table>
                    <!-- fin contenido  -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection