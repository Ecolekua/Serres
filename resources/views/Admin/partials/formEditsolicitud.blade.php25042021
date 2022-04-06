<div class="row">
    <!-- <div class="col-xs-12 col-md-0 ml-3">        
        {{ Form::hidden('id',null,['class'=>'form-control']) }}
    </div>     -->
    <div class="col-xs-12 col-md-4 mt-3">        
        {{ Form::select('inspector_id', $inspectores->pluck('name', 'id')->all(), null, ['class' => 'form-control','placeholder' => 'Seleccione Inspector']) }}
    </div>
    <div class="col-xs-12 col-md-4 mt-3">  
        <h3>
        {!! Form::select('estado',['Asignada' => 'Selecione Estado','Rechazada'=>'Observada'],null, ['class'=>'form-control']) !!}
        </h3>
    </div>
    
    <div class="col-xs-12 col-md-3 mt-3">  
        {{ Form::textarea('observaciones',null,['class'=>'form-control','rows'=>1]) }}
    </div>
    <div class="form-comtrol col-xs-4 col-md-1 mt-3">
        {{ Form::submit('Procesar Solicitud',['class'=>'btn btn-primary']) }}
    </div>
</div>