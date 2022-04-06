<div class="card-body">
                    <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="col-xs-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                   <strong> 1.- Mandantes </strong>
                                </div>
                                
                                <div class="card-body">
                                    <h5 class="card-title">Seleccionar Mandante para Lista Proyectos</h5>
                                    <select class="form-control" required id="selectEmpresa" name="empresa_id">
                                        @foreach($empresas as $empresa)
                                            <option value='{{$empresa->id}}'>{{ $empresa->rut }}, {{ $empresa->nombre }} </option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                   
                    </div>
               
                    <div class="col-xs-12 col-md-12">
                        <div class="col-xs-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                   <strong> 2.- Datos del Proyectos </strong>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Escriba los datos del nuevo Proyecto</h5>
                                    <div class="form-comtrol col-xs-12 col-md-1">
                                        {{ Form::label('proyecto','Proyecto') }}
                                    </div>
                                    <div class="form-comtrol col-xs-12 col-md-10">        
                                        {{ Form::text('proyecto',null,['class'=>'form-control','required']) }}
                                            <?php $var=1; ?>
                                        {{ Form::hidden('activo',$var,['class'=>'form-control','required',]) }}
   
                                    </div> 
                                    <!-- <div class="form-comtrol col-xs-12 col-md-1">
                                        {{ Form::label('fechaInicio','Fecha Inicio') }}
                                    </div> 
                                    <div class="form-comtrol col-xs-12 col-md-5">        
                                        {{ Form::date('fechaInicio',null,['class'=>'form-control','required']) }}
                                    </div> -->
                                    <div class="form-comtrol col-xs-12 col-md-1">
                                        {{ Form::label('direccion','Dirección') }}
                                    </div>
                                    <div class="form-comtrol col-xs-12 col-md-10">        
                                        {{ Form::text('direccion',null,['class'=>'form-control','required']) }}
                                    </div> 
                                    <div class="form-comtrol col-xs-12 col-md-1">
                                        {{ Form::label('direccion','Comuna') }}
                                    </div>
                                    <div class="form-comtrol col-xs-12 col-md-8 mb-2">        
                                       <select name="comuna" class="form-control">
                                            <option value="" required>Seleccione una Comuna</option>
                                            @foreach ($comunas as $comuna)
                                                <option value="{{$comuna->comuna }}">{{$comuna->comuna }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                    <strong class="mt-3 mb-2"> 3.- Datos del Contacto en el Proyectos (Opcional)</strong>
                                    <div class="form-comtrol col-xs-12 col-md-1 mt-2">
                                        {{ Form::label('contacto','Contacto') }}
                                    </div>
                                    <div class="form-comtrol col-xs-12 col-md-10">        
                                        {{ Form::text('contacto',null,['class'=>'form-control']) }}
                                    </div> 
                                    <div class="form-comtrol col-xs-12 col-md-1">
                                        {{ Form::label('email','Email') }}
                                    </div>
                                    <div class="form-comtrol col-xs-12 col-md-10">        
                                        {{ Form::text('email',null,['class'=>'form-control']) }}
                                    </div> 
                                    <div class="form-comtrol col-xs-12 col-md-1">
                                        {{ Form::label('telefono','Telefono') }}
                                    </div>
                                    <div class="form-comtrol col-xs-12 col-md-5">        
                                        {{ Form::text('telefono',null,['class'=>'form-control']) }}
                                    </div> 
                                    
                                    <div class="form-comtrol col-xs-12 col-md-8 mt-2">
                                        {{ Form::submit('Guardar Registro',['class'=>'btn  btn-primary']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                


                    </div>