@extends('layouts.app')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Solicitudes Enviadas y Observadas
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
                    <table class="table" id="tablaProyectos">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Mandante Asociado</th>
                            <th scope="col">Rut Contratista</th>
                            <th scope="col">Razón Social Contratista</th>
                            <th scope="col">Tipo de Solcitud</th>
                            <th scope="col">Periodo a Certificar</th>
                            <th>Fecha Recepción</th>
                            <th scope="col">Estado</th>
                            <!-- <th scope="col">Contratados</th>
                            <th scope="col">Desvinvulados</th>
                            <th scope="col">Otras Causas</th>
                            <th scope="col">Total Vigentes</th> -->
                                <th scope="col">Bitácora</th>
                                <th scope="col">Acción</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($solicitudesEnviadas as $solicitud)
                            <!-- <tr  style="color:blue" >
                                <th scope="row">{{ $solicitud->id}}</th>
                                <th>{{ $solicitud->estructura->proyecto->empresa->mutualidad}} </th>
                                <th scope="row">{{ $solicitud->estructura->empresa->rut}}</th>
                                <th scope="row">{{ $solicitud->estructura->empresa->nombre}}</th>
                                <th>
                                @if($solicitud->usuconformulario->formulario==1)
                                    Certificación
                                @elseif($solicitud->usuconformulario->formulario==2)
                                    Certificación de Documentación
                                @endif
                                </th>
                                <th scope="row">
                                @if($solicitud->usuconformulario->formulario==2)
                                    N/A 
                                @else

                                    {{ $solicitud->mes}}-{{ $solicitud->ano}}
                                @endif
                                
                                </th>
                                <th scope="row">
                                @if($solicitud->usuconformulario->formulario==2)
                                    N/A 
                                @else

                                {{ $solicitud->contratados}}
                            @endif
                            </th>
                                <th scope="row">
                                @if($solicitud->usuconformulario->formulario==2)
                                    N/A 
                                @else

                                {{ $solicitud->desvinculados}}
                            @endif
                            </th>
                                <th scope="row">
                                @if($solicitud->usuconformulario->formulario==2)
                                    N/A 
                                @else

                                {{ $solicitud->otrascausas}}
                                @endif
                            </th>
                                <th scope="row">{{ $solicitud->totalvigentes}}</th>
                                <th scope="row">
                                @if ($solicitud->estado=="Guardada")
                                        INICIADA
                                    
                                    @elseif ($solicitud->estado=="Enviada")
                                        RECIBIDO
                                    @elseif($solicitud->estado=="Asignada")
                                        EN REVISION
                                    @elseif($solicitud->estado="Rechazada")
                                        CON OBSERVACIONES
                                    @else
                                        {{$solicitud->estado}}
                                
                                    @endif
                                </th>
                                <th scope="row">{{ $solicitud->estructura->contrato}}</th> -->
                                <tr>
                                <th scope="row">{{ $solicitud->id}}</th>
                                <th>{{ $solicitud->estructura->proyecto->empresa->mutualidad}} </th>
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
                                <th>
                              
                              {{$solicitud->fechaEnvio}}

                              </th>
                                <!-- <th scope="row">{{ $solicitud->contratados}}</th>
                                <th scope="row">{{ $solicitud->desvinculados}}</th>
                                <th scope="row">{{ $solicitud->otrascausas}}</th>
                                <th scope="row">{{ $solicitud->totalvigentes}}</th> -->
                                <th scope="row">
                               <?php $dato=strlen(trim($solicitud->certificado)); ?>
                     
                                @if($solicitud->estado=="Rechazada")
                                CON OBSERVACIONES
                                @endif
                                @if($solicitud->estado=="Enviada")
                                   RECIBIDA
                                    
                                @endif
                                <!-- @if($solicitud->estado=="Guardada")
                                    Iniciada
                                @endif -->
                                </th>
                                <!-- <th scope="row">{{ $solicitud->estructura->contrato}}</th> -->
                                <th>
                                    <center><a href="{{ route('bitacora.index',$solicitud->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard-list"></i></a></center>
                                </th>
                                <th scope="row">

                                    @if($solicitud->estado=="Rechazada")
                                    <div class="col-xs-12 col-md-4">
                                        @can('solicitudesClienteEnviadas.crud')<a href="{{ route('solicitudesCliente.edit',$solicitud->id)}}" class="btn btn-sm btn-success"><i class="fas fa-user-check"></i></a>@endcan
                                    </div>
                                    @endif



                                </th>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    <!-- fin contenido  -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection