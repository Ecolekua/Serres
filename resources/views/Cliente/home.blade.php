@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Menu Cliente</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <center>
                        <iframe frameborder=0 width="1200" height="1000" src="{{ Auth::user()->direccion }}"></iframe>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
