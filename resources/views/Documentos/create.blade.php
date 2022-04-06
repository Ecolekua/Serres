@extends('layouts.appAdmin')

@section('content')


<!--  modal de reporte -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Reporte de Carga de Archivos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- tabla de contenido -->
                            <table class="table table-striped" id="tablaReporte">
                                <thead class="thead-dark">
                                    <tr>
                                    <!-- <th scope="col">Id</th> -->
                                    <!-- <th scope="col">Registro ID</th> -->
                                    <th scope="col">Detalle</th>
                                    <th scope="col">Archivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                </table>

                               
                            <!-- fin -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                        </div>
                    </div>
                </div>
<!-- fin -->
<div class="container-fluid" id="divUsers">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">Ingreso de Documentos al Sistema  
                    <span class="float-right">
                        @can('empresas.create')
                      
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
                      <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Etiqueta</th>
                            <th scope="col">Utilizada</th>
                            <th scope="col">Descripción</th>
                            <th scope="col"><center>Añadir</center></th>
                            <th scope="col"><center>Quitar</center></th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($etiquetas as $etiqueta)
                            <tr>
                                <th scope="row">{{ $etiqueta->id}}</th>
                                <th>{{ $etiqueta->tags_group_id }}</th>
                                <th>{{ $etiqueta->name }} </th>
                                <th>{{ $etiqueta->count }}</th>
                                <th>{{ $etiqueta->description}}</th>
                                <td>@can('admsol.index')
                                        <center>
                                            <button class="btn btn-sm btn-success" onclick="AsignarTags({{$etiqueta->id}})"><i class="fa fa-plus-square"></i></button>
                                        </center>
                                    @endcan                                
                                </td> 
                                <td>@can('admsol.index')
                                        <center>
                                            <button class="btn btn-sm btn-danger" onclick="QuitarTags({{$etiqueta->id}})"><i class="fa fa-trash"></i></button>
                                        </center>
                                    @endcan                                
                                </td> 
                            </tr>
                        @endforeach    
                        </tbody>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- box derecho -->
        <div class="col-md-5">
            <div class="card border-primary mb-3">
            <div class="card-header">Información de la Carga</div>
            <div class="card-body text-primary">
                <div>
                    <h2 class="card-title">ID del Proceso   <strong>{{$RegistroCarga}}</strong> <button type="button" class="btn btn-outline-success ml-5" onclick="btnReporte()" data-toggle="modal" data-target="#exampleModalScrollable">Reporte de Carga    <i class="fas fa-tasks"></i></button></h2>
                    <div class="bd-example">
  
