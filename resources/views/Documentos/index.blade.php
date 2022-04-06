@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Documentos.---
                    <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('documentos.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Carga de Documentos</a>
                        @endcan  
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Contenido -->
            <div class="row">
                <!-- <div class="col-xs-12 col-md-6">
                    <select name="empresa_id" id="busquedaDocumentosXmandante" class="form-control mb-3">
                        <option>Seleccionar por Mandante</option>
                        @foreach($empresas as $empresa)
                            <option value="{{$empresa->id}}">{{ $empresa->rut}},{{ $empresa->nombre}}</option>
                        @endforeach
                    </select>
                </div> -->
                <div class="col-xs-12 col-md-6">
                    <select name="holding" id="busquedaDocumentosXholding" class="form-control mb-3">
                        <option>Seleccionar por Holding</option>
                        @foreach($holding as $holdings)
                            <option value="{{$holdings->mutualidad}}">{{ $holdings->mutualidad}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- inicio busqueda cadena -->
            <div class="row">
                                            <!-- select de proyectos -->
                                            <div class="col-xs-12 col-md-3 mt-2">
                                                        <div class="card border-primary mb-3" >
                                                            <div class="card-header">Paso 1 Seleccionar Mandante</div>
                                                            <div class="card-body text-primary">
                                                                <h5 class="card-title">Rut,Empresa Principal(Mandante)</h5>
                                                                <select name="empresa_id" id="empresa_id" class="form-control" required>
                                                                        <option value=""></option>
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
                                                                <select class="custom-select" name="proyecto_id" required id="proyecto_id" required>
                                                                    <option selected></option>
                                                                </select>                            
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-md-3 mt-2">
                                                        <div class="card border-success mb-3">
                                                            <div class="card-header">Paso 3 Seleccionar Contratista</div>
                                                            <div class="card-body text-success">
                                                                <h5 class="card-title">Contratista</h5>
                                                                <select class="custom-select" name="contratista_id" required id="contratista_id" required>
                                                                    <option selected></option>
                                                                </select>                            
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-md-3 mt-2">
                                                        <div class="card border-success mb-3">
                                                            <div class="card-header">Buscar x Cadena de Responsabilidad</div>
                                                            <div class="card-body text-success">
                                                                <button class="btn btn-primary" id="busquedaDocumentosXcadena">Buscar Documentación de Contratista</button>                            
                                                                    <h5 id="textResultado" class="card-title mt-2">.</h5>
                                                            </div>
                                                        </div>
                                                    </div>



                                            <!-- fin select de proyectos -->
                                            
                                        </div>

            <!-- fin de busqueda por cadena -->




                    <form action="{{route('comprimirArchivos.zipper')}}" method="POST">
                   
                        @csrf
                        <input type="submit" value="Comprimir Documentos de la Vista." id="zipped" class="btn btn-danger mb-2">   
                  
                                <table class="table table-hover" id="DatatableZip">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id Registro de Carga</th>
                                            <th scope="col">Documento</th>
                                            <th scope="col">URL Documento</th>
                                            <th scope="col">Etiquetas</th>
                                            <th scope="col">Rut Mandante</th>
                                            <th scope="col">Empresa Principal</th>
                                            <th scope="col">Proyecto</th>
                                            <th scope="col">Rut Contratista</th>
                                            <th scope="col">Contratista</th>
                                            <th scope="col">Contrato</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col"><center>Eliminar</center></th>
                                            <th scope="col">-</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                           
                                        
                                
                                    </tbody>
                                          
                         <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th> 
                                        <th></th> 
                                        <th></th>
                                        <th></th>
                                        <!-- <th></th>  -->
                                        <th></th> 
                                        <th></th> 
                                        <th></th> 
                                        <th></th> 
                                        <th></th> 
                                    </tfoot>
                                </table>
                    <!-- fin contenido  -->
                   
                     
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
