@extends('layouts.app')

@section('template_title')
    Crear usuario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                

                @includeif('partials.errors')
                @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear usuario</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}"  user="form" enctype="multipart/form-data">
                            @csrf
                            @include('user.form')
                            <div class="float-right">
                                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm float-right"  data-placement="left">
                                  {{ __('cancelar') }}
                                </a>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection