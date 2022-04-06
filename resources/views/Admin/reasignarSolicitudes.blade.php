@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-xs-12 col-md-12">
                <div class="card">
                    <div class="card-header">Reasignación de Solicitudes</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <center>
                            <div class="card text-center">
                                <div class="card-header">
                                    Reasignación de Solicitudes a Inspectores
                                </div>
                                <form action="{{route('reasignarSolicitud.store')}}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <h5 class="card-title">Indique N° Solicitud </h5>
                                            <center><div class="col-xs-12 col-md-2">
                                                <input type="number" name="solicitud_id" required min="1" max="900000" class="form-control">
                                            </div></center>
                                        <p class="card-text">Seleccione el Nuevo Inspector de la Lista</p>
                                            <center><div class="col-xs-12 col-md-4">
                                                <select name="inspector_id" id="" class="form-control mb-4">
                                                    @foreach($inspectores as $inspector)
                                                        <option value="{{ $inspector->id }} ">{{ $inspector->name }} </option>
                                                    @endforeach

                                                </select>
                                            </div></center>
                                        <input type="submit" class="btn btn-primary" value="Reasignar Inspector a la Solicitud">
                                    </div>
                                </form>
                                <div class="card-footer text-muted">
                                --
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection