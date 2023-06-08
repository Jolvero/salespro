@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/correos.js')}}"defer></script>
    <script src="{{ asset('js/alertas.js')}}"defer></script>
@endsection
@section('content')

@if (session('success'))
    <div class="alert alert-success text-center" role="alert">
        {{session('success')}}
    </div>
@endif
    <h1 class="font-weight-bold ml-5 ml-md-0 border-0 shadow mb-3" style="border-radius: 2rem;"><img src="{{ '/images/mailing.png' }}" alt="" class="mr-2 mb-5 py-2 mt-4 px-3"> Mailing</h1>
    <form action="{{ route('mailing.store') }}" novalidate method="POST" name="form-mailing" id="form-mailing" enctype="multipart/form-data">
        @csrf
    <div class="row ml-5 ml-md-0">
        <div class="col-md-3">
            <label for="tipo"><img src="{{'/images/categoria.png'}}" class=" mb-2 mr-2" alt=""> Seleccione categoría</label>
            <select name="tipo" id="tipo" class="form-control mb-5">
                <option value="">-- Seleccione --</option>
                <option value="clientes">Clientes</option>
                <option value="prospectos">Prospectos</option>
            </select>
        </div>
        <div class="col-md-6" id="tabla-contenido">

        </div>

            <div class="col-md-4 mt-5">
                <div class="form-group">
                    <label for="plantilla"> <img src="{{'/images/plantilla.png'}}" class=" mb-2 mr-2" alt=""> Plantillas</label>
                    <select name="plantilla" id="plantilla" class="form-control">
                        <option value="">-- Seleccione</option>
                        @foreach ($plantillas as $plantilla)
                            <option value="{{$plantilla->id}}" data-text="{{ $plantilla->plantilla }}">
                                {{ $plantilla->nombre }}</option>
                        @endforeach
                    </select>

                </div>
            </div>


                <div class="col-md-6 mt-5">
                    <div class="form-group">
                        <label class="font-weight-bold4" for="plantilla-seleccionada">Plantilla Seleccionada</label>
                        <textarea style="height: 10rem;" class="mt-5 form-control" name="plantilla-seleccionada" id="plantilla-seleccionada"></textarea>
                    </div>
                </div>



            <div class="col-md-6 mt-5">
                <div class="form-group">
                    <label for="correos"><img src="{{'/images/documento.png'}}" class=" mb-2 mr-2" alt="">Documento</label>
                    <input type="file" name="info[]" id="info" accept="image/*" class="form-control" multiple>
                </div>
        </div>
    </form>
@endsection
