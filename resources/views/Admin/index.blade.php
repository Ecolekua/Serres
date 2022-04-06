@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Usuarios del Sistema
                    <span class="float-right">
                        @can('users.create')
                            <a href="{{ route('users.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Crear Usuario</a>
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
                                <th scope="col">Nombre Usuario</th>
                                <th scope="col">Correo Electrónico</th>
                                <th scope="col">Tipo de Usuario</th> 
                                <th scope="col">Ver</th>
                                <th scope="col">Editar</th>
                                <!-- <th scope="col"><center>Eliminar</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id}}</th>
                                <th>{{ $user->name }}</th>
                                <th>{{ $user->email }}</th>
                                <th>{{ $user->Tipo }}</th> 
                                <th> @can('users.index')<a href="{{ route('users.show',$user->id)}}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>@endcan</th>
                                <th> @can('users.crud')<a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>@endcan</th>
                                <!-- <th>@can('users.crud') -->

                                <!-- <center>
                             
                                <button class="btn btn-sm btn-danger" onclick="EliminarUser({{$user->id}})"><i class="far fa-trash-alt"></i></button>
                                </center> -->
                                <!-- {!! Form::open(['route'=>['users.destroy',$user->id], 'method'=>'DELETE']) !!}
                                 @csrf
                                
                                {!! Form::hidden('id',$user->id,['class'=>'form-control', 'placeholder'=>'Torta de Chocolate', 'required' => 'required' ]) !!}
                                   <button class="btn btn-sm btn-danger">
                                   <i class="far fa-trash-alt"></i>
                                   </button>
                                    
                                
                                {!! Form::close() !!}  -->
                                
                                <!-- @endcan                                
                                </th> -->
                                <!-- <td>  </td> -->
                            </tr>
                        @endforeach    
                        </tbody>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            

                        </tr>

                        </tfoot>
                    </table>
                    <!-- fin contenido  -->
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
