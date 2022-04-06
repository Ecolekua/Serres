@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Migración masiva de Empresas por excel
                    <span class="float-right">
                        @can('users.create')
                            <a href="{{ route('users.index')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Volver</a>
                        @endcan  
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Contenido -->
                    
                            <form method="post" action="{{url('/importEmpresas')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="row">
                
                                    <div  class="col-xs-12 col-md-4">

                                        <input type="file" id="excel" name="excel">
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <input type="submit" class="btn btn-primary mt-2" value="Cargar Planilla de Empresas" id="btn_enviar" style="padding: 10px 20px;">
                                    </div>
                                </div>
                            </form>

                    
                    <!-- fin contenido  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection