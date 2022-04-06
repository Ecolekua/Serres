@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">Creación de Tags(Etiquetas)
                    <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('tags.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver al Index de Etiquetas</a>
                        @endcan  
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Contenido formulario funcionando -->
                    {!! Form::open(['route'=>'tags.store']) !!}
                        @csrf

                        @include('Tags.partials.form')

                    {!! Form::close() !!}
                    



                    <!-- fin contenido  -->


                     
                </div>
            </div>
            <div class="card border-info mb-3 mt-2 shadow" >
                <div class="card-header">Lista de Todas las Etiquetas</div>
                <div class="card-body text-info">
                     <!-- Contenido -->
             <table class="table table-hover mt-3" id="example">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Etiqueta</th>
                            <th scope="col">Utilizada</th>
                            <th scope="col">Descripción</th>
                            <!-- <th scope="col"><center>Añadir</center></th>
                            <th scope="col"><center>Quitar</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($etiquetas as $etiqueta)
                            <tr>
                                <th scope="row">{{ $etiqueta->id}}</th>
                                <th>{{ $etiqueta->name_group}}</th>
                                <th>{{ $etiqueta->name }} </th>
                                <th>{{ $etiqueta->count }}</th>
                                <th>{{ $etiqueta->description}}</th>
                                <!-- <td>@can('admsol.index')
                                        <center>
                                            <button class="btn btn-sm btn-success" onclick="AsignarTags({{$etiqueta->id}})"><i class="fa fa-plus-square"></i></button>
                                        </center>
                                    @endcan                                
                                </td> 
                                <td>@can('admsol.index')
                                        <center>
                                            <button class="btn btn-sm btn-danger" onclick="QuitarTags({{$etiqueta->id}})"><i class="fa fa-trash"></i></button>
                                        </center>
                                    @endcan                                
                                </td>  -->
                            </tr>
                        @endforeach    
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <!-- <th></th>
                            <th></th>
                        </tfoot> -->
                    </table>
                    <!-- fin contenido  -->

                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection