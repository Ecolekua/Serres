@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">Creación de Nombre de Grupos. 
                    <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('group.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver al Index de Grupos</a>
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
                    {!! Form::open(['route'=>'group.store']) !!}
                        @csrf

                        @include('GroupTags.partials.form')

                    {!! Form::close() !!}
                    



                    <!-- fin contenido  -->


                     
                </div>
            </div>
            <div class="card border-info mb-3 mt-2 shadow" >
                <div class="card-header">Lista los Nombre de Grupos. Además puede ingresar varios a la vez separados por (,)</div>
                <div class="card-body text-info">
                     <!-- Contenido -->
             <table class="table table-hover mt-3" id="example">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Grupo</th>
                            <!-- <th scope="col">Etiqueta</th>
                            <th scope="col">Utilizada</th>
                            <th scope="col">Descripción</th> -->
                            <!-- <th scope="col"><center>Añadir</center></th>
                            <th scope="col"><center>Quitar</center></th> -->
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($groups as $group)
                            <tr>
                                <th scope="row">{{ $group->id}}</th>
                                <th><button type="button" class="btn btn-outline-info btn-sm">{{ $group->name}}</button></th>
                               
                              
                            </tr>
                        @endforeach    
                        </tbody>
                        <tfoot>
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