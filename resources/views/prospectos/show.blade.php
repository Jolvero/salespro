@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/correos.js') }}" defer></script>
    <script src="{{ asset('js/alertas.js') }}" defer></script>
    <script src="{{ asset('js/prospectos.js') }}" defer></script>
    <script src="{{ asset('js/comentario.js') }}" defer></script>
@endsection
@section('content')
    @if (session('correo'))
        <div class="alert alert-success text-center">
            {{ session('correo') }}
        </div>
    @endif

    <!-- Modal-->

    @if (count($cotizaciones) > 0)
        <div class="modal fade" id="cotizaciones" tabindex="-1" aria-hidden="true" data-backdrop="static" data-keyboard="false"
            aria-labelledby="cotizacionesLabel">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content border-0 shadow" style="border-radius: 2rem;">
                    <div class="modal-header">
                        <h2><img src="{{ '/images/cotizacion.png' }}" alt=""> Cotizaciones</h2>
                    </div>
                    <div class="modal-body mb-5 ">
                        <div class="row">
                            @foreach ($cotizaciones as $cotizacion)
                                <div class="col-md-4">
                                    <div class="card card-body cotizaciones">
                                        <a href="{{ route('cotizacion.show', ['cotizacion' => $cotizacion->id]) }}"
                                            class="btn btn-light text-decoration-none text-dark"
                                            target="blank">{{ $cotizacion->nombre }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button
                " class="btn btn-primary" data-dismiss="modal"
                            aria-label="Close"><img src="{{ '/images/cerrar.png' }}" class="mr-1" alt="">
                            Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" id="enviar-correo" tabindex="-1" data-keyboard="false" aria-hidden="true"
        aria-labelledby="enviar-correoLabel" data-backdrop="static">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><img src="{{ '/images/correo.png' }}" alt=""> Correo</h2>
                </div>
                <div class="modal-body">
                    <form action="{{ route('prospecto.correo') }}" method="POST" novalidate enctype="multipart/form-data"
                        id="formulario-correo" name="formulario-correo">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 my-3 my-md-0">
                                <img src="{{ '/images/destinatario.png' }}" class="mr-1 mb-3" alt="">
                                <label for="destinatario" class="font-weight-bold">Correo</label>
                                <input type="email" name="destinatario" id="destinatario"
                                    class="form-control @error('destinatario') is-invalid @enderror"
                                    value="{{ $prospecto->correo }}">
                                @error('destinatario')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <img src="{{ '/images/editar.png' }}" class="mr-1 mb-3" alt="">
                                <label for="destinatario" class="font-weight-bold">Asunto</label>
                                <input type="email" name="asunto" id="asunto"
                                    class="form-control @error('asunto') is-invalid @enderror"
                                    value="{{ old('remitente') }}">
                                @error('asunto')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ '/images/mensaje.png' }}" class="mr-1 my-3" alt="">
                                    <label for="mensaje" class="font-weight-bold">Mensaje</label>
                                    <textarea name="mensaje" class="form-control @error('mensaje') is-invalid @enderror" id="mensaje" cols="30"
                                        rows="10">{{ old('mensaje') }}</textarea>
                                    @error('mensaje')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ '/images/adjuntar.png' }}" class="mr-1 my-3" alt="">
                                    <label for="adjunto" class="font-weight-bold">Adjunto</label>
                                    <input class="form-control" type="file" name="adjunto[]" multiple id="adjunto">
                                </div>

                                <div class="form-group">
                                    <img src="{{'/images/plantilla.png'}}" alt="" class="mr-1 my-3">
                                    <label for="">Plantillas</label>
                                    <select name="plantilla_id" id="plantilla_id" class="form-control">
                                        <option value="">-- Seleccione</option>
                                        @foreach ($plantillas as $plantilla)
                                            <option value="{{$plantilla->id}}" data-texto="{{$plantilla->plantilla}}">{{$plantilla->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-dark mt-2 text-white" id="btn-enviar"><img
                                            src="{{ '/images/agregar-archivo.png' }}" width="64px" alt="">
                                        Enviar</button>
                                    <button type="button" class="btn btn-primary mt-2 ml-4" data-dismiss="modal"><img
                                            src="{{ '/images/cerrar.png' }}" alt=""> Cancelar</button>
                                </div>
                            </div>
                            <input type="hidden" name="nombre-prospecto" value="{{ $prospecto->nombre }}">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-between ml-5 ml-md-0">

        <div class="col-md-5" data-aos="flip-right" data-aos-duration="1000">
            <div class="card card-body">
                <img src="{{ '/images/prospecto.show.png' }}" class="d-block mx-auto" alt="">
                <h2 class="text-center mt-3" id="prospecto">{{ $prospecto->nombre }}</h2>
            </div>

        </div>

        <div class="col-md-7" data-aos="flip-left" data-aos-duration="1000">
            <div class="card card-body">
                <p class="font-weight-bold"><img src="{{ '/images/estatus.png' }}" class="mr-1" alt="">
                    Estatus:
                    <span class="font-weight-normal">{{ $prospecto->estado->estado }}</span>
                </p>
                <p class="font-weight-bold"><img src="{{ '/images/servicios.png' }}" class="mr-1" alt="">
                    Servicio:
                    <span class="font-weight-normal">{{ $prospecto->servicio->servicio }}</span>
                </p>
                <p class="font-weight-bold"><img src="{{ '/images/correo.png' }}" data-toggle="modal"
                        data-target="#enviar-correo" data-placement="top" title="Enviar Correo" class="mr-1 correo-img"
                        alt=""> Correo:
                    <span class="font-weight-normal">{{ $prospecto->correo }}</span>
                </p>
                @foreach ($tarifas as $tarifa)
                    <ul class="list-unstyled components">
                        <div class="py-2">
                            <a href="#tarifa" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle sidebar-link collapsed item"><span> <img
                                        src="{{ '/images/tarifa.png' }}" class="mr-1" alt="">Tarifa</span></a>
                        </div>

                        <ul class="sidebar-dropdown list-unstyled collapse" id="tarifa">
                            <li>
                                @if ($tarifa->estatus_id == 2)
                                    <p class="font-weight-bold"> Tarifa:
                                        <span class="font-weight-normal">${{ $tarifa->tarifa }}</span>
                                    </p>
                                @endif

                                @if (Auth::user()->rol_id == 1 && $tarifa->estatus_id == 1)
                                    <p class="font-weight-bold"> Tarifa:
                                        <span class="font-weight-normal">${{ $tarifa->tarifa }}</span>
                                    </p>
                                    <div class="d-md-flex">
                                        <form method="POST" id="autorizar-tarifa">
                                            @csrf
                                            @method('PUT')
                                            <button class=" btn-agregar text-white p-3 rounded mx-5" id="btn-autorizar"
                                                style="background-color: rgb(25, 115, 184); border: none;"
                                                type="button">Autorizar</button>

                                        </form>
                                    </div>
                                @endif


                            </li>
                        </ul>
                    </ul>
                @endforeach


                <p class="font-weight-bold"><img src="{{ '/images/show-prospecto-user.png' }}" class="mr-1"
                        alt=""> Usuario: <span class="font-weight-normal">{{ $prospecto->usuario->name }}</span>

                </p>
                <section class="timeline mt-5">
                    @if (count($comentarios) > 0)
                        <h2 class="text-center font-weight-bold">Seguimientos</h2>
                        <ul>
                            @foreach ($comentarios as $comentario)
                                <li class="in-view" data-aos="fade-left">
                                    <div class="contenido-comentario">
                                        @php
                                            $fecha = $comentario->updated_at;
                                        @endphp
                                        <time>Comentario</time>
                                        <h3 class=""><span
                                                class="font-weight-bold"></span>{{ $comentario->comentario }}</h3>
                                        <formatear-fecha fecha="{{ $fecha }}"></formatear-fecha>

                                        <form method="POST" id="formulario-comentario-update">
                                            @csrf
                                            <textarea name="comentario" id="{{$comentario->id}}" class="comentario" cols="30" style="height: 100px; width:150px;" rows="10" >{{$comentario->comentario}}</textarea>
                                        </form>

                                        <form method="POST" id="formulario-eliminar-comentario">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" id="{{$comentario->id}}" onclick="eliminarComentario({{$comentario->id}});" data-toggle="tooltip" data-placement="top" title="Eliminar Comentario" class="btn btn-dark my-2 d-block w-100"><img src="{{'/images/eliminar.png'}}" alt=""></button>
                                            </form>


                                    </div>
                                </li>
                            @endforeach
                    @endif

                    </ul>
                </section>
            </div>

        </div>
    </div>

    @if (count($cotizaciones) > 0)
        <div class="elementos-adicionales mt-5 ml-5 ml-md-0">
            <button class="btn btn-light text-dark" data-target="#cotizaciones" data-toggle="modal"><img
                    src="{{ '/images/show-cotizaciones.png' }}"class="mr-2" alt=""> Documentos</button>
        </div>
    @endif
    <input type="hidden" id="id" value="{{ $prospecto->tarifa_id }}">
@endsection
