@extends('layouts.appAdmin')

@section('content')
<div class="container-fluid" id="divUsers">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Emisión de Certificados
                    <span class="float-right">
                        @can('empresas.create')
                            <a href="{{ route('documentos.create')}}" class="btn btn-sm btn-primary mr-auto ml-auto">Carga de Documentos</a>
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


                    <input type="file" id="excelfile" />  
                    <input type="button" id="viewfile" value="Export To Table" onclick="ExportToTable()" />  
                        <br />  
                        <br />  
                    <table id="exceltable">  
                    </table> 
                   
                    <!-- fin contenido  -->
                   
                     
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
