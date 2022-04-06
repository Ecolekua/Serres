@extends('errors::illustrated-layout')

@section('code', '419')
@section('title', __('Sesión Expirada'))

@section('image')
    <div style="background-image: url({{ asset('/svg/') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
        <h3> Sus sesión ha expirado vuelva a loguearse en el Sistema</h3>
</br>
<a href="http://clientes.serreschile.cl/login">Click Aquí para Entrar al Sistema</a>
    </div>
@endsection

@section('message', __('Sorry, your session has expired. Please refresh and try again.'))
