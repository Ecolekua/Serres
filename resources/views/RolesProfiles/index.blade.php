@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Roles del Sistema
                    <span class="float-right">
                        @can('users.create')
                            <a href="{{ route('rolesprofiles.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Crear Rol</a>
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
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre Rol</th>
                            
                            <th scope="col"><center>Ver</center></th>
                            <th scope="col"><center>Editar</center></th>
                            <th scope="col"><center>Eliminar</center></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $roles)
                            <tr>
                                <th scope="row">{{ $roles->id}}</th>
                                <td>{{ $roles->name }}</td>
                               
                                
                                <td><center> @can('rolesprofiles.show')<a href="{{ route('rolesprofiles.show',$roles->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>@endcan</center></td>
                                <td><center> @can('rolesprofiles.edit')<a href="{{ route('rolesprofiles.edit',$roles->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>@endcan</center></td>
                                <td>@can('rolesprofiles.destroy')
                                <center>
                                <button class="btn btn-sm btn-danger" onclick="EliminarRole({{$roles->id}})"><i class="far fa-trash-alt"></i></button>
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