@extends('layouts.app')

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
                <div class="col-xs-12 col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            Busqueda de Solicitudes por ID
                        </div>
                        <form action="{{route('buscarSolicitud.buscador')}}" method="POST">
                            @csrf
                        <div class="card-body">
                            <h5 class="card-title">Buscador</h5>
                            <p class="card-text">N° Solicitud</p>
                            <div class="col-xs-12 col-md-4">
                                <input type="number" min="50000" required max="900000" name="solicitud_id" class="form-control mb-3">
                            </div>
                            <input type="submit" value="Buscar Solicitud" class="btn btn-success">
                        </div>
                        </form>
                    </div>
                </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection