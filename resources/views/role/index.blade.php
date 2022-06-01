@extends('layouts.app')

@section('template_title')
    Roles
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Roles') }}
                            </span>
                            {{--  
                             <div class="float-right">
                                <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo') }}
                                </a>
                              </div>--}}
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
										<th>Nombre</th>
                                        <th>Creado</th>
                                        <th>Actualizado</th>
                                        {{--<th>Acciones</th>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $rola)
                                        <tr>
                                            <td>{{$rola->id}}</td>
											<td>{{$rola->role }}</td>
                                            <td>{{$rola->created_at}}</td>
                                            <td>{{$rola->updated_at}}</td>

                                         {{-- <td>
                                                <form action="{{ route('role.destroy',$rola->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('role.show',$rola->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('role.edit',$rola->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    {{csrf_field()}}
                                                    @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>    
                                                    
                                                </form>
                                            </td>   --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
