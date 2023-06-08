@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/recordatorios-table.js')}}" defer></script>
<script src="{{asset('js/alertas.js')}}" defer></script>
<script src="{{asset('js/recordatorios.js')}}" defer></script>
@endsection
@section('content')
@if (session('estado'))
    <div class="alert alert-success text-center" role="alert">
        {{session('estado')}}
    </div>
@endif
<div class="row ml-5 ml-md-0">
    <div class="col-md-6 my-3">
        <h1 class="border-0 shadow p-3 mb-3" style="border-radius: 2rem;"> Recordatorios</h1>
        <img src="{{'/images/recordatorio-index.png'}}" alt="">
    </div>
    <div class="col-md-6 mt-5">
        <img src="{{'/images/recordatorios.png'}}" class="agregar-recordatorio" alt="" data-target="#agregar-recordatorio" data-toggle="modal">
        <p class="mt-2 font-weight-bold">Agregar Recordatorio
        </p>
    </div>
</div>

<!-- modal-->
<div class="modal fade" id="agregar-recordatorio" tabindex="-1" data-keyboard="false" aria-hidden="true" aria-labelledby="agregar-recordatorioLabel" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2><img src="{{'/images/estatus.png'}}" alt="" class="mr-2">Nuevo Recordatorio</h2>
            </div>
            <div class="modal-body">
                <form action="{{route('recordatorio.agregar')}}" method="POST" novalidate name="formulario-recordatorio" id="formulario-recordatorio">
                @csrf
                <p class="text-center font-weight-bold">Campos obligatorios <span class="text-danger">*</span></p>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{'/images/editar.png'}}" class="mr-1 mb-3" alt="">
                        <label for="asunto">Asunto <span class="text-danger">*</span> </label>
                        <input type="text" name="asunto" id="asunto" class="form-control @error('asunto') is-invalid @enderror" value="{{old('asunto')}}">
                        @error('asunto')
                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-3">
                        <img src="{{'/images/fecha.png'}}" class="mr-1 mb-3" alt="">
                        <label for="fecha">Fecha Evento <span class="text-danger">*</span> </label>
                        <input type="datetime-local" name="fecha" id="fecha" value="{{old('fecha')}}"class="form-control @error('fecha') is-invalid @enderror">
                        @error('fecha')
                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-6 mt-3">
                        <img src="{{'/images/show-prospecto-user.png'}}" class="mr-1 mb-3" alt="">
                        <label for="prospecto">Prospecto <span class="text-danger">*</span> </label>
                       <select name="prospecto_id" id="prospecto_id" class="form-control text-uppercase @error('prospecto_id') is-invalid @enderror">
                        <option value="">-- Seleccione --</option>
                        @foreach ($prospectos as $prospecto)
                            <option value="{{$prospecto->id}}"{{old('prospecto_id') == $prospecto->id ? 'selected': ''}} >{{$prospecto->nombre}}</option>
                        @endforeach

                    </select>
                    @error('prospecto_id')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="form-group">
                            <img src="{{'/images/fecha.png'}}" alt="" class="mr-1 mb-3">
                            <label for="fecha_recordatorio">Fecha Recordatorio <span class="text-danger">*</span> </label>
                            <input type="datetime-local" name="fecha_recordatorio" id="fecha_recordatorio" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button type="submit" class="btn btn-dark mt-3 mr-3"><img src="{{'/images/agregar-archivo.png'}}" width="40px" alt=""> Agregar</button>
                    <button type="button" class="btn btn-primary mt-3 " data-dismiss="modal" ><img src="{{'/images/cerrar.png'}}" width="40px" alt=""> Cancelar</button>
                </div>

                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>

    </div>

</div>


<div class="contenido-recordatorios ml-5 ml-md-0">
    <table class="table w-100 display responsive nowrap" id="table-recordatorios">
        <thead>
            <tr>
                <th>#</th>
                <th>Asunto</th>
                <th>Fecha</th>
                <th>Prospecto</th>
                <th class="acciones">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recordatorios as $recordatorio)
            <tr>
                <td>{{$recordatorio->id}}</td>
                <td>{{$recordatorio->asunto}}</td>
                <td>{{$recordatorio->fecha}}</td>
                <td>{{$recordatorio->prospecto->nombre}}</td>
                <td class="acciones">
                    <a href="{{route('recordatorio.show', ['recordatorio' => $recordatorio->id])}}" class="btn btn-dark my-2 d-block"><img src="{{'/images/show.png'}}" alt=""></a>

                    <a href="{{route('recordatorio.editar', ['recordatorio' => $recordatorio->id])}}" class="btn btn-dark my-2 d-block"><img src="{{'/images/editar.png'}}" alt=""></a>

                    <form method="POST" id="eliminar-recordatorio" aria-modal="eliminar-recordatorio">
                        @csrf
                        @method('DELETE')
                        <button type="button"  data-toggle="modal" data-placement="top" title="Eliminar recordatorio" onclick="eliminarRecordatorio({{$recordatorio->id}});" id="{{$recordatorio->id}}" class="btn btn-dark my-2 d-block w-100"><img src="{{'/images/eliminar.png'}}" alt=""></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
