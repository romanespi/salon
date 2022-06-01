@extends('layouts.app')

@section('template_title')
    Mostrar evento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar evento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary my-2" href="{{ route('event.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $event->nombre }}
                        </div>

                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $event->descripcion }}
                        </div>

                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $event->status ? 'Activo' : 'Inactivo' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