</div>

  
                </div>
                <p class="card-text">Para realizar cargas de documentos de distintos contratistas o proyectos se debe reiniciar el Formulario para separar las cargas de Información</p>
                <a href="{{ route('documentos.create')}}" class="btn btn-sm btn-primary  btn-lg btn-block">Reiniciar Formulario de Carga     <i class="fas fa-sync"></i></a>
            </div>
            </div>
            <!-- select de grupos -->
            <div class="card">
                <div class="card-header">
                    Seleccione el Grupo para añadir Etiquetas masivamente a los Archivos a cargar
                </div>
                <div class="card-body">
                    <h5 class="card-title">Escoja Nombre de Grupo</h5>
                    <p class="card-text mb-5">Para añadir etiquetas al formulario del documento utilice los botones con el simbolo (+) para agregar y el (basurero) para quitar.</p>
                    <div class="row mb-5">
                            
                            <div class="col-xs-12 col-md-8 ml-auto">
                                <select name="groups" id="groups" class="form-control">
                                <option value="">Seleccione Grupo</option>
                                    @foreach($groups as $group)
                                        <option value="{{$group->id}}">{{ $group->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-12 col-md-4 ml-auto">
                                <button class="btn btn-sm btn-success" onclick="AsignarTagsGroups()"><i class="fa fa-plus-square"></i></button>
                            
                                <button class="btn btn-sm btn-danger" onclick="QuitarTagsgroups()"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                </div>
            </div>
            <!-- fin -->
        </div>

        <!-- fin -->

        
        <div class="col-md-12">        
                    <!-- fin contenido  -->
                    <!-- Contenido formulario funcionando -->
                    <div class='content mt-2'>
                        <!-- Dropzone -->
                        <form action="{{route('users.fileupload')}}" class='dropzone'>

                                        <div class="row">
                                            <!-- select de proyectos -->
                                              <!-- <div class="col-xs-12 col-md-3 mt-2">
                                                        <div class="card border-primary mb-3" >
                                                            <div class="card-header">Paso 1 Seleccionar Mandante</div>
                                                            <div class="card-body text-primary">
                                                                <h5 class="card-title">Rut,Empresa Principal(Mandante)</h5>
                                                                <select name="empresa_id" id="empresa_id" class="form-control" required>
                                                                        <option value=""></option>
                                                                    @foreach($empresas as $empresa)
                                                                        <option value="{{ $empresa->id }}">{{ $empresa->rut}}, {{$empresa->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                                </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-md-3 mt-2">
                                                        <div class="card border-success mb-3">
                                                            <div class="card-header">Paso 2 Seleccionar Proyecto</div>
                                                            <div class="card-body text-success">
                                                                <h5 class="card-title">Proyecto</h5>
                                                                <select class="custom-select" name="proyecto_id" required id="proyecto_id" required>
                                                                    <option selected></option>
                                                                </select>                            
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-md-3 mt-2">
                                                        <div class="card border-success mb-3">
                                                            <div class="card-header">Paso 3 Seleccionar Contratista</div>
                                                            <div class="card-body text-success">
                                                                <h5 class="card-title">Contratista</h5>
                                                                <select class="custom-select" name="contratista_id" required id="contratista_id" required>
                                                                    <option selected></option>
                                                                </select>                            
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-md-3 mt-2">
                                                        <div class="card border-success mb-3">
                                                            <div class="card-header">Paso 4 Seleccionar Contrato</div>
                                                            <div class="card-body text-success">
                                                                <h5 class="card-title">Contrato</h5>
                                                                <select class="custom-select" name="contrato_id" required id="contrato_id" required>
                                                                    <option selected></option>
                                                                </select>                            
                                                            </div>
                                                        </div>
                                                    </div>  -->



                                            <!-- fin select de proyectos -->
                                            <div class="col-xs-12 col-md-3 mt-2">
                                                        <div class="card border-primary mb-3" >
                                                            <div class="card-header">Asignación de Documentos por N° Solicitud</div>
                                                            <div class="card-body text-primary">
                                                                <h5 class="card-title">N° Solicitud</h5>
                                                                <input type="number" id="numeroSolicitud" name="numeroSolicitud" min="1" class="form-control">
                                                            </div>
                                                        </div>
                                            </div>
                                            <input type="hidden" value="{{$RegistroCarga}}" name="idRegistro" id="idRegistro">
                                        </div>


                        <div class="alert alert-success" role="alert">
                        <label for="tags">Etiquetas Seleccionadas</label>
                        <input type="text" name="tags" readonly id="inputTags"  class="form-control"> <!-- data-role="tagsinput" -->
                        </div>
                        @csrf
                        </form> 
                    </div> 

                        <!-- Script -->
                        <script>

                       

                        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

                        Dropzone.autoDiscover = false;
                        var myDropzone = new Dropzone(".dropzone",{ 
                            maxFilesize: 100,  // 3 mb
                            acceptedFiles: ".jpeg,.jpg,.png,.pdf,.JPG,.rar,.csv,.CSV,.xlsx,.XLSX",
                            
                        });
                        myDropzone.on("sending", function(file, xhr, formData) {
                        formData.append("_token", CSRF_TOKEN);
                        
                        }); 
                        </script>


                    <!-- fin contenido  -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection