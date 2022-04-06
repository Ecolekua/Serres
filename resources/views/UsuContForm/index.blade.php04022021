@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Usuario que Administran Solicitudes de Contratistas
                    <span class="float-right">
                        @can('usuconforms.create')
                            <a href="{{ route('usuconforms.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Asignar Tipos de Solicitud</a>
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
                            <!-- <th scope="col">Tipo de Usuario</th> -->
                            <!-- <th scope="col">Ver</th> -->
                            <th scope="col">Editar</th>
                            <th scope="col"><center>Eliminar</center></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($usuconfor as $usuconfor)
                            <tr>
                                <th scope="row">{{ $usuconfor->id}}</th>
                                <td>{{ $usuconfor->user->name }}</td>
                                <td>{{ $usuconfor->user->email }}</td>
                                @if($usuconfor->formulario==1)
                                    <td>Certificación</td>
                                @elseif($usuconfor->formulario==2)
                                    <td>Certificación de Documentos</td>
                                @endif
                                <td>{{ $usuconfor->estructura->empresa->nombre }} </td>
                                <td> {{ $usuconfor->estructura->contrato }}
                                @if($usuconfor->activo==1)
                                    <td>Habilitado</td>
                                @else
                                    <td>Deshabilitado</td>
                                @endif
                                <!-- <td> @can('usuconforms.show')<a href="{{ route('usuconforms.show',$usuconfor->id)}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>@endcan</td> -->
                                <td> @can('usuconforms.edit')<a href="{{ route('usuconforms.edit',$usuconfor->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>@endcan</td>
                                <td> @can('usuconforms.destroy')
                                <center>
                                    <button class="btn btn-sm btn-danger" onclick="EliminarUsuConForm({{$usuconfor->id}})"><i class="far fa-trash-alt"></i></button>
                                </center>
                                @endcan                                
                                </td>
                                <!-- <td>  </td> -->
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