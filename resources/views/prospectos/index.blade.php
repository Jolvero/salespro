@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/tables.js') }}" defer></script>
    <script src="{{ asset('js/prospectos.js') }}" defer></script>
    <script src="{{ asset('js/alertas.js') }}" defer></script>
    <script src="{{ asset('js/eliminar-prospecto.js')}}"defer ></script>
@endsection
@section('content')

@if (session('estado'))
<div class="alert alert-success text-center" role="alert">
    {{session('estado')}}
</div>

@endif

@if (session('tamaño'))

<div class="alert alert-danger text-center" role="alert">
    {{session('tamaño')}}
</div>

@endif

<div class="modal fade" id="agregar-prospecto" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false" aria-labelledby="agregar-homologacionLabel" role="dialog">

    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Nueva Prospección</h2> <img src="{{'/images/agregar-prospecto.png'}}" width="50px" class="ml-2" alt="">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form action="{{route('prospecto.store')}}" class="formulario-crear" id="formulario" enctype="multipart/form-data" method="POST" novalidate>
                    <p class="text-center font-weight-bold">Campos obligatorios <span class="text-danger">*</span></p>
                <div class="row justify-content-center mt-3">
                    @csrf
                    <div class="col-md-6">

                    <div class="form-group">
                        <img src="{{'/images/nombre.png'}}" class="mr-1 mb-3" alt="">
                        <label for="nombre">Nombre <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" id="nombre" value="{{old('nombre')}}">

                        @error('nombre')
                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                        @enderror
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="{{'/images/empresa.png'}}" alt="img-empresa" class="mr-1 mb-3">
                             <label for="estado_id">Empresa <span class="text-danger">*</span></label>
                            <input type="text" name="empresa" id="empresa" class="form-control  @error('empresa') is-invalid @enderror" value="{{old('empresa')}}">
                            @error('empresa')
                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="{{'/images/servicios.png'}}" alt="img-empresa" class="mr-1 mb-3">
                             <label for="estado_id">Servicio <span class="text-danger">*</span></label>
                            <select name="servicio_id" id="servicio_id" class="form-control text-uppercase @error('servicio_id') is-invalid @enderror" value="{{old('servicio_id')}}">
                                <option value="">-- Seleccione --</option>
                                @foreach ($servicios as $servicio)
                                    <option value="{{$servicio->id}}" {{old('servicio_id') == $servicio->id ? 'selected' : ''}}>{{$servicio->servicio}}</option>
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
                            <label for="correo">Correo <span class="text-danger">*</span></label>
                            <input type="email" name="correo" id="correo" class="form-control mb-5  @error('correo') is-invalid @enderror" value="{{old('correo')}}">
                            @error('correo')
                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="{{'/images/documento.png'}}"alt="img-correo" class="mr-1 mb-3">
                            <label for="correo">Documento</label>
                            <input type="file" name="cotizacion_id[]" multiple id="cotizacion_id" class="form-control mb-5  @error('correo') is-correo @enderror" value="{{old('correo')}}">
                            @error('correo')
                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <img src="{{'/images/comentario.png'}}"alt="img-editar" class="mr-1 mb-3">
                            <label for="observaciones">Observaciones</label>
                            <textarea name="observaciones" id="observaciones" class="form-control @error('observaciones') is-invalid @enderror" cols="30" rows="10">{{old('observaciones')}}</textarea>
                            @error('observaciones')
                            <span class="invalid-feedback" role="alert"><strong>{{$message}}</strong></span>
                        @enderror
                        </div>
                    </div>


                    </div>

                    <div class="form-group d-block">
                        <button type="submit"  style="background-color:#1973b8; border:none;" type="submit" class="boton text-white p-3 rounded d-block mx-auto btn-agregar"  id="agregar-distribucion"><img src="{{'/images/agregar-archivo.png'}}" width="40px" alt="img-agregar"> Agregar Prospecto</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


</div>
    <section>
        <h1 class="font-weight-bold ml-5 ml-md-3 border-0 shadow p-3 mb-5" style="border-radius: 2rem;" data-aos="fade-down" data-aos-duration="1000">Mis prospectos</h1>
        <div class="row justify-content-between">
            <div class="col-md-6" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{ '/images/prospectos.png' }}" class="ml-5 ml-md-0" alt="">
            </div>
            <div class="col-md-6" data-aos="fade-up" data-aos-duration="1000">
                <img src="{{ '/images/agregar-prospecto.png' }}" class="mt-0 ml-5 ml-md-0 agregar-prospecto" alt=""  data-target="#agregar-prospecto" data-toggle="modal">
                <p class="mx-5 mx-md-0 mt-2">Agregar Prospecto</p>
            </div>
        </div>


        <div class="contenido-prospectos ml-5 ml-md-0">
            <table class="table w-100 display responsive nowrap" id="table">
                <thead>
                    <tr data-aos="fade-down" data-aos-duration="1000">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Servicio</th>
                        <th>Usuario</th>
                        <th class="acciones">Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($prospectos as $prospecto)
                    <tr class="text-center" data-aos="fade-down" data-aos-duration="1000">
                        <td>{{$prospecto->id}}</td>
                        <td>{{$prospecto->nombre}}</td>
                        <td>{{$prospecto->empresa}}</td>
                        <td>{{$prospecto->servicio->servicio}}</td>
                        <td>{{$prospecto->usuario->name}}</td>
                        <td class="acciones">
                            <a href="{{route('prospecto.show',['prospecto' => $prospecto->id])}}" class="btn btn-dark my-2 d-block"><img src="{{'/images/show.png'}}" class="d-block mx-auto" alt=""></a>

                            <a href="{{route('prospecto.editar',['prospecto' => $prospecto->id])}}" class="btn btn-dark my-2 d-block"><img src="{{'/images/editar.png'}}" class="d-block mx-auto my-1" alt=""></a>

                            <form method="POST" id="formulario-eliminar-prospecto">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="{{$prospecto->id}}" onclick="eliminarProspecto({{$prospecto->id}});" data-toggle="tooltip" data-placement="top" title="Eliminar Prospecto" class="btn btn-dark my-2 d-block w-100"><img src="{{'/images/eliminar.png'}}" alt=""></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </section>
@endsection
