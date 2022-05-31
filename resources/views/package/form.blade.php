<div class="box box-info padding-1">
    <div class="box-body ">
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $package->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $package->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {!! Form::label('Costo') !!}
            {!! Form::number('precio', $package->precio, ['class' => 'form-control', 'step' => '0.01' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'precio']) !!}
        </div> 
        <div class="form-group">
            <br>
            <strong>Estado</strong>
            <br>
            {!! Form::label('Activo') !!}
            {!! Form::radio('status',1) !!}
            {!! Form::label('Inactivo') !!}
            {!! Form::radio('status',0,true) !!}
            <br>
        </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn mt-2 btn-primary">Guardar</button>
    </div>
</div>