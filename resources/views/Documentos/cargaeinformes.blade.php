@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">Informes de Cargas y Eliminación masiva de archivos por ID de la carga
                    <!-- <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('documentos.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver al Index de Documentos</a>
                        @endcan  
                    </span> -->
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">

                        <div class="col-xs-12 col-md-6">
                            <div class="col-xs-12 col-md-12">
                                        <div class="card border-primary mb-2" style="max-width: 48rem;">
                                            <div class="card-header">Reporte de Problemas Cargas de Archivos</div>
                                                <div class="card-body text-primary">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-2">
                                                            <h5 class="card-title">N° ID Carga</h5>
                                                        </div>
                                                        <div class="col-xs-12 col-md-2">
                                                            <input type="text" name="idRegistro" size="3" id="idRegistro" class="form-control">
                                                        </div>
                                                        <div class="col-xs-12 col-md-3" >
                                                            <button type="button" class="btn btn-outline-success ml-5" onclick="btnReporte()" data-toggle="modal" data-target="#exampleModalScrollable">Reporte de Carga    <i class="fas fa-tasks"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                            </div>
                            <div class="col-xs-12 col-md-12">
                                        <div class="card border-danger mb-3" style="max-width: 48rem;">
                                            <div class="card-header">Eliminación Masiva de Archivos por ID de Carga</div>
                                                <div class="card-body text-danger">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-2">
                                                            <h5 class="card-title">N° ID Carga</h5>
                                                        </div>
                                                        <div class="col-xs-12 col-md-2">
                                                            <input type="text" name="idRegistroEliminar" size="3" id="idRegistroEliminar" class="form-control">
                                                        </div>
                                                        <div class="col-xs-12 col-md-3" >
                                                            <button type="button" class="btn btn-outline-danger ml-5" onclick="btnEliminaCarga()">Elimina Carga   <i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="card border-dark mb-3" style="max-width: 28rem;">
                                            <div class="card-header">Información del Proceso</div>
                                            <div class="card-body text-dark">
                                                <h5 class="card-title">Eliminación de Cargas</h5>
                                                <p class="card-text">Los Documentos que se eliminen  por medio del ID, no podrán recuperarse ya que serán eliminados completamente del sistema</p>
                                            </div>
                                        </div>
                                    </div>
                        </div>




                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection