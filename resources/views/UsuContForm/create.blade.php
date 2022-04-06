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
                    </span>
                </div>
                    
                    <div class="row">  
                        <div class="col-xs-12 col-md-12">
                            <div class="row">
    
                                <div class="col-xs-12 col-md-3 mt-2">
                                    <div class="card border-primary mb-3" >
                                        <div class="card-header">Paso 1 Seleccionar Mandante</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Rut, Nombre Empresa Principal(Mandante)</h5>
                                            <select name="empresa_id" id="empresa_id" class="form-control" required>
                                                <option></option>
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
                                            <select class="custom-select select_estructuras" name="proyecto_id" id="proyecto_id" required>
                                                <option></option>
                                                
                                            </select>                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-3 mt-2 ml-auto">
                                <button class="btn btn-primary mt-1 mb-1" id="desmarcarTodos">Traer Desmarcarcados los contratistas</button>
                                <button class="btn btn-secondary mt-1 mb-1" id="marcarTodos">Traer Marcados los contratistas</button>
                                </div>
                                <div class="col-xs-12 col-md-3 mt-2 ml-auto">
                                    <div class="card border-secondary mb-3">
                                        <div class="card-header">Clonar Asignaciones de Usuarios(No disponible)</div>
                                        <div class="card-body text-primary">
                                            <h5 class="card-title">Usuario Actual</h5>
                                            <select class="custom-select mt-1 mb-1" name="actual_usuario_id" id="actual_usuario_id" required>
                                                            <option value=''>Seleccione Usuario Actual</option>
                                                            @foreach($usuarios as $usuario)
                                                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                                            @endforeach
                                                        </select>   
                                                        <select class="custom-select mt-1 mb-1" name="destino_usuario_id" id="destino_usuario_id" required>
                                                            <option value=''>Seleccione Usuario Destino</option>
                                                            @foreach($usuarios as $usuario)
                                                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                                            @endforeach
                                                        </select>                        
                                        </div>
                                        <button class="btn btn-success" id="btnClonar">Clonar Perfil del Usuario</button>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-12 mt-2">
                                
                                <form action="{{route('estructuras.usuario')}}" method="POST">
                                                @CSRF
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-4 ml-2">
                                                        <select class="custom-select mt-1 mb-1" name="usuario_id" required>
                                                            <option value=''>Seleccione Usuario</option>
                                                            @foreach($usuarios as $usuario)
                                                                <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    <!-- </div> -->
                                                    <!-- <div class="col-xs-12 col-md-4"> -->
                                                        <select class="custom-select mt-1 mb-1" name="formularios" required>
                                                            <option value=''>Seleccione Formularios para Asignar</option>
                                                            <option value="1">Certificación Laboral</option>
                                                            <option value="2">Auditoría Documental</option>
                                                            <option value="3">Ambos formularios</option>
                                                            <option value="4">Formulario Covid</option>
                                                        </select>  
                                                    <!-- </div>
                                                    <div class="col-xs-12 col-md-4">  -->
                                                        <input type="submit" class="btn btn-success mt-1 mb-1" value="Asignar formularios de Contratista a Usuario">
                                                        
                                                    </div>
                                                    
                                                </div>
                                    <table class="table">
                                        <thead class="thead-dark" id="tb-empresasxproyecto">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Empresa</th>
                                                <th scope="col">Proyecto</th>
                                                <th scope="col">Contrato</th>
                                                <th scope="col"><center>Asigna S/N</center></th>
                                                <!-- <th scope="col"><center>Formularios</center></th> -->
                                            </tr>
                                        </thead>
                                            
                                                <tbody>
                                                
                                                
                                                </tbody>
                                            </form>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            </div>
        </div>
    </div>
</div>    

@endsection