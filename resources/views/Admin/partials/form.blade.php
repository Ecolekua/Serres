

<!-- <div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('rut','Rut')}}
</div>     -->
<!-- <div class="form-comtrol col-xs-12 col-md-3">    
    {{ Form::text('rut',null,['class'=>'form-control','required']) }}
</div> -->
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('name','Nombre Usuario') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('name',null,['class'=>'form-control','required']) }}
</div>    
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('direccion','Dirección') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('direccion',null,['class'=>'form-control','required']) }}
</div>  

<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('correo','Correo') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('email',null,['class'=>"form-control @ $errors->has('email') ? ' is-invalid' : '' ",'type'=>'email','required','type'=>'email']) }}
</div>  
<!-- <div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('Tipo','Tipo Usuario') }}
</div>
<div class="form-comtrol col-xs-12 col-md-3">        
    {{ Form::text('Tipo',null,['class'=>'form-control','required']) }}
     {!! Form::select('country', [null => 'Selecccione Tipo de Usuario'] + ['Admin' => 'Admininistrador','cliente'=>'Cliente'], null, ['class' => 'form-control']) !!}
</div>    -->
<!-- <div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('password','Password') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('password',null,['class'=>'form-control','required','id'=>'pass']) }}
</div> 

<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('confirm','Confirmar Password') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('confirm',null,['class'=>'form-control','required']) }}
</div>  -->
<br/>
<br/>
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::submit('Guardar Registro',['class'=>'btn btn-sm btn-primary']) }}
</div>
