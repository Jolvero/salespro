@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/recordatorios.js')}}" defer></script>
@endsection
@section('content')
    <div class="row ml-5 ml-md-0 mb-3">
        <div class="col-md-6 my-3">
            <h1> Editar Recordatorios</h1>
            <img src="{{ '/images/recordatorio-index.png' }}" alt="">
        </div>
    </div>
    <form action="{{ route('recordatorio.update', ['recordatorio' => $recordatorio->id]) }}" method="POST" name="formulario-recordatorio" id="formulario-recordatorio">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div class="form-group">
                    <img src="{{ '/images/editar.png' }}" class="mr-1 mb-3"alt="">
                    <label for="asunto">Asunto</label>
                    <input type="text" name="asunto" id="asunto"
                        class="form-control @error('asunto') is-invalid @enderror" value="{{ $recordatorio->asunto }}">
                    @error('asunto')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <img src="{{ '/images/fecha.png' }}" class="mr-1 mb-3" alt="">
                <label for="fecha">Fecha Evento</label>
                <input type="datetime-local" name="fecha" id="fecha"
                    value="{{ $recordatorio->fecha }}"class="form-control @error('fecha') is-invalid @enderror">
                @error('fecha')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <img src="{{ '/images/show-prospecto-user.png' }}" class="mr-1 mb-3" alt="">
                <label for="prospecto">Prospecto</label>
                <select name="prospecto_id" id="prospecto_id"
                    class="form-control @error('prospecto_id') is-invalid @enderror">
                    <option value="">-- Seleccione --</option>
                    @foreach ($prospectos as $prospecto)
                        <option
                            value="{{ $prospecto->id }}"{{ $recordatorio->prospecto_id == $prospecto->id ? 'selected' : '' }}>
                            {{ $prospecto->nombre }}</option>
                    @endforeach

                </select>
                @error('prospecto_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="col-md-6 mt-3">
                <div class="form-group">
                    <img src="{{ '/images/fecha.png' }}" alt="" class="mr-1 mb-3">
                    <label for="fecha_recordatorio">Fecha Recordatorio</label>
                    <input type="date" name="fecha_recordatorio" id="fecha_recordatorio"
                        value="{{ $recordatorio->fecha_recordatorio }}" class="form-control">
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-dark mt-3 mr-3"><img src="{{ '/images/agregar-archivo.png' }}"
                        width="40px" alt=""> Actualizar</button>
            </div>
    </form>
    </div>
@endsection
