@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/prospectos.js') }}" defer></script>
    <script src="{{ asset('js/alertas.js') }}" defer></script>
    @endsection
@section('content')

@if (session('estado'))

<div class="alert alert-danger text-center" role="alert">
    {{session('estado')}}
</div>

@endif
<div class="card card-body ml-5 ml-md-0">
    <h1 class="mb-5 mt-3 mx-3"><img src="{{'/images/editar-prospecto.png'}}" class="mr-2" alt=""> Editar {{$prospecto->nombre}}</h1>
    <div class="editar-prospecto">
        <form action="{{route('prospecto.actualizar', ['prospecto' => $prospecto->id])}}" class="formulario-crear" id="formulario" name="formulario" enctype="multipart/form-data" method="POST" novalidate>
            <div class="row justify-content-center mt-3">

                @csrf
                @method('PUT')
                <div class="col-md-6">

                <div class="form-group">
                    <img src="{{'/images/nombre.png'}}" class="mr-1 mb-3" alt="">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" value="{{$prospecto->nombre}}">

                    @error('nombre')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{'/images/show-prospecto-user.png'}}" class="mr-1 mb-3" alt="">
                        <label for="estado_id">Estado <span class="text-danger">*</span></label>
                        <select name="estado_id" id="estado_id" class="form-control @error('estado_id') is-invald @enderror">
                            @foreach ($estados as $estado)
                                <option value="{{$estado->id}}" class="text-uppercase" {{$prospecto->estado_id ==$estado->id ? 'selected': ''}}>{{$estado->estado}}</option>
                            @endforeach
                        </select>

                        @error('estado_id')
                        <span class="invalid-feedback"><strong>{{$message}}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{'/images/empresa.png'}}" alt="img-empresa" class="mr-1 mb-3">
                         <label for="estado_id">Empresa</label>
                        <input type="text" name="empresa" id="empresa" class="form-control  @error('empresa') is-invalid @enderror" value="{{$prospecto->empresa}}">
                        @error('empresa')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{'/images/servicios.png'}}" alt="img-empresa" class="mr-1 mb-3">
                         <label for="estado_id">Servicio</label>
                        <select name="servicio_id" id="servicio_id" class="form-control  @error('servicio_id') is-invalid @enderror">
                            <option value="">-- Seleccione --</option>
                            @foreach ($servicios as $servicio)
                                <option value="{{$servicio->id}}"{{$prospecto->servicio_id == $servicio->id ? 'selected': ''}}>{{$servicio->servicio}}</option>
                            @endforeach
                        </select>
                        @error('servicio_id')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{'/images/correo.png'}}"alt="img-correo" class="mr-1 mb-3">
                        <label for="correo">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control mb-5  @error('correo') is-invalid @enderror" value="{{$prospecto->correo}}">
                        @error('correo')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{'/images/documento.png'}}"alt="img-correo" class="mr-1 mb-3">
                        <label for="correo">Documento</label>
                        <input type="file" name="cotizacion_id[]" multiple id="cotizacion_id" class="form-control mb-5  @error('correo') is-correo @enderror" value="{{$prospecto->correo}}">
                        @error('correo')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                    </div>
                </div>

                @if ($tarifa_prospecto == null || Auth::user()->rol_id == 1 )
                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{'/images/tarifa.png'}}"alt="img-tarifa" class="mb-3">
                        <label for="correo">Tarifa</label>
                        <input type="number" name="tarifa" multiple id="tarifa" class="form-control mb-5  @error('tarifa') is-invalid @enderror" value="{{$tarifa}}">
                        @error('tarifa')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                    </div>
                </div>
                @elseif ($tarifa_prospecto == 2)
                <div class="col-md-6">
                    <img src="{{'/images/tarifa.png'}}"alt="img-tarifa" class="mb-3">
                   <p>Tarifa: ${{$tarifa}}</p>
                </div>
                @endforelse

                <div class="col-md-6">
                    <div class="form-group">
                        <img src="{{'/images/comentario.png'}}"alt="img-correo" class="mr-1 mb-3">
                        <label for="observaciones">Observaciones</label>
                        <textarea name="observaciones" id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" cols="30" rows="10">{{$prospecto->observaciones}}</textarea>
                        @error('observaciones')
                        <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                    @enderror
                    </div>
                </div>
                </div>

                <div class="form-group d-block mt-4">
                    <button type="submit"  style="background-color:#1973b8; border:none;" type="submit" class="boton text-white p-3 rounded d-block mx-auto btn-agregar"  id="agregar-distribucion"><img src="{{'/images/agregar-archivo.png'}}" width="40px" alt="img-agregar"> Editar Prospecto</button>
                </div>
            </form>
    </div>
</div>


@endsection
