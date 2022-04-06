@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Creación de Proyectos a Mandantes</div>

                {!! Form::open(['route'=>'proyectos.store']) !!}
                    @csrf
                    @include('Proyectos.partials.form')
                    
                {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
