<table class="table">
  <thead class="thead-dark">
    
  </thead>
  <tbody>
    <tr>
      
        
        <th>                                          
            {{ Form::text('id',null,['class'=>'form-control','readonly']) }}  
        </th>
        <th> 
            {{ Form::text('proyecto',null,['class'=>'form-control']) }}
        </th>
        <th> 
            {!! Form::select('activo',['1' => 'Activado','0'=>'Desactivado'],null, ['class'=>'form-control']) !!}
        </th>
        <th> 
            {{ Form::date('fechaInicio',null,['class'=>'form-control']) }}
        </th>
        <th> 
            {{ Form::text('direccion',null,['class'=>'form-control']) }}
        </th>
        <th> 
            {{ Form::submit('Actualizar',['class'=>'btn  btn-primary']) }}
        </th>
    </tr>
    
  </tbody>
</table>
                              