@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Asigna Contratistas a Mandantes de Forma Individual y Masiva.
                
                <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('estructuras.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
                        @endcan  
                    </span></div>
                    <!-- <form action="{{route('estructuras.store')}}" method="POST">
                    @csrf -->
                    <div class="row">  
                        <div class="col-xs-12 col-md-12">
                            <div class="row">
    
                                <div class="col-xs-12 col-md-3 mt-2">
                                    <div class="card border-primary mb-3" >
                                        <div class="card-header">Paso 1 Seleccionar Mandante</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Rut, Nombre Empresa Principal(Mandante)</h5>
                                            <select name="empresa_id" id="empresa_id" class="form-control" required>
                                                    <option value=" "></option>
                                                @foreach($empresas as $empresa)
                                                    <option value="{{ $empresa->id }}">{{ $empresa->rut}}, {{$empresa->nombre}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-3 mt-2">
                                    <div class="card border-success mb-3">
                                        <div class="card-header">Paso 2 Seleccionar Proyecto</div>
                                        <div class="card-body text-success">
                                            <h5 class="card-title">Proyecto</h5>
                                            <select class="custom-select" name="proyecto_id" id="proyecto_id" required>
                                                <option value=" "></option>
                                                
                                            </select>                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-2 mt-2">
                                    <div class="card border-primary mb-3" >
                                        <div class="card-header">Paso 3 Seleccionar Contratista para Certificar</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Rut, Nombre Cliente a Certificar(Contratista)</h5>
                                            <select name="cliente_id" id="cliente_id" class="form-control" required>
                                                    <option value=" "></option>
                                                @foreach($contratistas as $empresa)
                                               
                                                    <option value="{{ $empresa->id }}">{{ $empresa->rut}}, {{$empresa->nombre}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-2 mt-2">
                                    <div class="card border-primary mb-3" >
                                        <div class="card-header">Paso 4 (Opcional),Seleccionar Contratista si es el Cliente a Certificar es Sub-Contrato</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Rut, Nombre (Contratista del Subcontrato)</h5>
                                            <select name="contratistaSubcontrato_id" id="contratistaSubcontrato_id" class="form-control">
                                                    <option value="0"></option>
                                                @foreach($contratistas as $empresa)
                                               
                                                    <option value="{{ $empresa->id }}">{{ $empresa->rut}}, {{$empresa->nombre}}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-2 mt-2">
                                    <div class="card border-primary mb-3" >
                                        <div class="card-header">Paso 5 (Opcional), Contrato y Fecha de Ingreso</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Rut, Nombre (Contratista del Subcontrato)</h5>
                                            <label>Contrato</label>
                                            <input type="text" class="form-control" name="contratoContratista" id="contratoContratista">
                                            <label>Fecha Ingreso</label>
                                            <input type="date" class="form-control" name="fechaingresoContratista" id="fechaingresoContratista">
                                            </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12  mb-4">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <center><button id="btnAgregarContratista" onclick="btnAsignarContratistaDirectamente()" class="btn btn-success btn-lg btn-block">Asignar Contratista a Proyecto</button></center>
                                        </div>
                                        <!-- <div class="col-xs-12 col-md-6">
                                            <center><button id="btnAgregarContratista" onclick="btnAgregarContratista()" class="btn btn-primary btn-lg btn-block">Agregar Contratista a la Lista de Asignación a Proyectos</button></center>
                                        </div> -->
                                    </div>
                                </div>
                               
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
                                            <strong>Total de Contratistas asignados Correctamente:   No Cargados:</strong> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->


                        <!-- <div class="col-xs-12 col-md-12">

                                <div class="col-xs-12 col-md-12 mt-2">
                                    <div class="card border-dark mb-3">
                                        <div class="card-header">Paso 3 Seleccionar Contratista para agregar al Proyecto</div>
                                        <div class="card-body text-dark">
                                            <h5 class="card-title">Lista de Contratistas para Asignación a Proyectos</h5>
                                            <table class="table" id="tablaProyectos-desahabilitada">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Rut</th>
                                                        <th scope="col">Contratista(A Certificar)</th>
                                                        <th scope="col">Contrato</th>
                                                        <th scope="col">Fecha Inicio</th>
                                                        <th scope="col">Rut (Contratista con Subcontrato)</th>
                                                        <th scope="col">Nombre (Contratista con Subcontrato)</th>
                                                        <th scope="col">Proyecto</th>
                                                        <th scope="col">Quitar de la Lista</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    <tr>
                                                        <label>
                                                        <td><input type="text" size="1" value="" class="form-control" readonly name="empresa_id[]" ></td>
                                                        <td>Rut<input type="hidden" name="rutsClientes[]" value=""></td>
                                                        <td>Nombre</td>
                                                        <td><input type="text" size="20" name="contratos[]" class="form-control" placeholder="N°Contrato"></td>
                                                        </label> 
                                                        <td><input type="date" size="2" class="form-control" name="fechaInicio[]">
                                                        <input type="hidden" name="rutsSubcomtrato[]" value="">
                                                        <td>Nombre</td>
                                                        <input type="hidden" name="proyectos[]" value="">
                                                        <td>Rut<input type="hidden" name="rutsClientes[]" value=""></td>
                                                        <td>Nombre</td>
                                                        <td><button class="btn btn-danger">Quitar de la Lista</button></td>
                                                    </tr>
                                                   
                                                    
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                            <input type="button" value="Asignar Contratistas" class="btn btn-success " id="asignarContratistas">   
                                                                    
                                        </div>
                                    </div>
                                </div>
                        </div> -->
                    <!-- </form> -->
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection