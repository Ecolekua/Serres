<div class="row">
    <div class="col-xs-12 col-md-12 mt-2">
        <h3>Las Etiquetas o Tags pueden ser ingresadas solas o masivamente separadas por una(,), además de ser asignadas a un Grupo</h3>
    </div>
    <div class="form-comtrol col-xs-12 col-md-6">
        {{ Form::label('nombre','Tags') }}
    </div>
    <div class="form-comtrol col-xs-12 col-md-12">        
        {{ Form::text('name',null,['class'=>'form-control','required','data-role'=>'tagsinput']) }}
    </div>    
    <div class="form-comtrol col-xs-12 col-md-12">
        {{ Form::label('description','Descripción de la Etiqueta(s)') }}
    </div>
    <div class="form-comtrol col-xs-12 col-md-10">        
        {{ Form::text('description',null,['class'=>'form-control','required']) }}
    </div>
    <div class="form-comtrol col-xs-12 col-md-3 mt-2">
        {{ Form::label('tag_group_id_','Nombre del grupo de Tags, (Opcional)') }}
    </div>
    <div class="form-comtrol col-xs-12 col-md-9 mt-2">        
        <!-- {{ Form::select('tag_group_id', $groups->pluck('slug', 'slug')->all(), null, ['class' => 'form-control']) }} -->
        <!-- @foreach($groups as $group)
            {{ Form::checkbox('grupos[]','$group->slug',['class'=>'form-control'])}}
        @endforeach -->
        @foreach($groups as $group)
            <label>{{$group->name}}   
            <input type="checkbox" name="tag_group_id[]" class="form-control" value="{{$group->slug}}"></label>
        @endforeach
    </div> 


    <br/>
    <br/>
    <div class="form-comtrol col-xs-12 col-md-8">
        {{ Form::submit('Guardar Tags',['class'=>'btn  btn-primary']) }}
    </div>
</div>
