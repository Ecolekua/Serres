@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edición de Perfil del Admninistrador de Solicitudes del Contratista
                    <span class="float-right">
                        @can('empresas.index')
                            <a href="{{ route('usuconforms.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
                        @endcan  
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($id as $contratista)
                    <label>Empresa Contratista</label>
                    <input type="text" value="{{ $contratista->estructura->empresa->nombre }} " class="form-control  mb-2">
                    @endforeach
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">Id</th>
                            
                            <th scope="col">Formulario</th>
                            <th scope="col">Activo</th>
                            <th scope="col">Periodo Inicio</th>
                            <th scope="col">Periodo fin</th>
                            <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        
                    </table>
                    <!-- Contenido formulario funcionando -->
                    @foreach ($id as $datos)
                    {!! Form::model($datos, ['route'=>['usuconforms.update',$datos->id], 'method'=>'PUT']) !!}
                        @csrf

                        @include('UsuContForm.partials.formAct')

                    {!! Form::close() !!}
                    @endforeach



                    <!-- fin contenido  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection