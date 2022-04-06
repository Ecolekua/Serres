@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Asigna Contratistas a usuarios para Administración de Solicitudes
                
                <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('usuconforms.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
                        @endcan  
                    </span></div>
                    <form action="{{route('usuconforms.store')}}" method="POST">
                    @csrf
                    <div class="row">  
                        <div class="col-xs-12 col-md-6">
                            <div class="row">

                                <div class="col-xs-12 col-md-12 mt-2">
                                    <div class="card border-primary mb-3" >
                                        <div class="card-header">Paso 1 Seleccionar Usuario</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Nombre</h5>
                                            <select name="user_id" id="user_id" class="form-control" required>
                                                    <option value=""></option>
                                                @foreach($usuarios as $usuario)
                                                    <option value="{{ $usuario->id }}">{{ $usuario->name}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                    </div>
                                </div>

                                <!-- <div class="col-xs-12 col-md-5 mt-2">
                                    <div class="card border-success mb-3">
                                        <div class="card-header">Paso 2 Seleccionar Proyecto</div>
                                        <div class="card-body text-success">
                                            <h5 class="card-title">Proyecto</h5>
                                            <select class="custom-select" name="proyecto_id" id="proyecto_id" required>
                                                <option selected></option>
                                            </select>                            
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-xs-12 col-md-12">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            Proyectos Cargados de la Empresa
                                        </div>
                                        <div class="card-body" id="resultadoAsignacionContratista">
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6">
                                                <label>Correctos</label>
                                                @if (isset($ing))
                                                    
                                                        <label>{{ $ing }} </label>
                                                  
                                                @endif
                                                </div>
                                                <div class="col-xs-12 col-md-6">
                                                <label>Faltó Contrato/Fecha</label></br>
                                                @if (isset($rechazados))
                                                    @foreach($rechazados as $vacio)
                                                        <label>{{ $vacio }} </label></br>
                                                    @endforeach
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <strong>Total de Contratistas asignados Correctamente:   No Cargados:</strong>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-12">

                                
                                    <div class="card border-dark mb-3">
                                        <div class="card-header">Paso 2 Seleccionar Contratista para Administrar sus Solicitudes por el Usuario</div>
                                        <div class="card-body text-dark">
                                            <h5 class="card-title">Contratistas</h5>
                                            <table class="table" id="tablaProyectos"> <!--id="tablaProyectos"-->
                                                <thead class="thead-light">
                                                    <tr>
                                                        
                                                        
                                                        <th scope="col">Id</th>
                                                        <th scope="col">Rut</th>
                                                        <th scope="col">Contratista</th>
                                                        <th scope="col">Proyecto</th>
                                                        <th scope="col">Contrato</th>
                                                        <th scope="col">Mandante</th>
                                                        <th scope="col">Tipo de Solicitud</th>
                                                        <!-- <th scope="col">Periodo Certificación Inicio</th>
                                                        <th scope="col">Periodo Certificación Fin</th> -->
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($contratistas as $contratista)
                                                    <tr>
                                                        <label>
                                                        <td><input type="text" readonly value="{{ $contratista->id}}" class="form-control" name="estructura_id[]"></td>
                                                        
                                                        <td>{{ $contratista->empresa->rut}}</td>
                                                        <td>{{ $contratista->empresa->nombre}}</td>
                                                        <td>{{ $contratista->proyecto->proyecto}}</td>
                                                        <td>
                                                            <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-md-12">
                                                                <input type="text" name="contrato[]" readonly value="{{ $contratista->contrato }}" size="30"  placeholder="N°Contrato">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </td>
                                                        </label> 
                                                        <td>{{ $contratista->proyecto->empresa->nombre}}</td>
                                                        <td>
                                                        <select class="form-control" name="formulario[]">
                                                            <option value="">Seleccione Formulario</option>
                                                            <option value="1">Certificación Laboral</option>
                                                            <option value="2">Certificación de Documentos</option>
                                                        </select>
                                                        
                                                        </td>
                                                        <!-- <td><input type="number" class="form-control" min="1" name="fechaInicio[]"></td>
                                                        <td><input type="number" class="form-control" min="1" name="fechaFin[]"></td> -->
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                            <input type="submit" value="Agregar Contratistas" class="btn btn-success " id="agregarContratistas">   
                                                                    
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection