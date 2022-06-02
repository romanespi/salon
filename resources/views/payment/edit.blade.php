@extends('layouts.app')

@section('template_title')
    Actualizar pagp
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar pago</span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($payment,['route'=>['payment.update',$payment],'autocomplete' => 'off','files' => true, 'method' => 'patch']) !!}
                            {{ method_field('PATCH') }}
                            @csrf
                            @include('payment.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection