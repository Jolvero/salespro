@extends('layouts.app')

@section('scripts')
<script src="{{asset('js/clientes.js')}}" defer></script>
<script src="{{asset('js/clientes-tables.js')}}" defer></script>
@endsection
@section('content')
<div class="row ml-5 ml-md-0">
    <div class="col-md-6 my-5">
        <h1 class="font-weight-bold border-0 shadow p-3" style="border-radius: 2rem;">Mis Clientes</h1>
        <img src="{{'/images/clientes.png'}}" class="mt-4" alt="">
    </div>


</div>

<div class="contenido-clientes">
    <table class="table w-100 display responsive nowrap ml-5 ml-md-0" id="table-clientes">
        <thead>
            <tr data-aos="fade-down" data-aos-duration="1000" class="text-center">
                <th>#</th>
                <th>Nombre</th>
                <th>Prospectador</th>
                <th class="acciones">Acciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr class="text-center" data-aos="fade-down" class="text-center" data-aos-duration="1000">
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->usuario->name}}</td>
                <td class="acciones">
                    <a href="{{route('cliente.show',['cliente' => $cliente->id])}}" class="btn btn-dark my-2 d-block"><img src="{{'/images/show.png'}}" class="d-block mx-auto" alt=""></a>

                    <a href="{{route('cliente.editar',['cliente' => $cliente->id])}}" class="btn btn-dark my-2 d-block"><img src="{{'/images/editar.png'}}" class="d-block mx-auto my-1" alt=""></a>

                    <form method="POST" id="eliminar-cliente">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="eliminarCliente({{$cliente->id}});" data-toggle="tooltop" data-placement="top" title="Eliminar cliente" id="{{$cliente->id}}" class="btn btn-dark my-2 d-block w-100"><img src="{{'/images/eliminar.png'}}" alt=""></button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
