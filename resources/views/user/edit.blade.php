@extends('layouts.app')

@section('template_title')
    Actualizar usuario
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">


                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Usuario</span>
                    </div>
                    <div class="card-body">
                        {!! Form::model($user,['route'=>['user.update',$user],'autocomplete' => 'off','files' => true, 'method' => 'patch']) !!}
                        <div class="box box-info padding-1">
                            <div class="box-body ">
                                <div class="card-body">
                                    
                        
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                        
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus disabled>
                        
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                        
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" disabled>
                        
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                        
                                        <div class="row mb-3">
                                            <label for="rol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>
                        
                                            <div class="col-md-6">
                                               <!-- <input id="rol" type="text" class="form-control @error('rol') is-invalid @enderror" name="rol" value="{{ $user->rol }}" required autocomplete="rol"> -->
                                                <select name="role_id" id="role_id" class="form-control" disabled>
                                                        <option value="">{{$user->role->role}}</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role['id'] }}">{{ $role['role'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('rol')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                        
                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                        
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                        
                                        <div class="row mb-3">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                        
                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>
                        
                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Guardar') }}
                                                </button>
                                            </div>
                                        </div>

                                        
                <div class="float-right">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm float-right"  data-placement="left">
                      {{ __('Cancelar') }}
                    </a>
                  </div>
                                        
                                    </form>
                                </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection