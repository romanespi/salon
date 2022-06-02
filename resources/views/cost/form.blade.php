<div class="box box-info padding-1">
    <div class="box-body ">
        <div class="form-group">
            {!! Form::label('Cantidad') !!}
            {!! Form::number('cantidad', $cost->cantidad, ['class' => 'form-control', 'step' => '0.01' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => 'cantidad']) !!}
        </div>
        <div class="form-group">
            {{ Form::label('Evento') }}
            {{ Form::select('event_id',$events, $cost->event_id, ['class' => 'form-control' . ($errors->has('event_id') ? ' is-invalid' : ''), 'placeholder' => 'event']) }}
            {!! $errors->first('event_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn mt-2 btn-primary">Guardar</button>
    </div>
</div>