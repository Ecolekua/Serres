@extends('layouts.app')


                <!-- contenido -->
               

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
           
            @foreach($solicitud as $estado)
                       
                <div class="card-header">Bitácora Solicitud N° {{$estado->id}} <strong> </strong>, Estado:{{$estado->estado}} <strong> 
                    @if ($estado->estado=="Guardada")
                        INICIADA
                    
                    @elseif ($estado=="Enviada")
                        RECIBIDO
                    @elseif($estado=="Asignada")
                        EN REVISION
                        @elseif($estado=="Rechazada")
                        CON OBSERVACIONES
                    @elseif($estado=="Liberada")
                        APROBADA
                
                    @endif   

            @endforeach  
                                   
            
            
            </strong>
                                    <!-- <span class="float-right">
                        @can('estructuras.create')
                            <a href="{{ route('estructuras.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Asignar Contratistas a Proyectos</a>
                        @endcan  
                    </span> -->
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Contenido -->
                    <table class="table" id="example">
                    <caption>
                  
                    
                    
                    
                    
                     <strong>  </strong></caption>
                        <thead>
                            <tr>
                            <!-- <th scope="col">ID</th> -->
                            <th scope="col">
                                    @foreach($solicitud as $estado2)
                                    Fecha Solicitud  N°{{$estado2->id}} 
                                @endforeach  
                            
                            
                            </th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefonos de Contacto</th>
                            <th scope="col">Comentario / Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($seguimiento as $bitacora)
                            <tr>
                                <!-- <th scope="row">{{ $bitacora->id }}</th> -->
                                <th>{{ $bitacora->created_at }}</th>
                                <th>{{ $bitacora->user->name}}</th>
                                <th>{{ $bitacora->user->email}}</th>
                                <th>{{ $bitacora->user->telefono}}</th>
                                <th>{{ $bitacora->comentario }}</th>
                            </tr>
                        @endforeach    
                        </tbody>
                        <tfoot>
                        </tfoot>
                        </table>
                    <!-- fin contenido  -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection