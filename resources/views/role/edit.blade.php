@extends('layouts.app')

@section('template_title')
    Actualizar rol
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Rol</span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($role,['route'=>['role.update',$role],'autocomplete' => 'off','files' => true, 'method' => 'patch']) !!}
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('role.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection