@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Solicitudes para Aprobar
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
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Rut Contratista  </th>
                                <th scope="col">Contratista</th>
                                <th scope="col">Rut Mandante</th>
                                <th scope="col">Razón Social Mandante</th>
                                <th scope="col">Tipo de Solcitud</th>
                                <th scope="col">Periodo a Certificar</th>
                                <th scope="col">Ver Certificado en Serresverificadora</th>
                                <!-- <th scope="col">Ingresos del Periodo</th>
                                <th scope="col">Art. 161 del Periodo</th>
                                <th scope="col">Desvinculados de Otras Causas del Periodo</th>
                                <th scope="col">N° Total de Trabajadores Vigentes en Obra</th>
                                <th scope="col">Bitácora</th> -->
                                <!-- <th scope="col">Revisar Detalle</th> -->
                                <th scope="col">Disponibilizar Certificado al Contratista</th>
                                <th scope="col">Rechazar Solicitud, Se devuelve al Inspector</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($solicitudes as $solicitud)
                           <tr>
                                <th scope="row">{{ $solicitud->id}}</th>
                                <th scope="row">{{ $solicitud->estructura->empresa->rut}}</th>
                                <th scope="row">{{ $solicitud->estructura->empresa->nombre}}</th>
                                <th scope="row">{{ $solicitud->estructura->proyecto->empresa->rut}}</th>
                                <th scope="row">{{ $solicitud->estructura->proyecto->empresa->nombre}} </th>
                                <th>
                                @if($solicitud->usuconformulario->formulario==1)
                                    Certificación
                                @else
                                    No Disponible
                                @endif
                                </th>  
                                <th scope="row">{{ $solicitud->mes}}-{{ $solicitud->ano}}</th> 
                                <!-- <th scope="row">{{ $solicitud->contratados}}</th>
                                <th scope="row">{{ $solicitud->desvinculados}}</th>
                                <th scope="row">{{ $solicitud->otrascausas}}</th>
                                <th scope="row">{{ $solicitud->totalvigentes}}</th>
                                    <th>
                                        <center><a href="{{ route('bitacora.index',$solicitud->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard-list"></i></a></center>
                                    </th> -->
                                   <th> <a href="<?php echo 'http://www.serresverificadora.cl/administrador/generador_certificado.php?ncert='.$solicitud->certificado ?>" target="_blank">Certificado N° {{ $solicitud->certificado}}</a></th>
                                <!-- <th scope="row">
                                <div class="row">
                                    <div class="col-xs-12 col-md-4">
                                        @can('admsol.show')<a href="{{ route('admsol.show',$solicitud->id)}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>@endcan
                                    </div> -->
                                    <!-- <div class="col-xs-12 col-md-4">
                                        @can('admsol.destroy')
                                            <center>
                                            <button class="btn btn-sm btn-danger" onclick="EliminarSolicitudCliente({{$solicitud->id}})"><i class="far fa-trash-alt"></i></button>
                                            </center>
                                        @endcan 
                                    </div> -->
                                    <!-- <div class="col-xs-12 col-md-4">
                                        @can('admsol.edit')<a href="{{ route('admsol.edit',$solicitud->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard-list"></i></a>@endcan
                                    </div>
                                    
                                </div>
                                </th>    --> 
                                <th scope="row">
                               
                                    <center>
                               
                                        <button class="btn btn-sm btn-success" onclick="AprobarSolicitud({{$solicitud->id}})"><i class="far fa-check-circle"></i></i></button>
                                        </center>
                              
                                </th>   
                                <th scope="row">
                               
                                    <center>
                               
                                        <button class="btn btn-sm btn-danger" onclick="RechazarSolicitud({{$solicitud->id}})"><i class="fas fa-reply"></i></i></button>
                                        </center>
                              
                                </th>          
                                <!-- </td> -->
                                <!-- <td>  </td> -->
                            </tr>
                        @endforeach    
                        </tbody>
                        <tfoot>
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
                        </tfoot>
                    </table>
                    <!-- fin contenido  -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection