@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ '/images/recordatorio-index.png' }}" alt="">
                <h1>{{ $recordatorio->asunto }}</h1>
            </div>
            <div class="col-md-6 card card-body">
                @php
                    $fecha = $recordatorio->fecha;
                @endphp
                <p><img src="{{ '/images/estatus.png' }}" alt=""> Fecha: <formatear-fecha class="text-dark" fecha="{{ $fecha}}"></formatear-fecha>
                </p>
                <p><img src="{{ '/images/show-prospecto-user.png' }}" alt=""> Prospecto: <span
                        class="font-weight-bold">{{ $recordatorio->Prospecto->nombre }}</span></p>
            </div>
        </div>
    </div>
@endsection
