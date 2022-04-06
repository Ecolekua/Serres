@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">Edición de Tags del Documento
                    <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('documentos.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver al Index de Documentos</a>
                        @endcan  
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($documento as $documento)
                     <!-- Contenido formulario funcionando -->
                     <form action="{{route('documentos.update')}}" Method="post">
                     @CSRF
                     <div class="row">
                            <div class="col-xs-12 col-md-12 mt-2">
                                <h3>Edición de Etiquetas(Tags) del Documento</h3>
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-6">
                                Id
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-12">        
                                <input type="text" name="id" class="form-control" readonly value="{{$documento->id}}">
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-6">
                                Documento
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-12">        
                                <input type="text" name="name" class="form-control" readonly value="{{$documento->documento}}">
                            </div>    
                            <div class="form-comtrol col-xs-12 col-md-6">
                                Etiquetas(Tags) del Documento
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-12">

                            
                                    @forelse($documento->tags as $tags)
                                       
                                        <?php $valor .= $tags->name.","; ?>
                                    @empty
                                        No tiene Etiquetas
                                    @endforelse

                                    <input type="text" name="tags" value="{{$valor}}" readonly id="inputTags"  class="form-control">
                                 
                                    </div>     
                                

                           
                            </br>
                            </br>
                            <div class="form-comtrol col-xs-12 col-md-12">
                                {{ Form::submit('Actualizar Tags del Documento',['class'=>'btn  btn-primary mt-3']) }}
                            </div>
                    </div>
                    @endforeach



                    <!-- fin contenido  -->

                     
                </div>

                
              
            </div>
         
            <div class="card mt-2">
                <div class="card-header">
                    Etiquetas(Tags) para agregar o quitar al Documento
                </div>
                <div class="card-body">
                     <!-- Contenido -->
                     <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Etiqueta</th>
                            <th scope="col">Utilizada</th>
                            <th scope="col">Descripción</th>
                            <th scope="col"><center>Añadir</center></th>
                            <th scope="col"><center>Quitar</center></th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($etiquetas as $etiqueta)
                            <tr>
                                <th scope="row">{{ $etiqueta->id}}</th>
                                <th>{{ $etiqueta->tags_group_id }}</th>
                                <th>{{ $etiqueta->name }} </th>
                                <th>{{ $etiqueta->count }}</th>
                                <th>{{ $etiqueta->description}}</th>
                                <td>@can('admsol.index')
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