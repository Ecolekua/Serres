<div class="row">
<div class="col-xs-12 col-md-12 mt-2">
<h3>Datos del la Empresa</h3>
</div>
@foreach($empresa as $empresa)
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('rut','Rut')}}
</div>
<div class="form-comtrol col-xs-12 col-md-2">    
    <input type="text" value="{{$empresa->rut}}" class="form-control" readonly>
</div>
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('nombre','Razón') }}
</div>
<div class="form-comtrol col-xs-12 col-md-8">        
<input type="text" value="{{$empresa->nombre}}" class="form-control" readonly>
</div>    
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('direccion','Dirección') }}
</div>
<div class="form-comtrol col-xs-12 col-md-5">        
<input type="text" value="{{$empresa->direccion}}" class="form-control" readonly>
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('comuna','Comuna') }}
</div>
<div class="form-comtrol col-xs-12 col-md-5">        
<input type="text" value="{{$empresa->comuna}}" class="form-control" readonly>
</div>  
<!--  -->
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('correo','Correo') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
<input type="text" value="{{$empresa->email}}" class="form-control" readonly>
</div>  
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('telefonos','Telefonos') }}
</div>
<div class="form-comtrol col-xs-12 col-md-4">        
<input type="text" value="{{$empresa->telefonos}}" class="form-control" readonly>
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('giro','Giro') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
<input type="text" value="{{$empresa->giro}}" class="form-control" readonly>
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('tipoEmpresa','Tipo Empresa') }}
</div>
<div class="form-comtrol col-xs-12 col-md-4">        
<input type="text" value="{{$empresa->tipoEmpresa}}" class="form-control" readonly>
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('mutualidad','Mutualidad') }}
</div>
<div class="form-comtrol col-xs-12 col-md-2">        
<input type="text" value="{{$empresa->mutualidad}}" class="form-control" readonly>
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
    
    <input type="text" value="{{$empresa->rutRepLeg}}" class="form-control" readonly>
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('nomRepLeg','Nombre') }}
</div>
<div class="form-comtrol col-xs-12 col-md-8">        
    
    <input type="text" value="{{$empresa->nomRepLeg}}" class="form-control" readonly>
</div> 
<div class="col-xs-12 col-md-12 mt-2">
<h3>Datos del Contacto</h3>
</div>

<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('nomContacto','Nombre') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    
    <input type="text" value="{{$empresa->nomContacto}}" class="form-control" readonly>
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('fonContacto','Telefonos') }}
</div>
<div class="form-comtrol col-xs-12 col-md-4">        
    
    <input type="text" value="{{$empresa->fonContacto}}" class="form-control" readonly>
</div> 
<div class="form-comtrol col-xs-12 col-md-1">
    {{ Form::label('emailContacto','Email') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
  
    <input type="text" value="{{$empresa->emailContacto}}" class="form-control" readonly>
</div> 


<br/>
<br/>
@endforeach
</div>
