@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/alertas.js')}}" defer></script>
<script src="{{asset('js/plantillas-table.js')}}" defer></script>
<script src="{{asset('js/plantillas.js')}}" defer></script>
@endsection

@section('content')
    @if (session('plantilla'))
        <div class="alert alert-success text-center">
            {{ session('plantilla') }}
        </div>
    @endif

    <div class="row ml-5 ml-md-0">
        <div class="col-md-6">
            <h1 class="border-0 shadow p-3 mb-4" style="border-radius: 2rem;">Mis plantillas</h1>
            <img src="{{ '/images/plantilla.png' }}" alt="" class="ml-5 mt-1">
        </div>

        <div class="col-md-6 mt-5 mt-md-0" data-aos="fade-up" data-aos-duration="1000">
            <img src="{{ '/images/plantilla-add.png' }}" class="mt-0 ml-5 ml-md-0 agregar-prospecto" alt=""
                data-target="#agregar-plantilla" data-toggle="modal">
            <p class="mx-5 mx-md-0 mt-2">Agregar Plantilla</p>
        </div>
    </div>

    <div class="modal fade" id="agregar-plantilla" tabindex="-1" aria-hidden="true" data-backdrop="static"
        data-keyboard="false" aria-labelledby="agregar-plantillaLabel" role="dialog">

        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Nueva Plantilla</h2> <img src="{{ '/images/plantilla.png' }}" width="50px"
                        class="ml-2" alt="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('plantilla.store') }}" class="formulario-crear" id="formulario"
                        enctype="multipart/form-data" method="POST" novalidate>
                        <p class="text-center font-weight-bold">Campos obligatorios <span class="text-danger">*</span></p>
                        <div class="row justify-content-center mt-3">
                            @csrf

                            <div class="col-md-6">

                                <div class="form-group">
                                    <img src="{{ '/images/nombre.png' }}" class="mr-1 mb-3" alt="">
                                    <label for="nombre">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre"
                                        value="{{ old('nombre') }}">

                                    @error('nombre')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <img src="{{ '/images/nombre.png' }}" class="mr-1 mb-3" alt="">
                                    <label for="plantilla">Plantilla <span class="text-danger">*</span></label>
                                    <textarea type="text" class="form-control @error('plantilla') is-invalid @enderror" name="plantilla" id="plantilla"
                                        value="{{ old('plantilla') }}" style="height: 200px;"></textarea>

                                    @error('plantilla')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-group d-block">
                            <button type="submit" style="background-color:#1973b8; border:none;" type="submit"
                                class="boton text-white p-3 rounded d-block mx-auto btn-agregar"
                                id="agregar-distribucion"><img src="{{ '/images/agregar-archivo.png' }}" width="40px"
                                    alt="img-agregar"> Agregar Plantilla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="contenido-plantillas ml-5 ml-md-0">
        <table class="table w-100 display responsive nowrap" id="table-plantillas">
            <thead>
                <tr data-aos="fade-down" data-aos-duration="1000">
                    <th>#</th>
                    <th>Plantilla</th>
                    <th>Usuario</th>
                    <th class="acciones">Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($plantillas as $plantilla)
                <tr class="text-center" data-aos="fade-down" data-aos-duration="1000">
                    <td>{{$plantilla->id}}</td>
                    <form method="POST">
                        @csrf
                        @method('PUT')
                        <td>
                            <textarea name="actualizar-plantilla" id="{{$plantilla->id}}" onblur="actualizarPlantilla(this.value, {{$plantilla->id}});" cols="30" rows="10">{{$plantilla->plantilla}}</textarea>
                            </td>
                    </form>

                    <td>{{$plantilla->user->name}}</td>
                    <td class="acciones">
                        <a href="{{route('plantilla.show',['plantilla' => $plantilla->id])}}" class="btn btn-dark my-2 d-block"><img src="{{'/images/show.png'}}" class="d-block mx-auto" alt=""></a>

                        <form method="POST" id="formulario-eliminar-plantilla">
                        @csrf
                        @method('DELETE')
                        <button type="button" id="{{$plantilla->id}}" onclick="eliminarPlantilla({{$plantilla->id}});" data-toggle="tooltip" data-placement="top" title="Eliminar Plantilla" class="btn btn-dark my-2 d-block w-100"><img src="{{'/images/eliminar.png'}}" alt=""></button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

@endsection
