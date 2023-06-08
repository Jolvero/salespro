@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/clientes.js')}}" defer></script>
@endsection
@section('content')

@if (session('estado'))

<div class="alert alert-danger text-center" role="alert">
    {{session('estado')}}
</div>

@endif
<div class="row">
    <div class="col-md-6 ml-5 ml-md-0 border-bottom border-lg">
        <h1>Editar {{$cliente->nombre}}</h1>
        <img src="{{'/images/clientes.png'}}" class="ml-5 my-2" alt="">
    </div>
</div>

    <form action="{{route('cliente.update', ['cliente' => $cliente->id])}}" method="POST" id="formulario-clientes">
        @method('PUT')
        @csrf
        <div class="row justify-content-center">
    <div class="col-md-6 mt-5">
        <div class="form-group">
            <img src="{{'/images/nombre.png'}}" alt=""class="mr-1 mb-3">
            <label for="cliente">Cliente <span class="text-danger">*</span> </label>
            <input type="text" name="cliente" id="cliente" class="form-control @error('clientw') is-invalid @enderror" value="{{$cliente->nombre}}">
            @error('cliente')
                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6 mt-5">
        <div class="form-group">
            <img src="{{'/images/documento.png'}}" alt=""class="mr-1 mb-3">
            <label for="rfc">RFC</label>
            <input type="text" name="rfc" id="rfc" class="form-control @error('rfc') is-invalid @enderror" value="{{$cliente->rfc}}">
            @error('rfc')
                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6 mt-5">
        <div class="form-group">
            <img src="{{'/images/direccion.png'}}" alt=""class="mr-1 mb-3">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{$cliente->direccion}}">
            @error('direccion')
                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6 mt-5">
        <div class="form-group">
            <img src="{{'/images/empresa.png'}}" alt=""class="mr-1 mb-3">
            <label for="empresa">Empresa <span class="text-danger">*</label>
            <input type="text" name="empresa" id="empresa" class="form-control @error('empresa') is-invalid @enderror" value="{{$cliente->empresa}}">
            @error('empresa')
                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6 mt-5">
        <div class="form-group">
            <img src="{{'/images/correo.png'}}" alt=""class="mr-1 mb-3">
            <label for="correo">Correo <span class="text-danger">*</label>
            <input type="text" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{$cliente->correo}}">
            @error('correo')
                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6 mt-5">
        <div class="form-group">
            <img src="{{'/images/comentario.png'}}" alt=""class="mr-1 mb-3">
            <label for="observaciones">observaciones</label>
            <textarea type="text" name="observaciones" id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" cols="30" rows="10" >{{$cliente->observaciones}}</textarea>
            @error('observaciones')
                <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
            @enderror
        </div>
    </div>
    <div class="form-group d-block mt-5">
        <button type="submit"  style="background-color:#1973b8; border:none;" type="submit" class="boton text-white p-3 rounded d-block mx-auto btn-agregar"  id="agregar-distribucion"><img src="{{'/images/agregar-archivo.png'}}" width="40px" alt="img-agregar"> Editar Cliente</button>
    </div>
</form>
</div>
@endsection
