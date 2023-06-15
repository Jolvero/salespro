<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/menuLateral.js') }}" defer></script>
    <script src="{{ asset('js/spinner.js') }}" defer></script>
    <script src="{{ asset('js/login.js') }}" defer></script>
    <script src="{{ asset('js/notificacion.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts" defer></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js" defer></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.2/js/dataTables.rowReorder.min.js" defer></script>
    <script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.6.1/js/dataTables.colReorder.min.js" defer>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('styles')


    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/rowreorder/1.3.2/css/rowReorder.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.6.1/css/colReorder.dataTables.min.css">
    <link rel="icon" type="image/png" href="{{'/images/icono.png'}}"/>


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app" class="bg-index">
        <!-- Incluir panel si el usuario esta autenticado -->
        @guest
        @else
            @include('panel.panel')
        @endguest

        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm py-2 nav-principal">
            <div class="container index m-0 p-0">
                <div class="d-flex justify-content-start ">
                    <a class="navbar-brand text-white p-0" href="{{ url('/') }}">
                    </a>

                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @auth
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-5 ml-md-0 d-flex flex-md-row flex-column align-items-center"
                            id="items-nav">
                            {{-- @if (Auth::user()->rol_id == 1)
                                <li class="mx-5 mt-4 mt-md-0">
                                    <a href="{{ route('prospecto.notificacion') }}"
                                        class="rounded-100 btn notificaciones font-weight-bold m-0 mr-1"><img
                                            src="{{ '/images/notificacion.png' }}"
                                            alt="">{{ Auth::user()->unreadNotifications->count() }}</a>
                                </li>
                            @else
                                <li class="mx-5 mt-4 mt-md-0">
                                    <a href="{{ route('recordatorios.notificaciones') }}"
                                        class="rounded-100 btn notificaciones font-weight-bold  mr-1"><img
                                            src="{{ '/images/notificacion.png' }}"
                                            alt="">{{ Auth::user()->unreadNotifications->count() }}</a>
                                </li>
                            @endforelse --}}

                            <li class="mx-5 mt-4 mt-md-0">
                                <a href="{{ route('notificaciones.index') }}"
                                    class="rounded-100 btn notificaciones font-weight-bold m-0 mr-1"><img
                                        src="{{ '/images/notificacion.png' }}"
                                        alt="">{{ Auth::user()->unreadNotifications->count() }}</a>
                            </li>
                            <li class="mt-2 mt-md-0">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <!-- Authentication Links -->
                                <a href="{{ route('logout') }}" id="logout" style="width: 30px" data-toggle="tooltip"
                                    data-placement="top" title="Salir"
                                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                                    <img src="{{ '/images/logout.png' }}" width="35px" class="mt-3 mt-md-0"
                                        alt="">
                                </a>
                            </li>


                        </ul>
                    </div>
                @endauth
            </div>
        </nav>




        {{-- <nav class="navbar navbar-expand-md navbar-light bg-dark mt-5">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#estados" aria-controls="estados" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                    Estados
                </button>
                <div class="collapse navbar-collapse " id="estados">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav w-100 d-flex justify-content-between">
                        @foreach ($estados as $estado)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('estados.show', ['estadoEmbarque' => $estado->id ]) }}">
                               {{ $estado->nombre }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav> --}}
        <div class="container">
            <div class="row">
                <div class="py-5 mt-5 col-12">
                    @yield('botones')
                </div>

                <main class="py-1 mt-1 col-12">
                    @yield('content')
                </main>
            </div>

        </div>
        <div class="hero-inicio">
            @yield('hero')
        </div>
        @yield('style')
    </div>

    <div class="modal fade" id="notificacion" tabindex="-1" data-keyborad="false" aria-hidden="true"
        data-backdrop="static" aria-label="notificacionLabel" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="moda-title">Notificacion</p>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary mt-3 " data-dismiss="modal"><img
                            src="{{ '/images/cerrar.png' }}" width="40px" alt=""> Cerrar</button>
                </div>
            </div>
        </div>

    </div>

    <footer class="mt-5 bg-dark p-2 ml-5 ml-md-0">
        <p class="text-white text-center mb-0 mt-3">Copyright © M & Rol Logistics, S.A. de C.V. México 2023. Todos los
            derechos reservados.
        </p>
        <p class="text-white text-center">Sitio web diseñado por <a href="https://jdevelopers.com.mx" target="blank"
                class="text-white font-weight-bold">J & Developers</a> </h2>
    </footer>


    @yield('scripts')
    <div class="spinner-section fixed-top"></div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
