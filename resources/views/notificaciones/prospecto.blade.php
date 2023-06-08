@extends('layouts.app')

@section('content')

<div class="content ml-5 ml-md-0">
    <h2 class="font-weight-bold bg-white p-3">{{ __('Notificaciones')}}</h2>

    @forelse ($notificaciones as $notificacion)
    <div class="p-3 border mt-3">
        <p class="my-0"><img src="{{'/images/show-prospecto-user.png'}}" alt=""> Se agregó un prospecto <span class="font-weight-bold">{{$notificacion->data['nombre']}}</span></p>
        <p class="my-0">Empresa <span class="font-weight-bold">{{$notificacion->data['empresa']}}</span></p>
        <div>

        <p class="my-0"><span class="font-weight-bold">{{$notificacion->created_at->diffForHumans()}}</span></p>
    </div>
    <div>
        <a href="{{route('prospecto.show', ['prospecto'=> $notificacion->data['id_prospecto']])}}" class="btn btn-dark text-uppercase font-weight-bold rounded-lg mt-3">Ver</a>
    </div>
    </div>
    @empty
        <p class="text-center">No hay notificaciones nuevas</p>
    @endforelse
</div>

@endsection
