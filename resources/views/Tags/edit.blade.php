@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">Edición de Tags(Etiquetas)
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
                    @foreach($tag as $tag)
                     <!-- Contenido formulario funcionando -->
                     <form action="{{route('tags.update')}}" Method="post">
                     @CSRF
                     <div class="row">
                            <div class="col-xs-12 col-md-12 mt-2">
                                <h3>Edición de Etiquetas(Tags)</h3>
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-6">
                                Id
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-12">        
                                <input type="text" name="id" class="form-control" readonly value="{{$tag->id}}">
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-6">
                                Etiqueta(Tags)
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-12">        
                            <input type="text" name="name" class="form-control" value="{{$tag->name}}">
                            </div>    
                            <div class="form-comtrol col-xs-12 col-md-12">
                                Descripción de la Etiqueta
                            </div>
                            <div class="form-comtrol col-xs-12 col-md-10">        
                            <input type="text" name="description" class="form-control" value="{{$tag->description}}">
                            </div>
                            
                            <div class="form-comtrol col-xs-12 col-md-2 mt-2">
                                Grupo Actual
                            </div>

                            <div class="form-comtrol col-xs-12 col-md-3 mt-2">
                               <select name="id_group" class="form-control">
                               <option value="{{$tag->name_group}}">{{$tag->name_group}}</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach
                               </select>
                            </div>

                           
                            </br>
                            </br>
                            <div class="form-comtrol col-xs-12 col-md-12">
                                {{ Form::submit('Actualizar Tags',['class'=>'btn  btn-primary']) }}
                            </div>
                    </div>
                    @endforeach



                    <!-- fin contenido  -->

                     
                </div>
            </div>
         
            
        </div>
    </div>
</div>
@endsection