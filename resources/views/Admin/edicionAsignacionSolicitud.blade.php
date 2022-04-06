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
                <!-- <input type="hidden" name="estadoNuevo" value="{{ $datos->estado}}"> -->

                <!-- @csrf -->
                    <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <center><label><strong><h4>Solicitud para solicitar cumplimiento de obligaciones laborales y previcionales (ley de Subcontratación) ID: {{ $datos->id}}</h4></strong></label></center>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label><strong><h6>1.- Individualización del Cliente (Contratista o Subcontratista)</h6></strong></label>
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
                                <label><strong><h6>2.- Antecedentes de la Empresa Principal, (Información referida al dueño de la empresa, Obra o Faena donde se desarrollan los servicios o ejecutan las obras contratadas. A llenar por el Cliente</h6></strong></label>
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
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>3.- Antecedentes del Contratista, ( A llenar solo en caso que el solicitante del Certificado sea subcontratista</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Rut</label>
                                <input type="text" name="rutSub" value="{{ $datos->rutSub}}" witdth="2" class="form-control">
                            </div>
                            
                            <div class="col-xs-12 col-md-10">
                                <label>Razón Social / Nombre (Apellido Paterno Apellido Materno Nombre)</label>
                                <input type="text" name="nomSub" value="{{ $datos->nomSub}}" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Dirección</label>
                                <input type="text" name="dirSub" value="{{ $datos->dirSub}}" witdth="2" class="form-control">
                            </div>
                            
                            <div class="col-xs-12 col-md-4">
                                <label>Comuna</label>
                                <input type="text" name="comSub" value="{{ $datos->comSub}}" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Teléfono</label>
                                <input type="text" name="telSub" value="{{ $datos->telSub}}" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>4.- Individualización de la Obra, Empresa o Faena por la cual solicita el Certificado</h6></strong></label>
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
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>5.- Antecedentes del Mes a Certificar</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Año</label>
                                <input type="number" name="ano" min=2015 max=2025 value="{{ $datos->ano }}" class="form-control" readonly>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Mes</label>
                                <input type="text"  value="@if($datos->mes==1)Enero @elseif($datos->mes==2)Febrero @elseif($datos->mes==3)Marzo @elseif($datos->mes==4)Abril @elseif($datos->mes==5)Mayo @elseif($datos->mes==6)Junio @elseif($datos->mes==7)Julio @elseif($datos->mes==8)Agosto @elseif($datos->mes==9)Septiembre @elseif($datos->mes==10)Octubre @elseif($datos->mes==11)Noviembre @elseif($datos->mes==12)Diciembre @endif" class="form-control" readonly>
                                
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Ingresos del Periodo</label>
                                <input type="number" min=0 name="contratados"  value="{{ $datos->contratados }}" class="form-control" readonly>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Art. 161 del Periodo</label>
                                <input type="number" min=0 name="desvinculados"  value="{{ $datos->desvinculados }}" class="form-control" readonly>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label>Desvinculados de Otras Causas del Periodo</label>
                                <input type="number" min=0 name="otrascausas" value="{{ $datos->otrascausas }}" class="form-control" readonly>
                            </div>
                            <!-- <div class="col-xs-12 col-md-2">
                                <label>Centro de Costo</label>
                                <input type="text" class="form-control" readonly>
                            </div> -->
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>6.- Individualización del Contacto ante SERRESVERIFICADORA SPA</h6></strong></label>
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
                                <label><strong><h6>7.- Archivos para Revisión</h6></strong></label>
                            </div>
                            @foreach($documentos as $documento)
                            <div class="col-xs-12 col-md-12">
                                <label>{{ $documento->tipodocumento}}</label>
                                <a href="{{ '/Archivos/'.$datos->ano.'/'.$documento->documento }}" target="_blank" class="form-control">{{ $documento->documento}}  Tipo: {{$documento->observaciones }}</a>
                            </div>
                            @endforeach
                           
                            <div class="col-xs-12 col-md-12 mt-3">
                                <center><label class="mt-3 mb-3"><strong><h3> Opciones de Procedimientos con el Formulario</h3></strong> </label></center>
                            </div>
                            {!! Form::model($datos, ['route'=>['admsol.update',$datos->id], 'method'=>'PUT']) !!}
                                @csrf
                                <input type="hidden" name="estadoNuevo" value="{{ $datos->identificacion}}">
                                @include('Admin.partials.formEditsolicitud')

                            {!! Form::close() !!}
                     
                    </div>
                <!-- </form> -->
                @endforeach
                    <!-- fin contenido  -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection