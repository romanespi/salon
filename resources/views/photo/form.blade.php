<div class="box box-info padding-1">
    <div class="box-body ">
        <div class="form-group">
            <div class="row">
                Imagenes tomadas
            </div>
            <div class="row">
                {!! Form::label('file','Agregar fotos') !!}
                {!! Form::file('file', ['class' => 'form-control-file']) !!}
            </div>
        </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn mt-2 btn-primary">Guardar</button>
    </div>
</div>