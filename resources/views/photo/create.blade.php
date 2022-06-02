@extends('layouts.app')

@section('template_title')
    Crear rol
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
                        <span class="card-title">Crear Rol</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('role.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            @include('role.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection