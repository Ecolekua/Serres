<div class="row">
    
    <div class="col-xs-12 col-md-2 mt-3">  
        {!! Form::select('estado',['Asignada' => 'Selecione Estado','Rechazada'=>'Observar'],null, ['class'=>'form-control']) !!}
    </div>
    
    <div class="col-xs-12 col-md-6 mt-3">  
        {{ Form::textarea('observaciones',null,['class'=>'form-control','rows'=>4]) }}
    </div>
    @if ($datos->identificacion=="Declaracion" || $datos->ano==NULL)
    <div class="col-xs-12 col-md-0 ml-3 mt-3">  
        <label>Marcar Para enviar a Firma</label>      
        {{ Form::checkbox('certificado', '10') }}
    </div>
    @else
     <div class="col-xs-12 col-md-0 ml-3 mt-3">        
        {{ Form::text('certificado',null,['class'=>'form-control']) }}
    </div>
    @endif
    <div class="form-comtrol col-xs-4 col-md-1 mt-3">
        {{ Form::submit('Procesar Solicitud',['class'=>'btn btn-primary']) }}
    </div>
</div>

