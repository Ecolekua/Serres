@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Etiquetas y Grupos
                    <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('tags.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Crear Tags</a>
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
                            <th scope="col">Etiqueta</th>
                            <th scope="col">Utilizada</th>
                            <th scope="col">Descripción</th>
                            <th scope="col"><center>Editar</center></th>
                            <th scope="col"><center>Eliminar</center></th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($etiquetas as $etiqueta)
                            <tr>
                                <th scope="row">{{ $etiqueta->id}}</th>
                                <th>{{ $etiqueta->tags_group_id }}</th>
                                <th><button type="button" class="btn btn-outline-info btn-sm">{{$etiqueta->name}}</button></th>
                                <th>{{ $etiqueta->count }}</th>
                                <th>{{ $etiqueta->description}}</th>
                                <td>@can('admsol.index')
                                        <center>
                                            
                                        <a href="{{ route('tags.edit',$etiqueta->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                        </center>
                                    @endcan                                
                                </td> 
                                <td>@can('admsol.index')
                                        <center>
                                            <button class="btn btn-sm btn-danger" onclick="EliminarTags({{$etiqueta->id}})"><i class="fa fa-trash"></i></button>
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
