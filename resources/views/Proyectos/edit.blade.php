@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edición de Proyectos de Empresa
                    <span class="float-right">
                        @can('empresas.index')
                            <a href="{{ route('proyectos.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
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
      <th scope="col">Dirección</th>
      <th scope="col">Fecha Inicio</th>
      <th scope="col">Estado</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  
</table>
                    <!-- Contenido formulario funcionando -->
                    @foreach ($proyectos as $proyecto)
                    {!! Form::model($proyecto, ['route'=>['proyectos.update',$proyecto->id], 'method'=>'PUT']) !!}
                        @csrf

                        @include('Proyectos.partials.formAct')

                    {!! Form::close() !!}
                    @endforeach



                    <!-- fin contenido  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection