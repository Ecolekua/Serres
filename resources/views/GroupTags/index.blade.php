@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Etiquetas de Grupos
                    <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('group.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Crear Grupos para etiquetas</a>
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
                            <th scope="col">Grupo</th>
                            
                            <th scope="col"><center>Editar</center></th>
                            <th scope="col"><center>Eliminar</center></th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($groups as $group)
                            <tr>
                                <th scope="row">{{ $group->id}}</th>
                             
                                <th><button type="button" class="btn btn-outline-info btn-sm">{{$group->name}}</button></th>
                               
                                <td>@can('admsol.index')
                                        <center>
                                            <button class="btn btn-sm btn-success" onclick="AsignarTags({{$group->id}})"><i class="fas fa-edit"></i></button>
                                        </center>
                                    @endcan                                
                                </td> 
                                <td>@can('admsol.index')
                                        <center>
                                            <button class="btn btn-sm btn-danger" onclick="QuitarTags({{$group->id}})"><i class="fa fa-trash"></i></button>
                                        </center>
                                    @endcan                                
                                </td> 
                            </tr>
                        @endforeach    
                        </tbody>
                        <tfoot>
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
