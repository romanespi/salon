@extends('layouts.app')

@section('template_title')
    Eventos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Eventos') }}
                            </span>

                             <div class="float-right">
                                @if (auth()->user()->role_id == 2)
                                    <a href="{{ route('event.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                        {{ __('Crear nuevo') }}
                                    </a>
                                @endif

                              </div>
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
                                        <th>Descripcion</th>
                                        <th>Fecha y Hora</th>
                                        <th>Usuario</th>
                                        <th>Precio</th>
                                        <th>Estado</th>
                                        <th>Autorizado</th>
                                        <th>Paquete</th>
                                        <th>Etapa</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{$event->id}}</td>
											<td>{{$event->nombre }}</td>
                                            <td>{{$event->descripcion }}</td>
                                            <td>{{$event->fecha}} {{$event->hora}}</td>
                                            <td>{{$event->user->name}}</td>
                                            <td>{{$event->precio}}</td>
                                            <td>{{$event->status ? 'Confirmado' : 'Sin confirmar' }}</td>
                                            <td>{{$event->autorizado}}</td>
                                            <td>{{$event->package->nombre}}</td>   
                                            <td>
                                                @switch($event->etapa)
                                                    @case(1)
                                                        Pendiente
                                                        @break
                                                    @case(2)
                                                        En ejecucion
                                                        @break
                                                    @case(3)
                                                        Concluido
                                                        @break
                                                    @default
                                                    -
                                                @endswitch
                                            </td>
                                            <td>
                                                <form action="{{ route('event.destroy',$event->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('event.show',$event->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('event.edit',$event->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    {{csrf_field()}}
                                                    @method('DELETE')
                                                    @if (auth()->user()->role_id == 2)
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>    
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               {{--$events->links()--}}
            </div>
        </div>
    </div>
@endsection
