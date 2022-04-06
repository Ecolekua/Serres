@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edición 
                    <span class="float-right">
                        @can('proyectos.index')
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

                    <!-- Contenido formulario funcionando -->
                                @foreach($empresa as $datoEmpresa)
                                <div class="row">
                                    <div class="form-comtrol col-xs-12 col-md-1">
                                        <label for="Empresa">Rut</label>
                                    </div>
                                    <div class="form-comtrol col-xs-12 col-md-2">        
                                        <input type="text" class="form-control" readonly value="{{ $datoEmpresa->rut }}">
                                    </div> 
                                    <div class="form-comtrol col-xs-12 col-md-1">
                                        <label for="Empresa">Empresa</label>
                                    </div>
                                    <div class="form-comtrol col-xs-12 col-md-8">        
                                        <input type="text" class="form-control" readonly value="{{ $datoEmpresa->nombre }}">
                                    </div>
                                </div>
                                @endforeach

                                <!-- inicio -->
                                <table class="table mt-3">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Proyecto</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Fecha Inicio</th>
                                    <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($proyectos as $proyecto)
                                    <tr>
                                        <th scope="row">{{ $proyecto->id }}</th>
                                        <td>{{ $proyecto->proyecto }}</td>
                                        <td>{{ $proyecto->direccion }}</td>
                                        <td>{{ $proyecto->fechaInicio }}</td>
                                        @if ($proyecto->activo=='0')
                                            <td>Desactivado</td>
                                         @endif    
                                         @if ($proyecto->activo=='1')  
                                             <td>Vigente</td>
                                        @endif   
                                 
                                    </tr>
                                    @endforeach
                                  
                                </tbody>
                                </table>

                              
                                <!-- fin -->


                    <!-- fin contenido  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection