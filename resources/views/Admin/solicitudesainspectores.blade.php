@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Carga de Planila para asignación masiva con archivo Excel.
                    <span class="float-right">
                       
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Contenido -->
                   
                       
                                            <center>
                                                <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#asignacioninspectores">
                                                    |<i class="fas fa-clipboard-list"></i> Asignación Masiva de Solicitudes a Inspectores
                                                </button>
                                            </center>
                  
                    <!-- fin contenido  -->

                     <!-- Modal -->
                     <div class="modal fade" id="asignacioninspectores" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle"><center>Cargue Planilla para Asignación de solicitudes Masivamante a Inspectores</center></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Contenido -->
                                           
                                                    <form method="post" action="{{route('carga.inspectoresasolicitudes')}}" enctype="multipart/form-data">
                                                            {{csrf_field()}}
                                                        <div class="row">
                                        
                                                            <div  class="col-xs-12 col-md-4">

                                                                <input type="file" id="excel" required name="excel">
                                                               
                                                            </div>
                                                            <div class="col-xs-12 col-md-12">
                                                                <input type="submit" class="btn btn-primary mt-2" value="Cargar Planilla para Asignaciones" id="btn_enviar" style="padding: 10px 20px;">
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection