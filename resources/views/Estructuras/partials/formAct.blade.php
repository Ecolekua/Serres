<table class="table">
  <thead class="thead-dark">
    
  </thead>
  <tbody>
    <tr>
      
            
        <th>                                          
            {{ Form::text('id',null,['class'=>'form-control','readonly','size' => 1]) }}  
        </th>
        
        <th> 
        
        {{ Form::select('proyecto_id', $proyectos->pluck('proyecto', 'id')->all(), null, ['class' => 'form-control']) }}
        </th>
        <th> 
        {{ Form::select('empresa_id', $empresas->pluck('nombre', 'id')->all(), null, ['class' => 'form-control']) }}
        </th>
        <th>                                          
            {{ Form::text('contrato',null,['class'=>'form-control' ]) }}  
        </th>
        <th> 
            {{ Form::date('fechaInicio',null,['class'=>'form-control']) }}
        </th>
        <th> 
        {!! Form::select('activo',['1' => 'Activado','0'=>'Desactivado'],null, ['class'=>'form-control']) !!}
        </th>
        <th> 
            {{ Form::submit('Actualizar',['class'=>'btn  btn-primary']) }}
        </th>
    </tr>
    
  </tbody>
</table>