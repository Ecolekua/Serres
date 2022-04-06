@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear de Roles y sus Perfiles
                    <span class="float-right">
                        @can('users.create')
                            <a href="{{ route('roles.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
                        @endcan  
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Contenido formulario funcionando -->
                    {!! Form::open(['route'=>'rolesprofiles.store']) !!}
                        @csrf

                        @include('RolesProfiles.partials.form')

                    {!! Form::close() !!}
                    



                    <!-- fin contenido  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection