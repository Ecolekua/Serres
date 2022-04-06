@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Menu Administrativo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <center>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="card shadow">
                            <div class="card-header">
                                Eliminador de Solicitudes por ID
                            </div>
                            <form action="{{route('eliminabusquedaadmin.destroy')}}" method="POST">
                                @csrf
                            <div class="card-body">
                                <h5 class="card-title">Eliminar</h5>
                                <p class="card-text">N° Solicitud</p>
                                <div class="col-xs-12 col-md-4">
                                    <input type="number" min="50000" required max="900000" name="solicitud_id" class="form-control mb-3">
                                </div>
                                <input type="submit" value="Eliminar Solicitud" class="btn btn-danger">
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="card shadow">
                            <div class="card-header">
                                Anular  Solicitudes por ID
                            </div>
                            <form action="{{route('solicitud.anular')}}" method="POST">
                                @csrf
                            <div class="card-body">
                                <h5 class="card-title">Anular</h5>
                                <p class="card-text">N° Solicitud</p>
                                <div class="col-xs-12 col-md-4">
                                    <input type="number" min="50000" required max="900000" name="solicitud_id" class="form-control mb-3">
                                </div>
                                <input type="submit" value="Anular Solicitud" class="btn btn-warning">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection