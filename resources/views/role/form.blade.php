<div class="box box-info padding-1">
    <div class="box-body ">
        <div class="form-group">
            {{ Form::label('role') }}
            {{ Form::text('role', $role->role, ['class' => 'form-control' . ($errors->has('role') ? ' is-invalid' : '')]) }}
            {!! $errors->first('role', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn mt-2 btn-primary">Guardar</button>
    </div>
</div>