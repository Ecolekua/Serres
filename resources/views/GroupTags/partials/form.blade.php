<div class="row">
    <div class="col-xs-12 col-md-12 mt-2">
        <h3>Los nombre de grupos deben ser únicos por cada concepto</h3>
    </div>
    <div class="form-comtrol col-xs-12 col-md-6">
        {{ Form::label('nombre','Grupo') }}
    </div>
    <div class="form-comtrol col-xs-12 col-md-12">        
        {{ Form::text('name',null,['class'=>'form-control','required','data-role'=>'tagsinput']) }}
    </div>    
    


    <br/>
    <br/>
    <div class="form-comtrol col-xs-12 col-md-8">
        {{ Form::submit('Guardar Nombre Grupo',['class'=>'btn  btn-primary']) }}
    </div>
</div>
