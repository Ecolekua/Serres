@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                  

                <form action="{{route('nuevaPassword.nueva')}}" method="POST">
                    @csrf
                            <h5 class="card-title">Ingrese su Correo Electrónico que utiliza para Iniciar Sesión</h5>
                                <input type="email" required class="form-control" name="correoP">
                            <input type="submit" value="Solicitar reenvío de una Password Nueva" class="btn btn-primary  mt-3">
                </form>
                                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



