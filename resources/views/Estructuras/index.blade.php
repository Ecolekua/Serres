@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Proyectos
                    <span class="float-right">
                        @can('estructuras.create')
                            <a href="{{ route('estructuras.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Asignar Contratistas a Proyectos</a>
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
                            <!-- <th scope="col">Fecha Inicio</th> -->
                            <th scope="col">Dirección </th>
                            <th scope="col">Rut Mandante </th>
                            <th scope="col">Empresa Principal </th>
                            <!-- <th scope="col">Correo Electrónico</th>
                            <th scope="col">Tipo de Usuario</th> -->
                            <th scope="col">Ver</th>
                            <th scope="col">Editar</th>
                            <th scope="col"><center>Eliminar</center></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($proyectos as $proyecto)
                            <tr>
                                <th scope="row">{{ $proyecto->id}}</th>
                                <th>{{ $proyecto->proyecto }}</th>
                                <!-- <td>{{ $proyecto->fechaInicio }}</td> -->
                                <th>{{ $proyecto->direccion }}</th>
                                <th>{{ $proyecto->empresa->rut }}</th>
                                <th>{{ $proyecto->empresa->nombre }}</th>
                                <th> @can('estructuras.show')<a href="{{ route('estructuras.show',$proyecto->id)}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>@endcan</th>
                                <th> @can('estructuras.edit')<a href="{{ route('estructuras.edit',$proyecto->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>@endcan</th>
                                <th>@can('proyectos.destroy')
                                <center>
                                <button class="btn btn-sm btn-danger" onclick="EliminarProyecto({{$proyecto->id}})"><i class="far fa-trash-alt"></i></button>
                                </center>
                               
                                
                                @endcan                                
                                </th>
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
                        </tfoot>
                    </table>
                    <!-- fin contenido  -->
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection