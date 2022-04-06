@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edición de Contratistas en el Proyecto
                    <span class="float-right">
                        @can('estructuras.index')
                            <a href="{{ route('estructuras.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
                        @endcan  
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Id</th>
                        
                        <th scope="col">Proyecto</th>
                        <th scope="col">Contratista</th>
                        <th scope="col">Contrato</th>
                        <th scope="col"><center>Fecha Inicio</center></th>
                        <th scope="col"><center>Estado</center></th>
                        <th scope="col"><center>Acción</center></th>
                        </tr>
                    </thead>
                    
                    </table>
                    <!-- Contenido formulario funcionando -->
                    @foreach ($contratistas as $contratista)
                    {!! Form::model($contratista, ['route'=>['estructuras.update',$contratista->id], 'method'=>'PUT']) !!}
                        @csrf

                        @include('Estructuras.partials.formAct')

                    {!! Form::close() !!}
                    @endforeach



                    <!-- fin contenido  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection