
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('name','Nombre Perfil') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('name',null,['class'=>'form-control','required']) }}
</div>    
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('slug','URL (Una sola Palabra para describir el perfil') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::text('slug',null,['class'=>'form-control','required']) }}
</div>  
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::label('description','Descripción del Perfil') }}
</div>
<div class="form-comtrol col-xs-12 col-md-6">        
    {{ Form::textarea('description',null,['class'=>'form-control','required']) }}
</div>  
<hr>
<h3> Permiso Especial</h3>
<div class="form-group">
    <label>{{ Form::radio('special','all-access')}} Acceso Total</label>
    <label>{{ Form::radio('special','no-access')}} Acceso Prohibido</label>
</div>
</hr>

<h3>Lista de Roles</h3>
<table class="table" id="tablaProyectos">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col">Seleccionar</th>
                                                        <th scope="col">Perfil</th>
                                                        <th scope="col">Detalle</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($permissions as $permission)
                                                    <tr>
                                                        <th scope="row">{{ Form::checkbox('permissions[]',$permission->id,null) }}</th>
                                                        <td>{{ $permission->name }}</td>
                                                        <td>{{ $permission->description }}</td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>


<!--    
    <li>
        <label>
            {{ Form::checkbox('permissions[]',$permission->id,null) }}
            {{ $permission->name }},
            <em>{{ $permission->description }}</em>
        </label>
    </li> -->
  
<br/>
<br/>
@can('rolesprofiles.crud')
<div class="form-comtrol col-xs-12 col-md-3">
    {{ Form::submit('Guardar Perfil con sus Rol',['class'=>'btn btn-sm btn-primary']) }}
</div>
@endcan