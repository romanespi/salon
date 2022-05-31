@extends('layouts.app')

@section('template_title')
    {{ $package->nombre ?? 'Regimen Fiscal' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Regimen Fiscal{{$package->clave}}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary my-2" href="{{ route('package.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $package->nombre }}
                        </div>

                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $package->descripcion }}
                        </div>

                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $package->status ? 'Activo' : 'Inactivo' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
