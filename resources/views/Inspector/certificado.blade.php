@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Emisión del Certificado
                    <span class="float-right">
                        <!-- @can('usuconforms.create')
                            <a href="{{ route('usuconforms.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Asignar Contratistas a Usuarios para Administrar Solicitudes</a>
                        @endcan   -->
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Contenido -->
        @foreach($certificado as $cert)      
			<div class="col-xs-12 col-md-12" id="principal">
               <div class="row">

                    <div class="col-xs-12 col-md-12">
                        <div class="card mt-2">
                            <div class="card-header">
                            Certificado
                            </div>
                           

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-2 ml-2">
                                        Mes :
                                           <input type="text" readonly value="{{$cert->mes}}" class="form-control">
                                    </div>
                                    <div class="col-xs-12 col-md-2">
                                    Año
                                        <input type="text" readonly value="{{$cert->anio}}"  class="form-control">
                                    </div>

                                    <div class="col-xs-12 col-md-7 ml-2 mt-2 mb-2">
                                        Proyecto
                                        <input type="text" readonly value="{{$cert->estructura->proyecto->proyecto}}" class="form-control">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 mt-2">
                        <div class="card mt-2">
                            <div class="card-header">
                                Identificación del Cliente (Contratista) Nº Certificado <label><input type="text" name="ncert" id="ncert" class="form-control"  readonly="readonly" value="{{$cert->id}}"></label>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-2 ml-2 mt-2">
                                        Rut
                                        <input type="text" readonly id="rutraz" class="form-control" value="{{$cert->estructura->empresa->rut}}" name="">
                                       
                                    </div>
                                    <div class="col-xs-12 col-md-6  mt-2">
                                        Nombre ó Razón Social
                                        <input type="text" readonly id="nomraz" value="{{$cert->estructura->empresa->nombre}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-3  mt-2">
                                        Teléfono
                                        <input type="text" readonly id="telraz" value="{{$cert->estructura->empresa->telefonos}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-4 ml-2 mt-2">
                                        Dirección
                                        <input type="text" readonly id="dirraz" value="{{$cert->estructura->empresa->dirección}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-4  mt-2">
                                        Nombre Contacto
                                        <input type="text" readonly id="nombrecontacto" value="{{$cert->estructura->empresa->nomContacto}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-3 mb-2  mt-2">
                                        Email
                                        <input type="text" readonly id="emaccli" value="{{$cert->estructura->empresa->emailContacto}}" class="form-control" name="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 mt-2">
                        <div class="card">
                            <div class="card-header">
                            Identificación del Proyecto


                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-2 ml-2 mt-2">
                                    N°Contrato
                                        <input type="text" readonly id="ncon" value="{{$cert->estructura->contrato}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-6  mt-2">
                                    Proyecto
                                        <input type="text" readonly id="cencos" value="{{$cert->estructura->proyecto->proyecto}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-3 mb-2 mt-2">
                                    División
                                        <input type="text" id="division" readonly class="form-control" name="" value="">
                                    </div>
                                    <div class="col-xs-12 col-md-11 mb-2 ml-2">
                                    Descripción del Servicio
                                        <input type="text" id="descrip" readonly class="form-control" name="" value="">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12 mt-2">
                        <div class="card">
                            <div class="card-header">
                            Identficación de la Empresa Mandante
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-md-2 ml-2 mt-2">
                                    Rut
                                        <input type="text" readonly id="rut_mandante" class="form-control" value="{{$cert->estructura->proyecto->empresa->rut}}" name="">
                                       
                                    </div>
                                    <div class="col-xs-12 col-md-9  mt-2">
                                    Nombre ó Razón Social
                                        <input type="text" readonly id="nom_mandante"  value="{{$cert->estructura->proyecto->empresa->nombre}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-8 mb-2 ml-2 mt-2">
                                        Dirección
                                        <input type="text" readonly id="dir_mandante"   value="{{$cert->estructura->proyecto->empresa->direccion}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-3 mb-2 mt-2">
                                    Teléfono
                                        <input type="text" readonly id="tel_mand" value="{{$cert->estructura->proyecto->empresa->telefonos}}"  class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-5 mb-2 ml-2 mt-2">
                                        Contacto
                                        <input type="text" readonly id="cont_mand" value="{{$cert->estructura->proyecto->empresa->nomContacto}}" class="form-control" name="">
                                    </div>
                                    <div class="col-xs-12 col-md-6 mb-2 mt-2">
                                    Email
                                        <input type="text" readonly id="email_cont"value="{{$cert->estructura->proyecto->empresa->emailContacto}}" class="form-control" name="">
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12 mt-2">
                        <div class="card">
                            <div class="card-header">
                            Identficación del Contratista
                            </div>
                            @if (isset($cert->estructura->contratistasubcontrato->rut))
                                @if ($cert->estructura->contratistasubcontrato->rut!=NULL)
                           
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-2 ml-2 mt-2">
                                            Rut
                                                <input type="text" id="rut_opcional" readonly value="{{ $cert->estructura->contratistasubcontrato->rut }}" name="rut_opcional" class="form-control" name="">
                                            </div>
                                            <div class="col-xs-12 col-md-9 mb-2 mt-2">
                                            Nombre ó Razón Social
                                                <input type="text" id="nom_opcional"  readonly value=" {{ $cert->estructura->contratistasubcontrato->nombre }}" class="form-control" name="">
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            @else
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-2 ml-2 mt-2">
                                            Rut
                                                <input type="text" id="rut_opcional" readonly value="" name="rut_opcional" class="form-control" name="">
                                            </div>
                                            <div class="col-xs-12 col-md-9 mb-2 mt-2">
                                            Nombre ó Razón Social
                                                <input type="text" id="nom_opcional"  readonly value="" class="form-control" name="">
                                            </div>

                                        </div>
                                    </div>
                            @endif

                        </div>
                    </div>


                    <div class="col-xs-12 col-md-12 mt-2">
                      
                            <div class="card">
                                <div class="card-header">
                                Nómina de Trabajadores Mes actual
                                </div>
                                <div class="card-body">
                                <table class="table" id="tabla_trabajadores_delmes">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">N</th>
                                            <th scope="col">Rut</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cargo</th>
                                            <th scope="col">Estado</th>
                                            <th scope="col">Total Imponible</th>
                                            <th scope="col">Total Haber</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                               
                                                <th scope="col"></th>
                                               
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                               
                                                <th scope="col"></th>
                                                   
                                                <th scope="col"></th>
                                              
                                            </tr>
                                            

                                    </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
               <div class="row">
                    <div class="col-xs-12 col-md-4 mt-2">
                        Totales Imponibles :<input type="number" style="text-align:right"  value="" class="form-control" id="tot_imp" readonly="readonly">
                    </div>
                    <div class="col-xs-12 col-md-4 mt-2">
                        Totales Haber : <input type="number" style="text-align:right" value="" id="tot_hab" class="form-control" readonly="readonly">
                    </div>

                    <div class="col-xs-12 col-md-4 mt-2">
                        Total a Certificar:<input type="number" style="text-align:right" value="" id="t_t_c" class="form-control" readonly="readonly">
                    </div>
                </div>

            <div class="row">
                <div class="col-xs-12 col-md-12 mt-3">
                    <!--<input type="button" class="btn btn-primary" value="Traer Sin Información/Desvinculados" id="trae_acu">-->
                        <div class="card">
                            <div class="card-header">
                            Nómina de Trabajadores Mes Anterior Desvinculados

                            </div>
                            <div class="card-body">
                            <table class="table" id="tabla_trabajadores_sininfo">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">N</th>
                                        <th scope="col">Rut</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Causal</th>
                                        <!--<th scope="col">Desv. F/R</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                               
                                                <th scope="col"></th>

                                                 
                                                <th scope="col"></th>


                                                <th scope="col">Desvinculado</th>

                                                <th scope="col">

                                                
                                                </th>

                                            </tr>
                                           
                                    </tbody>

                                </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-4 mt-2">
                        Total a Certificar:<input type="number" style="text-align:right" id="t_t_c_acu" value="" class="form-control" readonly="readonly">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-12 mt-2">
                        <div class="card text-center">
                            <div class="card-header">
                                Calculo de Movinientos del mes
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <td class="text-left">1.- Observaciones parte Remuneracional</td>
                                        <td><label>Monto Remuneracional</label></td>
                                    </tr>
                                    <tr>

                                        <td><input type="text" readonly class="form-control" value="" name="obs_rem" id="obs_rem" size="100"><br/>
                                        <input type="text" readonly class="form-control" value="" name="obs_rem2" id="obs_rem2" size="100">
                                    </td>
                                        <td><input type="text" readonly class="form-control" id="monto_rem" value="" name="monto_rem"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">2.- Observaciones parte Previsional</td>
                                        <td>Monto Previsional</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" readonly class="form-control" id="obs_pre" value="" name="obs_pre" size="100"><br/></td>
                                        <td><input type="text" readonly class="form-control" id="monto_pre" value="" name="monto_pre"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">3.- No presentación de Documentos</td>
                                    </tr>
                                        
                                    <tr>
                                        <td><input type="text" class="form-control" id="obs_doc" value="" name="obs_doc" size="100"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">4.-Observaciones Administrativas</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control" id="obs_adm" value="" name="obs_adm" size="100"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="form-control" id="obs_doc" name="obs_doc" size="100"></td>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td>Documentación Revizada</td>
                                                </tr>
                                                  
                                                        <tr>
                                                            <td><center>Contratos</br></center><input type="checkbox" readonly class="form-control"></td>
                                                            <td><center>Finiquitos</br></center><input type="checkbox" readonly  class="form-control"></td>
                                                            <td><center>Planilla de Sueldos</br></center><input type="checkbox" readonly  class="form-control"></td>
                                                            <td><center>Cotizaciones Previsionales</br></center><input type="checkbox" readonly  class="form-control"></td>
                                                        </tr>
                                                
                                            </table>
                                    </tr>
                                </table>

                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 mt-2">
                        <div class="card text-center">
                            <div class="card-header">
                            Moviemintos del Personal Mensual

                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Mes Revisado </th>
                                        <th><input type="text" readonly id="mesrev" value="" class="form-control" class="largo"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>Dotación Mes Anterior</th>
                                        <th><input type="text" readonly id="mes_anterior" value="" name="mes_anterior" class="form-control" class="largo"></th>
                                    </tr>
                                    <tr>
                                        <th>Contrataciones - Ingresos x Traslados</th>
                                        <th><input type="text" readonly id="nuevos" name="nuevos" value="" class="form-control" class="corto"></th>
                                    </tr>
                                    <tr>
                                        <th>Total Revisados</th>
                                        <th><input type="text" readonly id="tot_rev" name="tot_rev" value="" class="form-control" class="corto"></th>
                                    </tr>
                                    <tr>
                                        <th>Retiros - Finiquitos - Traslados</th>
                                        <th><input type="text" readonly id="dev" name="dev" value="" class="form-control" class="corto" name=""></th>
                                    </tr>
                                    <tr>
                                        <th>Dotación Final del Mes</th>
                                        <th><input type="text" readonly id="tot_actual_mes" value="" name="tot_actual_mes" class="form-control" class="corto" name="" value=""></th>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                                <div class="card-footer text-muted">
                                    <!--<input type="button" class="btn btn-primary" value="Calcular Movimiento" id="calc_mov">-->
                                </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6 mt-2">
                        <div class="card border-primary mb-3">
                            <div class="card-header">Firmar Certificado</div>
                                <div class="card-body text-primary text-center">

                                        <div class="row">
                                            <!--<input type="submit" class="btn btn-success mt-2 mb-2" value="Firmar Certificado"> -->
                                            <div class="col-xs-12 col-md-4">
                                                Fecha Emisión<input type="date" value="" class="form-control"  name="fecha_emision_nueva" >
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                Fecha Inicio Inspección<input type="date" value="" class="form-control" name="fecha_inicio_inspec" >
                                            </div>
                                            <div class="col-xs-12 col-md-4">
                                                Fecha Termino Inspección<input type="date" value="" class="form-control" name="fecha_termino_inspec" >
                                            </div>
                                        </div>
                                                </br>

                                                <input type="submit" class="btn btn-success mr-5"  value="Firmar" />


                                                <input type="submit" target="_blank" class="btn btn-warning"  value="Ver Certificado" />
                                                </br>
                                                </br>


                            </div>
                    </form>
                           

                        </div>
                       
                        <div class="card border-primary mb-3">
                            <div class="card-header">Rezachar Certificado</div>
                            <div class="card-body text-primary text-center">


                                <input type="button" class="btn btn-danger  mb-3 mt-3" id="rechazo" value="Rezachar Certificado">
                                <br/>
                               
                            </div>
                        </div>
                    </div>
                    


            </div>
<div>
                    <!-- fin contenido  -->
        @endforeach            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection