@extends('layouts.app')

@section('content')

<div class="row justify-content-center ml-5 ml-md-0" >

    <div class="col-md-6" data-aos="flip-right" data-aos-duration="1000">
        <div class="card card-body border-0 shadow" style="border-radius: 2rem;">
            <img src="{{ '/images/prospecto.show.png' }}" class="d-block mx-auto mt-3" alt="">
            <h2 class="text-center mt-2">{{ $cliente->nombre }}</h2>
        </div>

    </div>

    <div class="col-md-6 mt-5 mt-md-0" data-aos="flip-left" data-aos-duration="1000">
        <div class="card card-body border-0 shadow" style="border-radius: 2rem;">
            <p> <img src="{{'/images/cartera.png'}}" class="mr-2" alt=""> Prospectado por: <span class="font-weight-bold">{{$cliente->usuario->name}}</span></p>
            <div class="info mt-3">
                <p class="font-weight-bold"><img src="{{'/images/nombre.png'}}" class="mr-2" alt=""> Nombre: <span class="font-weight-normal">{{$cliente->nombre}}</span></p>
                <p class="font-weight-bold mt-4"><img src="{{'/images/empresa.png'}}" class="mr-2" alt=""> Empresa: <span class="font-weight-normal">{{$cliente->empresa}}</span></p>

                @if ($cliente->rfc)
                <p class="font-weight-bold mt-4"><img src="{{'/images/seguimiento.png'}}" class="mr-2" alt=""> RFC: <span class="font-weight-normal">{{$cliente->rfc}}</span></p>

                @endif

                @if ($cliente->direccion)
                <p class="font-weight-bold mt-4"><img src="{{'/images/direccion.png'}}" class="mr-2" alt=""> Dirección: <span class="font-weight-normal">{{$cliente->direccion}}</span></p>

                @endif

                @if ($tarifa)
                <p class="font-weight-bold mt-4"><img src="{{'/images/tarifa.png'}}" class="mr-2" alt=""> Tarifa: <span class="font-weight-normal">{{$tarifa}}</span></p>

                @endif
                @if ($cliente->observaciones)
                <p class="font-weight-bold mt-4"><img src="{{'/images/comentario.png'}}" class="mr-2" alt=""> Observaciones: <span class="font-weight-normal">{{$cliente->observaciones}}</span></p>
                @endif

            </div>
        </div>


    </div>

</div>
@endsection
