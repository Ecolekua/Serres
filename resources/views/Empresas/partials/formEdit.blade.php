<div class="row">
<div class="col-xs-12 col-md-12 mt-2">
<h3>Datos del la Empresa Campos Obligatorios(*)</h3>
</div>
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('rut','Rut')}}
</div>
<div class="form-comtrol col-xs-12 col-md-2">    
    {{ Form::text('rut',null,['class'=>'form-control','required','id'=>'rut','placeholder'=>'(*)']) }}
</div>
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('nombre','Razón') }}
</div>
<div class="form-comtrol col-xs-12 col-md-8">        
    {{ Form::text('nombre',null,['class'=>'form-control','required','placeholder'=>'(*)']) }}
</div>    
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('direccion','Dirección') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('direccion',null,['class'=>'form-control','required','placeholder'=>'(*)']) }}
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('comuna','Comuna') }}
</div>
<div class="form-comtrol col-xs-12 col-md-4 mb-2">        
    <!-- {{ Form::select('comuna', $comunas->pluck('comuna', 'comuna')->all(), null, ['class' => 'form-control']) }} -->
    <!-- @foreach($comunas as $comuna)
        {!! Form::select('comuna', $comuna, null, ['class' => 'form-controller']) !!}
    @endforeach -->
    <!-- {!! Form::select('comuna', $comu, null,['class' => 'form-control']) !!} -->
    
    <!-- {!! Form::select('comuna', $comu,$empresa->comuna,['placeholder' => 'Seleccione Comuna','required','class'=>'form-control']) !!} -->
<select name="comuna" class="form-control">
        <option value="<?php echo $empresa->comuna ?>"> <?php echo $empresa->comuna ?> </option>
        @foreach($comunas as $comuna)
            <option value="{{ $comuna->comuna }} "> {{ $comuna->comuna }} </option>
        @endforeach
    </select>
                                      
</div>  
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('correo','Correo') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('email',null,['class'=>"form-control @ $errors->has('email') ? ' is-invalid' : '' ",'type'=>'email','required','type'=>'email','placeholder'=>'(*)']) }}
</div>  
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('telefonos','Telefonos') }}
</div>
<div class="form-comtrol col-xs-12 col-md-4">        
    {{ Form::text('telefonos',null,['class'=>'form-control','required','placeholder'=>'(*)']) }}
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('giro','Giro') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('giro',null,['class'=>'form-control']) }}
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('tipoEmpresa','Tipo Empresa') }}
</div>
<div class="form-comtrol col-xs-12 col-md-4">        
    <!-- {{ Form::text('tipoEmpresa',null,['class'=>'form-control','required']) }} -->
    {!! Form::select('tipoEmpresa',['Empresa Principal' => 'Empresa Principal','Contratista'=>'Contratista','Mixto'=>'Mixto'],null, ['class'=>'form-control','placeholder'=>'Seleccione Tipo Empresa (*)','required']) !!}
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('mutualidad','Mandante (Alias)') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('mutualidad',null,['class'=>'form-control']) }}
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('djuradas','Permite Declaraciones Juradas') }}
</div>
<div class="form-comtrol col-xs-12 col-md-4">        
{!! Form::select('djuradas',[1 => 'Permitir sin Movimiento',0=>'No Permitir sin Movimiento'],null, ['class'=>'form-control','placeholder'=>'Seleccione Permiso sobre Declaraciones Juradas']) !!}

</div>
<!-- <div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('especialidad','Especialidad') }}
</div>
<div class="form-comtrol col-xs-12 col-md-8">        
    {{ Form::text('especialidad',null,['class'=>'form-control','required']) }}
</div>  -->
<div class="col-xs-12 col-md-12 mt-2">
<h3>Datos del Representante Legal</h3>
</div>
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('rutRepLeg','Rut') }}
</div>
<div class="form-comtrol col-xs-12 col-md-2">        
    {{ Form::text('rutRepLeg',null,['class'=>'form-control','id'=>'rutRep']) }}
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('nomRepLeg','Nombre') }}
</div>
<div class="form-comtrol col-xs-12 col-md-8">        
    {{ Form::text('nomRepLeg',null,['class'=>'form-control']) }}
</div> 
<div class="col-xs-12 col-md-12 mt-2">
<h3>Datos del Contacto</h3>
</div>

<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('nomContacto','Nombre') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('nomContacto',null,['class'=>'form-control','required','placeholder'=>'(*)']) }}
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('fonContacto','Telefonos') }}
</div>
<div class="form-comtrol col-xs-12 col-md-4">        
    {{ Form::text('fonContacto',null,['class'=>'form-control','required','placeholder'=>'(*)']) }}
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('emailContacto','Email') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('emailContacto',null,['class'=>'form-control','required','placeholder'=>'(*)']) }}
</div> 


<br/>
<br/>
<div class="form-comtrol col-xs-12 col-md-8">
    {{ Form::submit('Guardar Registro',['class'=>'btn  btn-primary']) }}
</div>
</div>
