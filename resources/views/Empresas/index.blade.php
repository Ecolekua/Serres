@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Empresas
                    <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('empresas.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Crear Empresa</a>
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
                            <th scope="col">Rut</th>
                            <th scope="col">Razón Social</th>
                            <th scope="col">Tipo Empresa</th>
                            <th scope="col">Telefonos</th>
                            <!-- <th scope="col">Correo Electrónico</th>
                            <th scope="col">Tipo de Usuario</th> -->
                            <th scope="col">Ver</th>
                            <th scope="col">Editar</th>
                            <!-- <th scope="col"><center>Eliminar</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($empresas as $empresa)
                            <tr>
                                <th scope="row">{{ $empresa->id}}</th>
                                <th>{{ $empresa->rut }}</th>
                                <th>{{ $empresa->nombre }}</th>
                                <th>{{ $empresa->tipoEmpresa }}</th>
                                <th>{{ $empresa->telefonos }}</th>
                                
                                <th> @can('empresas.show')<a href="{{ route('empresas.show',$empresa->id)}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>@endcan</th>
                                <th> @can('empresas.edit')<a href="{{ route('empresas.edit',$empresa->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>@endcan</th>
                                <!-- <td>@can('empresas.destroy')
                                <center>
                                <button class="btn btn-sm btn-danger" onclick="EliminarEmpresa({{$empresa->id}})"><i class="far fa-trash-alt"></i></button>
                                </center>
                               
                                
                                @endcan                                
                                </td> -->
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
                        </tfoot>
                    </table>
                    <!-- fin contenido  -->
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
