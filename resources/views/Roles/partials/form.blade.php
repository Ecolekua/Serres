

<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('name','Nombre Usuario') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('name',null,['class'=>'form-control','readonly']) }}
</div>    
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('correo','Correo') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('email',null,['class'=>"form-control @ $errors->has('email') ? ' is-invalid' : '' ",'type'=>'email','readonly','type'=>'email']) }}
</div>  
<h3 class="mt-2 mb-2 ml-4">Lista de Roles</h3>
<ul>
    @foreach($roles as $role)
    <li>
        <label>
            {{ Form::checkbox('roles[]',$role->id,null) }}
            {{ $role->name }},
            <em>{{ $role->description }}</em>
        </label>
    </li>
    @endforeach
<br/>
<br/>
@can('roles.crud')
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::submit('Asignar Role',['class'=>'btn btn-sm btn-primary']) }}
</div>
@endcan