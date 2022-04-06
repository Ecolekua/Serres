<div class="row">
    
    <div class="col-xs-12 col-md-2 mt-3">  
        {!! Form::select('estado',['Asignada' => 'Selecione Estado','Rechazada'=>'Observar'],null, ['class'=>'form-control']) !!}
    </div>
    
    <div class="col-xs-12 col-md-6 mt-3">  
        {{ Form::textarea('observaciones',null,['class'=>'form-control','rows'=>4]) }}
    </div>
     <div class="col-xs-12 col-md-0 ml-3 mt-3">        
        {{ Form::number('certificado',null,['class'=>'form-control']) }}
    </div>
    <div class="form-comtrol col-xs-4 col-md-1 mt-3">
        {{ Form::submit('Procesar Solicitud',['class'=>'btn btn-primary']) }}
    </div>
</div>

