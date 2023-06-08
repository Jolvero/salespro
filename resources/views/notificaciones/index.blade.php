@extends('layouts.app')

@section('content')
<div class="content ml-5 ml-md-0">
    <h2 class="font-weight-bold bg-white p-3">{{ __('Notificaciones')}}</h2>

    @forelse ($notificaciones as $notificacion)
    <div class="p-3 border mt-3 border-0 shadow" style="border-radius: 2rem;">
        @if ($notificacion->data['redireccion'] == 'Cliente')
        <p>Nuevo Cliente agregado</p>
        <img src="{{'/images/show-prospecto-user.png'}}" alt="" width="64px;" class="img-fluid"><p class="font-weight-bold my-0">Empresa: <span class="font-weight-normal">{{$notificacion->data['empresa']}}</span></p>
            <a href="{{route('cliente.show', ['cliente' => $notificacion->data['id']])}}" class="btn btn-primary mb-2 mx-2 mt-2 font-weight-bold">Ver</a>
        @else
        <p class="mt-3">Actualización Prospecto</p>
        <img src="{{'/images/show-prospecto-user.png'}}" alt="" width="64px;" class="img-fluid"><p class="font-weight-bold my-0">Empresa: <span class="font-weight-normal">{{$notificacion->data['empresa']}}</span></p> <a href="{{route('prospecto.show', ['prospecto' => $notificacion->data['id_prospecto']])}}" class="btn btn-primary mb-2 mx-2 mt-2 font-weight-bold">Ver</a>
        @endforelse
        <div>

        <p class="my-0"><span class="font-weight-bold">{{$notificacion->created_at->diffForHumans()}}</span></p>
    </div>
    <div class="">

    </div>
    </div>
    @empty
        <p class="text-center">No hay notificaciones nuevas</p>
    @endforelse
</div>
@endsection
