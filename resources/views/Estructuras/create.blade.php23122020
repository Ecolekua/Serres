@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Asigna Contratistas a Mandantes
                
                <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('estructuras.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
                        @endcan  
                    </span></div>
                    <form action="{{route('estructuras.store')}}" method="POST">
                    @csrf
                    <div class="row">  
                        <div class="col-xs-12 col-md-6">
                            <div class="row">

                                <div class="col-xs-12 col-md-7 mt-2">
                                    <div class="card border-primary mb-3" >
                                        <div class="card-header">Paso 1 Seleccionar Mandante</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Rut, Nombre Empresa Principal(Mandante)</h5>
                                            <select name="empresa_id" id="empresa_id" class="form-control" required>
                                                    <option value=""></option>
                                                @foreach($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}">{{ $empresa->rut}}, {{$empresa->nombre}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-5 mt-2">
                                    <div class="card border-success mb-3">
                                        <div class="card-header">Paso 2 Seleccionar Proyecto</div>
                                        <div class="card-body text-success">
                                            <h5 class="card-title">Proyecto</h5>
                                            <select class="custom-select" name="proyecto_id" id="proyecto_id" required>
                                                <option selected></option>
                                            </select>                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12">
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
                                                @if (isset($malos))
                                                    @foreach($malos as $vacio)
                                                        <label>{{ $vacio }} </label></br>
                                                    @endforeach
                                                @endif
                                                @if (isset($numeroRechazados))
                                                   
                                                        @if($numeroRechazados==0)
                                                            <label>{{ $numeroRechazados }} </label></br>
                                                        @endif
                                                   
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-muted">
                                            <!-- <strong>Total de Contratistas asignados Correctamente:   No Cargados:</strong> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-md-12">

                                <div class="col-xs-12 col-md-12 mt-2">
                                    <div class="card border-dark mb-3">
                                        <div class="card-header">Paso 3 Seleccionar Contratista para agregar al Proyecto</div>
                                        <div class="card-body text-dark">
                                            <h5 class="card-title">Contratista</h5>
                                            <table class="table" id="tablaProyectos">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Rut</th>
                                                        <th scope="col">Contratista</th>
                                                        <th scope="col">Contrato</th>
                                                        <th scope="col">Fecha Inicio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($contratistas as $contratista)
                                                    <tr>
                                                        <label>
                                                        <td><input type="text" size="1" value="{{ $contratista->id}}" class="form-control" readonly name="empresa_id[]" ></td>
                                                        <td>{{ $contratista->rut}}<input type="hidden" name="rut[]" value="{{ $contratista->rut}}"></td>
                                                        <td>{{ $contratista->nombre}}</td>
                                                        <td><input type="text" size="20" name="contrato[]" class="form-control" placeholder="N°Contrato"></td>
                                                        </label> 
                                                        <td><input type="date" size="2" class="form-control" name="fechaInicio[]">
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
</div>
@endsection