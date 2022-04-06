@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Menu Administrador</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-md-6 shadow">
                                <form action="{{ route('ccolpxfechas.reporte') }}" method="post">
                                    @csrf
                                        <div class="form group mt-2 mb-2">
                                            <label for="exampleInputEmail1" class="mb-2 mt-2"><strong>Reporte Solicitudes de CCOLP por Rangos de Fechas</strong></label>
                                        </div>

                                        <div class="form-group">
                                        
                                            <label for="exampleInputEmail1">Fecha Inicial</label>
                                            <input type="date" name="fechai" required class="form-control"  placeholder="Seleccione Fecha Inicio">
                                            <small id="emailHelp"  class="form-text text-muted">esta Fecha puede ser menor o igual a la segunda Fecha, nunca Superior</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Fecha  Final</label>
                                            <input type="date" name="fechaf" required class="form-control"  placeholder="Seleccione Fecha Final">
                                            <small id="emailHelp" required class="form-text text-muted">esta Fecha puede ser mayor o igual a la segunda Fecha, nunca Inferior</small>

                                        </div>
                                    
                                        <button type="submit" class="btn btn-primary mb-3">Generar Reporte en Excel .XLSX</button>
                                </form>
                            </div>
                        </div>
                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection