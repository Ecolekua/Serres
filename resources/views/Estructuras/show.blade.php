@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Contrastistas en el Proyecto
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

                    <!-- Contenido formulario funcionando -->
                               

                                <!-- inicio -->
                                <table class="table mt-3">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">rut</th>
                                    <th scope="col">contratista</th>
                                    <th scope="col">Fecha Ingreso</th>
                                    <th scope="col">Contrato</th>
                                    <th scope="col">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($contratistas as $contratistas)
                                    <tr>
                                        <th scope="row">{{ $contratistas->id }}</th>
                                        <td>{{ $contratistas->empresa->rut}}</td>
                                        <td>{{ $contratistas->empresa->nombre }}</td>
                                        <td>{{ $contratistas->fechaInicio }}</td>
                                        <td>{{ $contratistas->contrato }}</td> 
                                        @if ($contratistas->activo=='0')
                                            <td>Desactivado</td>
                                         @endif    
                                         @if ($contratistas->activo=='1')  
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