@extends('layouts.app')


                <!-- contenido -->
               

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">SOLICITUD DE AUDITORIA DOCUMENTAL, <strong>(TODOS LOS CAMPOS CON (*) SON OBLIGATORIOS)</strong>
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
                
             

                <input type="hidden" name="estructura_id" value="">
                <input type="hidden" name="usuConFomulario_id" value="">

   
                    <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <center><label><strong><h4>SOLICITUD DE AUDITORIA DOCUMENTAL DERCO</h4></strong></label></center> 
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
                            <!--<div class="col-xs-12 col-md-12">
                                <center><input type="checkbox" name="checkleyempleo" class="form-control">
                                <strong><h4>Declaro habernos acogido a la Ley de Protección del Empleo durante los meses que detallo </h4></strong></center>
                            </div>
                            <div class="col-xs-12 col-md-3">
                            </div>
                            <div class="col-xs-12 col-md-6">
                            <center><input type="text" name="obserleyempleo" class="form-control"></center>
                            </div>
                            <div class="col-xs-12 col-md-3">
                            </div>

                             fin nuevo -->

                            <div class="col-xs-12 col-md-12 mt-3">
                                <label><strong><h6>1.- Individualización del Cliente (Contratista o Subcontratista)</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Rut</label>
                                <input type="text" name="rutContratista" witdth="2" class="form-control" readonly value=" ">
                            </div>
                            
                            <div class="col-xs-12 col-md-10">
                                <label>Razón Social / Nombre (Apellido Paterno Apellido Materno Nombre)</label>
                                <input type="text" name="nombreContratista" class="form-control" readonly value="">
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Domicilio Legal</label>
                                <input type="text" witdth="2" class="form-control" readonly value="">
                            </div>
                            
                            <div class="col-xs-12 col-md-4">
                                <label>Comuna</label>
                                <input type="text" class="form-control" readonly value="">
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" readonly value="">
                            </div>

                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>2.- Antecedentes de la Empresa Principal, (Información referida al dueño de la empresa, Obra o Faena donde se desarrollan los servicios o ejecutan las obras contratadas. A llenar por el Cliente</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Rut</label>
                                <input type="text" name="rutMandante" witdth="2" class="form-control" readonly value="">
                            </div>
                            
                            <div class="col-xs-12 col-md-10">
                                <label>Razón Social / Nombre (Apellido Paterno Apellido Materno Nombre)</label>
                                <input type="text" name="nombreMandante" class="form-control" readonly value="">
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Dirección</label>
                                <input type="text" witdth="2" class="form-control" readonly value="">
                            </div>
                            
                            <div class="col-xs-12 col-md-4">
                                <label>Comuna</label>
                                <input type="text" class="form-control" readonly value="">
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" readonly value="">
                            </div>
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>Enviar a: (Responsable Empresa Principal)</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-7">
                                <label>Nombre</label>
                                <input type="text" witdth="2" class="form-control" readonly value="">
                            </div>
                            
                            <div class="col-xs-12 col-md-5">
                                <label>Cargo</label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <div class="col-xs-12 col-md-7">
                                <label>Email</label>
                                <input type="text" witdth="2" class="form-control" readonly value="">
                            </div>
                            
                            <div class="col-xs-12 col-md-5">
                                <label>Telefono</label>
                                <input type="text" class="form-control" readonly value="">
                            </div>
                          
                               
                                    <!-- datos del contratista por cadena de responsabilidades  25012020
                                    <div class="col-xs-12 col-md-12 mt-2 ">
                                        <label><strong><h6>3.- Antecedentes del Contratista</h6></strong></label>
                                    </div>
                                    <div class="col-xs-12 col-md-2">
                                        <label>Rut</label>
                                        <input type="text" name="rutSub" readonly value="" witdth="2" class="form-control">
                                    </div>
                                    
                                    <div class="col-xs-12 col-md-10">
                                        <label>Razón Social / Nombre (Apellido Paterno Apellido Materno Nombre)</label>
                                        <input type="text" name="nomSub" readonly value="" class="form-control">
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <label>Dirección</label>
                                        <input type="text" name="dirSub" witdth="2" readonly value="" class="form-control">
                                    </div>
                                    
                                    <div class="col-xs-12 col-md-4">
                                        <label>Comuna</label>
                                        <input type="text" name="comSub" readonly value="" class="form-control">
                                    </div>
                                    <div class="col-xs-12 col-md-2">
                                        <label>Teléfono</label>
                                        <input type="text" name="telSub" readonly value="" class="form-control">
                                    </div>
                                  fin datos del contratista por cadena de responsabilidades
                 
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>4.- Individualización de la Obra, Empresa o Faena por la cual solicita el Certificado</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label>Nombre de la Obra, Faena, Servicio</label>
                                <input type="text" name="proyecto" witdth="2" class="form-control" readonly value="">
                            </div>
                            
                            <div class="col-xs-12 col-md-3">
                                <label>N° total de Trabajadores vigentes en Obra(*)</label>
                                <input type="number" min=1 max=4000 name="totalvigentes"   class="form-control" required >
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <label>Dirección de la Obra objeto del Certificado</label>
                                <input type="text" witdth="2" class="form-control" readonly value="">
                            </div>
                            
                            <div class="col-xs-12 col-md-4">
                                <label>Comuna</label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>N° Contrato y/o Nombre de Servicio</label>
                                <input type="text" name="contrato" class="form-control" readonly value="">
                            </div>
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>5.- Antecedentes del Mes a Certificar</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Año (*)</label>
                                <input type="number" name="ano" min=2015 max=2029 class="form-control" required>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Mes (*)</label>
                                <select class="form-control" name="mes" required>
                                    <option value="">Seleccione Mes</option>
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-md-2">
                                <label>Ingresos del Periodo (*)</label>
                                <input type="number" min=0 max=4000 name="contratados"  value="0" class="form-control" required placeholder="Valor mínimo es 0">
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label>Desviculados Art. 161 del Periodo (*)</label>
                                <input type="number" min=0 max=4000 name="desvinculados"  value="0" class="form-control" required placeholder="Valor mínimo es 0">
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <label>Desvinculados otras causales del Periodo (*)</label>
                                <input type="number" min=0 max=4000 name="otrascausas" value="0" class="form-control" required placeholder="Valor mínimo es 0">
                            </div>
                             <div class="col-xs-12 col-md-2">
                                <label>Centro de Costo</label>
                                <input type="text" class="form-control">
                            </div> 
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>6.- Individualización del Contacto ante SERRESVERIFICADORA SPA</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <label>Nombre</label>
                                <input type="text" witdth="2" class="form-control" readonly value=" ">
                            </div>
                            
                            <div class="col-xs-12 col-md-3">
                                <label>Teléfono</label>
                                <input type="text" class="form-control" readonly value="">
                            </div>
                            <div class="col-xs-12 col-md-12">
                                <label>Email</label>
                                <input type="text" witdth="2" class="form-control" readonly value=" ">
                            </div>

                             -->
                            <div class="col-xs-12 col-md-12 mt-2 ">
                                <label><strong><h6>3.- Archivos para Adjuntar</h6></strong></label>
                            </div>
                            <div class="col-xs-12 col-md-6 mt-3 ">
                            <label><strong>Seleccionar tipo de Documento</strong></label>
                            <select class="form-control " name="">
                                <option>Seleccione el Tipo de Documento</option>
                                <option>Empresa/Trabajadores en Sistema</option>
                                <option>Trabajador/Contratos de Trabajo</option>
                                <option>Trabajador/Cédulas de Identidad</option>
                                <option>Trabajador/Anexo de Contrato</option>
                                <option>Trabajador/Certificado de Extranjería</option>
                                <option>Trabajador/Licencia de conducir</option>
                                <option>Trabajador/Certificado OS10</option>
                                <option>Trabajador/Certificado Antecedentes</option>
                                <option>Empresa/Libro de Asistencia</option>
                                <option>Empresa/Formulario F30</option>
                                <option>Empresa/Solicitud F 43</option>
                                <option>Empresa/Resolucion F 43</option>
                                <option>Empresa/Contrato Comercial</option>
                                <option>Empresa/Reglamento Especial Contratista REC</option>
                                <option>Empresa/Toma de conocimiento REC</option>
                                <option>Empresa/Política de Seguridad</option>
                                <option>Empresa/Toma Cono. Plan Emergencia Mandante</option>
                                <option>Empresa/Reglamento Interno de Orden, Higiene y Seguridad</option>
                                <option>Trabajador/Entrega Elementos de Protección Personal</option>
                                <option>Trabajador/Toma Conoc. Trab. Obligación de Informar (ODI)</option>
                                <option>Trabajador/Política de Seguridad</option>
                                <option>Trabajador/Toma Conoc. Trab. Plan de Emergencia</option>
                                <option>Trabajador/Toma Conoc. Trab. Reglamento Interno</option>



                            </select>
                            </div>
                            <div class="col-xs-12 col-md-6 mt-3">
                                <label><strong>Adjuntar Documento</strong></label>
                                <input type="file" name="lib" witdth="2" class="form-control">
                            </div>

                            

                            <!-- fin nuevos -->


                            <div class="col-xs-12 col-md-6 mt-3">
                                <center><input type="" value="Aceptar" class="btn btn-success"></center>
                            </div>
                            <!-- <div class="col-xs-12 col-md-6 mt-3">
                                <center><label>
                                <input type="checkbox" name="noenviar" value=1 class="form-control">
                                Al Marcar esta casilla usted Guarda su solicitud, quedando pendiente su envío desde el menu <strong>Solicitudes Aprobadas y guardadas</strong>
                                </label>
                                </center>
                            </div> -->

                    </div>
            

                    <!-- fin contenido  -->
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection