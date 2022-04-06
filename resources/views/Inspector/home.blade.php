@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard Inspector</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- <button class="btn btn-success btn-lg btn-block mb-3" type="button" data-toggle="collapse" data-target="#collapseExamplecon2" aria-expanded="false" aria-controls="collapseExample">
															Solicitudes Nuevas 
					</button> -->
                    <script type="text/javascript">
						$(document).ready(function(){
							$('#tabla_solicitudesInspector').DataTable(
                                {
    buttons: [
        'copy', 'excel', 'pdf'
    ]
}
                            );
							});
					</script>
                    <!-- <div class="col-xs-12 col-md-12 collapse" id="collapseExamplecon2"> -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Nuevas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">En Proceso</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <!-- tabla de contenidos       -->
                            <table class="table table-hover" id="tabla_solicitudesInspector">
                                <thead>
                                    <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Fecha Creación</th>
                                    <th scope="col">Fecha de Envío</th>
                                    <th scope="col">Rut Cliente</th>
                                    <th scope="col">Razón Social Cliente</th>
                                    <th scope="col">Rut Mandante</th>
                                    <th scope="col">Razón Social Mandante</th>
                                    <th scope="col">Contrato, Servicio</th>
                                    <th scope="col">Dotación</th>
                                    <th scope="col">Mes</th>
                                    <th scope="col">Año</th>
                                    <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>10-10-2019</td>
                                    <td>10-10-2019</td>
                                    <td>76526789-9</td>
                                    <td>Empresa de Prueba</td>
                                    <td>77526789-k</td>
                                    <td>Mandante de Prueba</td>
                                    <td>empr-3454-ffgt, Aseo Industrial</td>
                                    <td>200, Trabajadores</td>
                                    <td>Agosto</td>
                                    <td>2019</td>
                                    <td><input type="button" class="btn btn-primary btn-sm" value="Ver"></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <!-- fin -->
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                             <!-- tabla de contenidos       -->
                             <table class="table table-hover" id="tabla_solicitudesInspector">
                                <thead>
                                    <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Fecha Creación</th>
                                    <th scope="col">Fecha de Envío</th>
                                    <th scope="col">Rut Cliente</th>
                                    <th scope="col">Razón Social Cliente</th>
                                    <th scope="col">Rut Mandante</th>
                                    <th scope="col">Razón Social Mandante</th>
                                    <th scope="col">Contrato, Servicio</th>
                                    <th scope="col">Dotación</th>
                                    <th scope="col">Mes</th>
                                    <th scope="col">Año</th>
                                    <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <th scope="row">1</th>
                                    <td>10-10-2019</td>
                                    <td>10-10-2019</td>
                                    <td>76526789-9</td>
                                    <td>Empresa de Prueba</td>
                                    <td>77526789-k</td>
                                    <td>Mandante de Prueba</td>
                                    <td>empr-3454-ffgt, Aseo Industrial</td>
                                    <td>200, Trabajadores</td>
                                    <td>Agosto</td>
                                    <td>2019</td>
                                    <td><input type="button" class="btn btn-success btn-sm" value="Revisar"><input type="button" class="btn btn-danger btn-sm" value="Eliminar"><input type="button" class="btn btn-primary btn-sm" value="Responder"></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            <!-- fin -->
                    </div>
                    <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
                    </div>
                          
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
