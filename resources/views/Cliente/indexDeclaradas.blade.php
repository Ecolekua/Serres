@extends('layouts.app')

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
                            <th scope="col">Contratados</th>
                            <th scope="col">Desvinvulados</th>
                            <th scope="col">Otras Causas</th>
                            <th scope="col">Total Vigentes</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Contrato</th>
                            <th scope="col">Bitácora</th>
                            <th scope="col">Acción</th>
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
                                <th scope="row">{{ $solicitud->contratados}}</th>
                                <th scope="row">{{ $solicitud->desvinculados}}</th>
                                <th scope="row">{{ $solicitud->otrascausas}}</th>
                                <th scope="row">{{ $solicitud->totalvigentes}}</th>
                                <th scope="row">
                                @if($solicitud->estado=="Liberada")
                                        Certificado
                                @endif
                                @if($solicitud->estado=="Guardada")
                                        Iniciada
                                    @endif
                                </th>
                                <th scope="row">{{ $solicitud->estructura->contrato}}</th>
                                <th>
                                    <center><a href="{{ route('bitacora.index',$solicitud->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-clipboard-list"></i></a></center>
                                </th>
                                <th scope="row">
                                    @if($solicitud->estado=="Liberada")
                                        <a href="<?php echo 'http://www.serresverificadora.cl/administrador/generador_certificado.php?ncert='.$solicitud->certificado ?>" target="_blank">Certificado</a>
                                    @endif
                                    @if($solicitud->estado=="Guardada")
                                        <center><a href="{{ route('solicitudesCliente.guardada',$solicitud->id)}}" class="btn btn-sm btn-success"><i class="fas fa-file-invoice"></i></a></center>
                                    @endif
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