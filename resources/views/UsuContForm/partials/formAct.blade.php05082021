<table class="table">
  <thead class="thead-dark">
    
  </thead>
  <tbody>
    <tr>
      
        
        <th>                                          
            {{ Form::text('id',null,['class'=>'form-control','readonly','size'=>'1']) }}  
        </th>
        <!-- <th>                                          
            {{ Form::text('estructura->empresa->nombre',null,['class'=>'form-control','readonly']) }}  
        </th> -->
        <th> 
        {!! Form::select('formulario',['1' => 'Certificación','2'=>'Certificación de Documentos'],null, ['class'=>'form-control']) !!}
        </th>
        <th> 
            {!! Form::select('activo',['1' => 'Activado','0'=>'Desactivado'],null, ['class'=>'form-control']) !!}
        </th>
        <th>                                          
            {{ Form::number('periodoInicio',null,['class'=>'form-control','min'=>'1']) }}  
        </th>
        <th>                                          
            {{ Form::number('periodoFin',null,['class'=>'form-control','min'=>'1']) }}  
        </th>
        
        <th> 
            {{ Form::submit('Actualizar',['class'=>'btn  btn-primary']) }}
        </th>
    </tr>
    
  </tbody>
</table>