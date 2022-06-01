@extends('layouts.app')

@section('template_title')
    Actualizar evento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar evento</span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($event,['route'=>['event.update',$event],'autocomplete' => 'off','files' => true, 'method' => 'patch']) !!}
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('event.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection