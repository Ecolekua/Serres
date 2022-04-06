@extends('layouts.app')


                <!-- contenido -->
               

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Formulario de Certificación, <strong>(TODOS LOS CAMPOS CON (*) SON OBLIGATORIOS)</strong>
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
                @foreach( $usuconfor as $datos)
                <form action="{{route('solicitudesCliente.store')}}" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="estructura_id" value="{{ $datos->estructura->id}}">
                <input type="hidden" name="usuConFomulario_id" value="{{ $datos->id}}">

                @csrf
                    <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <center><label><strong><h4>Solicitud para solicitar cumplimiento de obligaciones laborales y previsionales (ley de Subcontratación) </h4></strong></label></center> <!--ID: {{ $datos->id}} -->
                            </div>
                        <!-- nuevo -->
                            <div class="col-xs-12 col-md-12">
                                <center><label><strong><h7><p>El Solicitante declara, bajo juramento, que la información y los antecedentes que está proporcionando,
                                 tanto en esta solicitud como en los documentos que se adjuntan, son veraces y completos, asumiendo desde ya toda la responsabilidad
                                 penal que se genere en caso de detectarse perjurio, lo cual será denunciado por SERRESVERIFICADORA SpA y sus disposiciones y confidencialidad
                                 dispuestas en la página www.serres.cl
                                
                                </p></h7></strong></label></center>
                            </div>

                            <div class="col-xs-12 col-md-12">
                                <center><input type="checkbox" class="form-control" required>
                                <strong><h4>He leido y acepto los terminos y condiciones del aviso legal</h4></strong></center>
                            </div>

                            <div class="col-xs-12 col-md-12">
                              
                                <center><strong><h4>
                                Haga click en el cuadro de arriba para aceptar las condiciones. Sin esto no podrá usar envíar el formulario
                                </h4></strong></center>
                            </div>
                     
                            <!-- fin nuevo -->

                            <div class="col-xs-12 col-md-12 mt-3">
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
                                <label>Domicilio Legal</label>
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
                                <label><strong><h6>Enviar a: (Responsable Empresa Principal)</h6></strong></label>
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
                                <input type="text" name="rutSub" witdth="2" class="form-control">
                            </div>
                            
                            <div class="col-xs-12 col-md-10">
                                <label>Razón Social / Nombre (Apellido Paterno Apellido Materno Nombre)</label>
                                <input type="text" name="nomSub" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Dirección</label>
                                <input type="text" name="dirSub" witdth="2" class="form-control">
                            </div>
                            
                            <div class="col-xs-12 col-md-4">
                                <label>Comuna</label>
                                <input type="text" name="comSub" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Teléfono</label>
                                <input type="text" name="telSub" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>4.- Individualización de la Obra, Empresa o Faena por la cual solicita el Certificado</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label>Nombre de la Obra, Faena, Servicio</label>
                                <input type="text" witdth="2" class="form-control" readonly value="{{ $datos->estructura->proyecto->proyecto }}">
                            </div>
                            
                            <div class="col-xs-12 col-md-3">
                                <label>N° total de Trabajadores vigentes en Obra(*)</label>
                                <input type="number" min=1 name="totalvigentes"   class="form-control" required >
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
                                <label>N° Contrato y/o Nombre de Servicio</label>
                                <input type="text" class="form-control" readonly value="{{ $datos->estructura->contrato }}">
                            </div>
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>5.- Antecedentes del Mes a Certificar</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Año (*)</label>
                                <input type="number" name="ano" min=2015 max=2025 class="form-control" required>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Mes (*)</label>
                                <select class="form-control" name="mes" required>
                                    <option value="">Seleccione Mes</option>
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Ingresos del Periodo (*)</label>
                                <input type="number" min=0 name="contratados"  value="0" class="form-control" required placeholder="Valor mínimo es 0">
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label>Desviculados Art. 161 del Periodo (*)</label>
                                <input type="number" min=0 name="desvinculados"  value="0" class="form-control" required placeholder="Valor mínimo es 0">
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label>Desvinculados otras causales del Periodo (*)</label>
                                <input type="number" min=0 name="otrascausas" value="0" class="form-control" required placeholder="Valor mínimo es 0">
                            </div>
                            <!-- <div class="col-xs-12 col-md-2">
                                <label>Centro de Costo</label>
                                <input type="text" class="form-control">
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
                                <label><strong><h6>7.- Archivos para Adjuntar</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label><strong>Libro de Remuneraciones del Mes a Certificar ( Necesario solo si son más de 5 Trabajadores )</strong></label>
                                <input type="file" name="lib" witdth="2" class="form-control">
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label><strong>Liquidaciones de Sueldos del Mes a Certificar (firmadas por los trabajadores o comprobantes de abono en CTA. Bancaria del trabajador)(*)</strong></label>
                                <input type="file" name="liq" witdth="2" class="form-control" required>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label><strong>Planilla de Imposiciones pagadas del Mes a Certificar(*)</strong></label>
                                <input type="file" name="cot" witdth="2" class="form-control" required>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label><strong>Finiquitos del Mes Ratificados ante Notario o Ministro de Fe competente (si procede)</strong></label>
                                <input type="file" name="fin" witdth="2" class="form-control">
                            </div>
                            
                            <!-- nuevos -->
                            <div class="col-xs-12 col-md-12">
                                <label><strong>Nómina de Trabajadores a Certificar (subir archivo en formato Excel) (*)</strong></label>
                                <input type="file" name="nom" witdth="2" class="form-control" required>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label><strong>Contratos de Trabajos de Nuevos Trabajadores</strong></label>
                                <input type="file" name="con" witdth="2" class="form-control">
                            </div>
                            

                            <!-- fin nuevos -->


                            <div class="col-xs-12 col-md-6 mt-3">
                                <center><input type="submit" value="Aceptar" class="btn btn-success"></center>
                            </div>
                            <div class="col-xs-12 col-md-6 mt-3">
                                <center><label>
                                <input type="checkbox" name="noenviar" value=1 class="form-control">
                                Al Marcar esta casilla usted Guarda su solicitud, quedando pendiente su envío desde el menu <strong>Solicitudes Aprobadas y guardadas</strong>
                                </label>
                                </center>
                            </div>

                    </div>
                </form>
                @endforeach
                    <!-- fin contenido  -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection