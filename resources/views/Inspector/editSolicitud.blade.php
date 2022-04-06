@extends('layouts.appAdmin')


                <!-- contenido -->
               

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Formulario de Certificación
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
                @foreach( $solicitud as $datos)
                <!-- <form action="{{route('solicitudesCliente.store')}}" method="POST" enctype="multipart/form-data"> -->

                <input type="hidden" name="estructura_id" value="{{ $datos->estructura->id}}">
                <input type="hidden" name="usuConFomulario_id" value="{{ $datos->id}}">

                <!-- @csrf -->
                    <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <center><label><strong><h4>Solicitud para solicitar cumplimiento de obligaciones laborales y previcionales (ley de Subcontratación) ID: {{ $datos->id}}</h4></strong></label></center>
                            </div>
                @if ($datos->usuconformulario->formulario==2)

                
                <!-- seccion nueva formulario -->
                                <!-- <div class="col-xs-12 col-md-3">
                                Número de Certificado
                                    <input type="number" name="numerocertificado" class="form-control">
                                </div> -->
                                <label>Marcar la Opción que corresponda</label>
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <!-- <th scope="col"></th> -->
                        <th scope="col">Tipo de Documento</th>
                        <th scope="col">Observación</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <th scope="row">Rectificación Certificado </th>
                            <td><input type="checkbox" name="rectCert" value="1"></td>
                            <td></td>
                            
                        </tr> -->
                        <!-- <tr>
                            <th scope="row">Control Documental Trabajadores</th>
                            <td><input type="checkbox" name="contdocutrab" value="1"></td>
                            <td></td>
                            
                        </tr>
                        <tr>
                            <th scope="row">Control Documental Empresa </th>
                            <td><input type="checkbox" name="contdocuempr" value="1"></td>
                            <td></td>
                            
                        </tr>
                        <tr>
                            <th scope="row">Evaluación Financiera </th>
                            <td><input type="checkbox" name="evalfina" value="1"></td>
                            <td></td>
                            
                        </tr> -->
                        <tr>
                            <td scope="row">
                                <select name="tipo_documento" class="form-control" required readonly>
                                    <option value="">{{ $datos->tipo_documento}}</option>
                                   
                                </select>
                            </td>
                            <!-- <td><input type="checkbox" name="otro" value="1"></td> -->
                            <td><textarea  cols="60" name="otraopcion" readonly >{{$datos->otroobser}}</textarea></td>
                            
                        </tr>
                       
                    </tbody>
                </table>
                <!-- fin seccion nueva  -->
            
                @endif
                            <div class="col-xs-12 col-md-12">
                                <label><strong><h6>Individualización del Cliente (Contratista o Subcontratista)</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Rut</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->empresa->rut }} ">
                            </div>
                            
                            <div class="col-xs-12 col-md-10">
                                <label>Razón Social / Nombre (Apellido Paterno Apellido Materno Nombre)</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->empresa->nombre }}">
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Dirección</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->empresa->direccion }}">
                            </div>
                            
                            <div class="col-xs-12 col-md-4">
                                <label>Comuna</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->empresa->comuna }}">
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->empresa->telefonos }}">
                            </div>

                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>Antecedentes de la Empresa Principal, (Información referida al dueño de la empresa, Obra o Faena donde se desarrollan los servicios o ejecutan las obras contratadas. A llenar por el Cliente</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Rut</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->proyecto->empresa->rut }}">
                            </div>
                            
                            <div class="col-xs-12 col-md-10">
                                <label>Razón Social / Nombre (Apellido Paterno Apellido Materno Nombre)</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->proyecto->empresa->nombre }}">
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Dirección</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->proyecto->empresa->direccion }}">
                            </div>
                            
                            <div class="col-xs-12 col-md-4">
                                <label>Comuna</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->proyecto->empresa->comuna }}">
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->proyecto->empresa->telefonos }}">
                            </div>
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>Enviar A</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-7">
                                <label>Nombre</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->proyecto->empresa->nomContacto }}">
                            </div>
                            
                            <div class="col-xs-12 col-md-5">
                                <label>Cargo</label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <div class="col-xs-12 col-md-7">
                                <label>Email</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->proyecto->empresa->emailContacto }}">
                            </div>
                            
                            <div class="col-xs-12 col-md-5">
                                <label>Telefono</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->proyecto->empresa->fonContacto }}">
                            </div>
                            <div class="col-xs-12 col-md-12 mt-3">
                            Identficación del Contratista
                            </div>
                            
                           @if($datos->estructura->contratistasubcontrato_id==null)
                                   
                                
                                            <div class="col-xs-12 col-md-2 ml-2 mt-2">
                                            Rut
                                                <input type="text" readonly class="form-control" >
                                            </div>
                                            <div class="col-xs-12 col-md-9 mb-2 mt-2">
                                            Nombre ó Razón Social
                                                <input type="text" readonly class="form-control">
                                            </div>

                                   
                            @else  
                                   
                                    
                                            <div class="col-xs-12 col-md-2">
                                            Rut
                                                <input type="text" readonly value="{{ $datos->estructura->contratistasubcontrato->rut }}" class="form-control" >
                                            </div>
                                            <div class="col-xs-12 col-md-10">
                                            Nombre ó Razón Social
                                                <input type="text" readonly value="{{ $datos->estructura->contratistasubcontrato->nombre }}" class="form-control">
                                            </div>

                                     
                                   
                            @endif

                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>Individualización de la Obra, Empresa o Faena por la cual solicita el Certificado</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label>Nombre de la Obra, Faena, Empresa</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->proyecto->proyecto }}">
                            </div>
                            
                            <div class="col-xs-12 col-md-3">
                                <label>N° total de Trabajadores vigentes en Obra</label>
                                <input type="number" min=0 name="totalvigentes"  value="{{ $datos->totalvigentes }}" class="form-control" readonly>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Dirección de la Obra objeto del Certificado</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->proyecto->direccion }}">
                            </div>
                            
                            <div class="col-xs-12 col-md-4">
                                <label>Comuna</label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>N° Contrato</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->contrato }}">
                            </div>

                            @if ($datos->usuconformulario->formulario==1)
                                <div class="col-xs-12 col-md-12 mt-2 ">
                                    <label><strong><h6>Antecedentes del Mes a Certificar</h6></strong></label>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <label>Año</label>
                                    <input type="number" name="ano" min=2015 max=2025 value="{{ $datos->ano }}" class="form-control" readonly>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <label>Mes</label>
                                    <input type="text" name="mes" value="@if($datos->mes==1)Enero @elseif($datos->mes==2)Febrero @elseif($datos->mes==3)Marzo @elseif($datos->mes==4)Abril @elseif($datos->mes==5)Mayo @elseif($datos->mes==6)Junio @elseif($datos->mes==7)Julio @elseif($datos->mes==8)Agosto @elseif($datos->mes==9)Septiembre @elseif($datos->mes==10)Octubre @elseif($datos->mes==11)Noviembre @elseif($datos->mes==12)Diciembre @endif" class="form-control" readonly>
                                    
                                
                                
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <label>N° Contratados</label>
                                    <input type="number" min=0 name="contratados"  value="{{ $datos->contratados }}" class="form-control" readonly>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <label>N° Desvinculados</label>
                                    <input type="number" min=0 name="desvinculados"  value="{{ $datos->desvinculados }}" class="form-control" readonly>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <label>N° de Otras Causales</label>
                                    <input type="number" min=0 name="otrascausas" value="{{ $datos->otrascausas }}" class="form-control" readonly>
                                </div>
                                <div class="col-xs-12 col-md-2">
                                    <label>Centro de Costo</label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                   @endif
                                <div class="col-xs-12 col-md-12 mt-2 ">
                                    <label><strong><h6>Individualización del Contacto ante SERRESCERIFICADORA SPA</h6></strong></label>
                                </div>
                                <div class="col-xs-12 col-md-9">
                                    <label>Nombre</label>
                                    <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->empresa->nomContacto }} ">
                                </div>
                                
                                <div class="col-xs-12 col-md-3">
                                    <label>Teléfono</label>
                                    <input type="text" class="form-control" readonly value="{{ $datos->estructura->empresa->fonContacto }} ">
                                </div>
                                <div class="col-xs-12 col-md-12">
                                    <label>Email</label>
                                    <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->empresa->emailContacto }} ">
                                </div>
                         
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>Archivos para Revisar</h6></strong></label>
                            </div>
                            @foreach($documentos as $documento)
                            <div class="col-xs-12 col-md-12">
                                <label>{{ $documento->tipodocumento}}</label>
                                <a href="{{ '/Archivos/'.$datos->ano.'/'.$documento->documento }}" target="_blank" class="form-control">{{ $documento->documento}}  Tipo: {{$documento->observaciones }} </a>
                            </div>
                            @endforeach
                            <!-- <div class="col-xs-12 col-md-4 mt-2">
                               <center> <a href="{{route('comprimir.descargar',$datos->id)}}" class="btn btn-success btn-block">Descargar todos los archivos en un ZIP</a></center>
                            </div> -->
                            <div class="col-xs-12 col-md-12 mt-3">
                                <center><label class="mt-3 mb-3"><strong><h3> Opciones de Procedimientos con el Formulario</h3></strong> </label></center>
                            </div>
                            {!! Form::model($datos, ['route'=>['SolicitudesInspector.update',$datos->id], 'method'=>'PUT']) !!}
                                @csrf
                                <input type="hidden" name="estadoNuevo" value="{{ $datos->estado}}">
                                @include('Inspector.partials.formEditSolicitud')

                            {!! Form::close() !!}
                     
                    </div>

                    <!-- certificación nueva -->
                 
                                       <!-- Button trigger modal -->
                                    @can('administradorMenu.index')
                                        @if($datos->certificadoNombre==null)
                                        <hr>
                                            <div class="col-xs-6 mt-3">
                                                <strong><h3 style="color:#FF0000";>Observaciones del Cliente.</h3></strong>
                                                <strong><textarea disabled size="20" class="form-control mb-4">{{ $datos->observacionCliente}}</textarea></strong>
                                            </div>
                                            <hr>
                                            <div class="col-xs-6">
                                                <center>
                                                    <button type="button" class="btn btn-lg btn-dark mt-3" data-toggle="modal" data-target="#exampleModalCenter{{$datos->id}}">
                                                        Carga de Nómina para Certicar   <i class="fas fa-clipboard-list"></i>
                                                    </button>
                                                </center>
                                            </div>
                                      
                                        
                                        @else
                                            <form action="{{ route('certificado.rechazado.edicion') }}" method="post">
                                            {{csrf_field()}}
                                                <input type="hidden" value="{{ $datos->certificadoNombre }}" name="certificado_id">
                                                <input type="submit" value="Certificado Observado" class="btn btn-danger btn-sm mr-5">
                                            </form> 
                                        @endif
                                    @endcan

                       
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter{{$datos->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle"><center>Cargue Planilla para Certificar Trabajadores del Periodo de la Solicitud</center></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Contenido -->
                                            
                                                        <form method="post" action="{{route('carga.empleados')}}" enctype="multipart/form-data">
                                                                {{csrf_field()}}
                                                            <div class="row">
                                            
                                                                <div  class="col-xs-12 col-md-4">

                                                                    <input type="file" id="excel" required name="excel">
                                                                    <input type="hidden" id="solicitud_id" name="solicitud_id" value="{{$datos->id}}">
                                                                    <input type="hidden" id="mes" name="mes" value="{{$datos->mes}}">
                                                                    <input type="hidden" id="anio" name="anio" value="{{$datos->ano}}">
                                                                    <input type="hidden" id="estructura_id" name="estructura_id" value="{{$datos->estructura_id}}">
                                                                </div>
                                                                <div class="col-xs-12 col-md-12">
                                                                    <input type="submit" class="btn btn-primary mt-2" value="Cargar Planilla de Trabajadores" id="btn_enviar" style="padding: 10px 20px;">
                                                                </div>
                                                            </div>
                                                        </form>

                                                
                                                <!-- fin contenido  -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                            </div>
                                        </div>
                            </div>
                            <!-- fin modal -->
                        
                    <!-- fin certificacion nueva -->
                <!-- </form> -->
                @endforeach
                    <!-- fin contenido  -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection