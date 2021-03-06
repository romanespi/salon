@extends('layouts.app')

@section('template_title')
    Crear evento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear evento</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('event.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body ">
                                    <div class="form-group">
                                        {{ Form::label('nombre') }}
                                        {{ Form::text('nombre', $event->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('descripcion') }}
                                        {{ Form::text('descripcion', $event->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'descripcion']) }}
                                        {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('fecha') }}
                                        {{ Form::date('fecha', $event->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'fecha']) }}
                                        {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('hora') }}
                                        {{ Form::time('hora', $event->hora, ['class' => 'form-control' . ($errors->has('hora') ? ' is-invalid' : ''), 'placeholder' => 'hora']) }}
                                        {!! $errors->first('hora', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    
                                    <div class="form-group">
                                        {{ Form::label('Paquete') }}
                                        {{ Form::select('package_id',$packages, $event->package_id, ['class' => 'form-control' . ($errors->has('package') ? ' is-invalid' : ''), 'placeholder' => 'package']) }}
                                        {!! $errors->first('package', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    @if(auth()->user()->role_id == 1)
                                        <div class="form-group">
                                            {!! Form::label('Costo') !!}
                                            {!! Form::number('precio', $event->precio, ['class' => 'form-control', 'step' => '0.01' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'precio']) !!}
                                        </div>
                                        <div class="form-group">
                                            <br>
                                            <strong>Estado</strong>
                                            <br>
                                            {!! Form::label('Confirmado') !!}
                                            {!! Form::radio('status',1) !!}
                                            {!! Form::label('Sin confirmar') !!}
                                            {!! Form::radio('status',0,true) !!}
                                            <br>
                                        </div>
                                        <div class="form-group">
                                            <br>
                                            <strong>Etapa</strong>
                                            <br>
                                            {!! Form::label('Pendiente') !!}
                                            {!! Form::radio('etapa',1,true) !!}
                                            {!! Form::label('En ejecucion') !!}
                                            {!! Form::radio('etapa',2) !!}
                                            {!! Form::label('Concluido') !!}
                                            {!! Form::radio('etapa',3) !!}
                                            <br>
                                        </div>
                                    @endif
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn mt-2 btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection