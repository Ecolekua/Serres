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
                            <th scope="col">Id</th>
                            <th scope="col">Rut Contratista  </th>
                            <th scope="col">Contratista</th>
                            <th scope="col">Tipo de Solcitud</th>
                            <th scope="col">Periodo a Certificar</th>
                            <th scope="col">Ingresos del Periodo</th>
                            <th scope="col">Art. 161 del Periodo</th>
                            <th scope="col">Desvinculados de Otras Causas del Periodo</th>
                            <th scope="col">N° Total de Trabajadores Vigentes en Obra</th>
                            <!-- <th scope="col">Bitácora</th>
                            <th scope="col">Asignar</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($solicitudes as $solicitud)
                           <tr>
                                <th scope="row">{{ $solicitud->id}}</th>
                                <th scope="row">{{ $solicitud->estructura->empresa->rut}}</th>
                                <th scope="row">{{ $solicitud->estructura->empresa->nombre}}</th>
                                <th>
                                @if($solicitud->usuconformulario->formulario==1)
                                    Certificación
                                @else
                                    No Disponible
                                @endif
                                </th>  
                                <th scope="row">{{ $solicitud->mes}} / {{ $solicitud->ano}}</th> 
                                <th scope="row">{{ $solicitud->contratados}}</th>
                                <th scope="row">{{ $solicitud->desvinculados}}</th>
                                <th scope="row">{{ $solicitud->otrascausas}}</th>
                                <th scope="row">{{ $solicitud->totalvigentes}}</th>
                                   
                            </tr>
                        @endforeach    
                        </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Rut Contratista  </th>
                            <th scope="col">Contratista</th>
                            <th scope="col">Tipo de Solcitud</th>
                            <th scope="col">Periodo a Certificar</th>
                            <th scope="col">Ingresos del Periodo</th>
                            <th scope="col">Art. 161 del Periodo</th>
                            <th scope="col">Desvinculados de Otras Causas del Periodo</th>
                            <th scope="col">N° Total de Trabajadores Vigentes en Obra</th>
                            
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