@extends('layouts.app')

@section('template_title')
    Actualizar Regimen Fiscal
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Regimen Fiscal</span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($package,['route'=>['package.update',$package],'autocomplete' => 'off','files' => true, 'method' => 'patch']) !!}
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('package.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection