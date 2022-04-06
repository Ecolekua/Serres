@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Empresa Id: {{ $user->id}}
                    <span class="float-right">
                        @can('users.create')
                            <a href="{{ route('users.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
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
                    
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Rut</th>
                                <th scope="col"></th>
                           </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nombre</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Correo Electrónico</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dirección URL DashBorad</th>
                                <td>{{ $user->direccion }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tipo de Usuario</th>
                                <td>{{ $user->Tipo}}</td>
                            </tr>
                        </tbody>
                    </table>

                       
                    <!-- fin contenido  -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection