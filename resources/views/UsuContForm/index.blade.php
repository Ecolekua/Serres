@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Usuario que Administran Solicitudes de Contratistas
                    <!-- <span class="float-right"> -->
                    <div class="row">    
                        <div class="col-md-10 mt-2">
                            <form action="{{route('usuconforms.busqueda')}}" method="POST">
                                @CSRF
                                
                                            <strong>Buscar x Usuario</strong> <select name="user_id" class="form-control">
                                                <option value="0">Seleccione Usuario</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->email}}</option>
                                                @endforeach
                                            </select>

                                            <strong>Buscar x Contrato</strong> <select name="contrato_id" class="form-control">
                                                <option>Seleccione Contrato</option>
                                                @foreach($contratos as $contrato)
                                                    <option value="{{ $contrato->id }}">{{ $contrato->contrato}}</option>
                                                @endforeach
                                            </select>
                                            <input type="submit" class="btn btn-sm btn-secondary mt-2" value="Buscar Información">
                            </form>
                        </div>
                        <div class="col-md-2">
                            @can('usuconforms.create')
                                <a href="{{ route('usuconforms.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Asignar Tipos de Solicitud</a>
                            @endcan  
                        </div>
                    </div>
                    <!-- </span> -->
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
  
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Formulario</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Contrato</th>
                            <th scope="col">Hab/Desh</th>
                            <th scope="col">Ver Certificado</th>
                            <!-- <th scope="col">Ver</th> -->
                            <th scope="col">Editar</th>
                            <!-- <th scope="col"><center>Eliminar</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuconfor as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->user->name }}</td>
                                    <td>{{ $user->user->email }}</td>
                                    <td>@if($user->formulario==1)
                                            Certificación Laboral
                                        @else

                                            Auditoría Documental
                                        @endif
                                    </td>
                                    <td>{{ $user->estructura->empresa->nombre }}</td>
                                    <td>{{ $user->estructura->contrato }}</td>
                                    <td>@if($user->activo==1)
                                            Habilitado
                                        @else
                                            Deshabilitado
                                        @endif
                                    </td>
                                    <!-- <td> @if ($user->verCertificado==1) Habilitado @else Deshabilitado @endif </td> -->
                                    <td> @if ($user->estructura->certificadoVisible==1) Habilitado @else Deshabilitado @endif </td>
                                    <td> @can('usuconforms.edit')<a href="{{ route('usuconforms.edit',$user->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>@endcan</td>
                                </tr> 
                            @endforeach
                        </tbody>
                        {{ $usuconfor->links() }}
                    </table>
                    <!-- fin contenido  -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection