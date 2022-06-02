@extends('layouts.app')

@section('template_title')
    Actualizar costo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar costo</span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($cost,['route'=>['cost.update',$cost],'autocomplete' => 'off','files' => true, 'method' => 'patch']) !!}
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('cost.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection