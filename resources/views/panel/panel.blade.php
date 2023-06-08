    <div id="sidemenu" class="menu-collapsed">
        <div id="header">
            <div id="menu-btn" class="mr-5">
                <div class="btn-hamburguer"></div>
                <div class="btn-hamburguer"></div>
                <div class="btn-hamburguer"></div>
            </div>
        </div>
        <a href="{{ route('inicio.index') }}"><img src="{{ '/images/logo.jpeg' }}" class="img-fluid" alt=""></a>
        <div id="menu-items" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
            <ul class="list-unstyled components mb-1">
                <li class="">
                    <div class="item-parent py-2">
                        <a href="#submenuSeguimientos" id="cartera"data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle sidebar-link collapsed item"><img class="ml-2 item-img mr-3 ml-0"
                                src="{{ '/images/cartera.png' }}" alt=""><span
                                class="mt-5 consultar-cartera">Cartera</span></a>
                    </div>
                    <ul class="sidebar-dropdown list-unstyled collapse"id="submenuSeguimientos">
                        <li>
                            <a class="sidebar-item d-flex link link-seguimientos my-2 py-2" id="embarque-index"
                                href="{{ route('cartera.index') }}">
                                <img class="ml-2 item-img mr-3 ml-0" src="{{ '/images/seguimiento.png' }}"
                                    alt=""><span class="mt-1 seguimientos">Seguimientos</span>
                            </a>
                        </li>

                        <li><a class="sidebar-item d-flex link link-seguimientos my-2 py-2" id="recordatorio-index"
                                href="{{ route('clientes.index') }}">
                                <img class="ml-2 item-img mr-3 ml-0" src="{{ '/images/prospecto.show.png' }}"
                                    alt="">
                                @if (Auth::user()->rol_id == 1)
                                    <span class="mt-1 consultar-clientes">Clientes</span>
                                @else
                                    <span class="mt-1 consultar-clientes">Mis Clientes</span>
                                @endforelse
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- <a class="d-flex link item-separator pb-2" id="imei" href="{{ route('kpis.index') }}">
                    <img class="ml-2 mr-3 mt-2 item-img" src="{{ '/images/kpis.png' }}" alt=""> <span
                        class="mt-2">KPI's</span>
                </a> --}}


                <li class="mt-2">
                    {{-- <div class="item-parent py-2"> --}}
                    {{-- <a href="#submenuCatalogos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggleitem"> <img
                        src="{{ '/images/cuadricula.png' }}" class="ml-2 item-img mr-3 ml-0"
                        alt=""><span class="text-dark">Catalogos</span></a>
                    </div> --}}
                    <ul class="collapse list-unstyled" id="submenuCatalogos">
                        <li>
                            {{-- <a class="d-flex link my-2 py-2"id="clientes" href="{{ route('cliente.index') }}">
                            <img class="ml-2 mr-3 item-img" src="{{ '/images/cliente.png' }}" alt=""> <span
                                class="mt-0">Clientes</span>
                        </a> --}}
                        </li>

                    </ul>
                </li>
                {{-- <li class="mt-2">
                <a href="#submenuTransporte" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> <img
                        src="{{ '/images/camion-de-carga.png' }}" class="ml-2 item-img mr-3 ml-0"
                        alt=""><span>Transporte</span></a>
                <ul class="collapse list-unstyled" id="submenuTransporte">
                    <li>

                    </li>
                    <li>

                    </li>

                </ul>
            </li> --}}

                {{-- <li class="mt-2">
                <a href="#submenuProveedores" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><img src="" class="ml-1 item-img mr-3 ml-0" alt=""> <span>Proveedores</span></a>

                <ul class="collapse list-unstyled" id="submenuProveedores">
                    <li>

                    </li>
                    <li>

                    </li>
                </ul>
            </li> --}}
            </ul>

            {{-- <div class="item-separator mt-1 pb-2 d-flex">
            <a class="d-flex" id="imei" href="{{route('distribucion.crear')}}">
            <img class="ml-2 mr-3 item-img" src="{{'/images/distribucion.png'}}" alt=""> <span class="mt-2">Solicitar Distribución</span>
        </a>
        </div> --}}

        <a class="sidebar-item d-flex link link-seguimientos my-2 py-2" id="recordatorio-index"
            href="{{ route('plantillas.index') }}">
            <img class="ml-2 item-img mr-3 ml-0" src="{{ '/images/plantilla.png' }}" alt="">
            <span class="mt-1 consultar-clientes font-weight-bold">Plantillas</span>
        </a>

            <a class="sidebar-item d-flex link link-seguimientos my-2 py-2" id="recordatorio-index"
                href="{{ route('recordatorio.index') }}">
                <img class="ml-2 item-img mr-3 ml-0" src="{{ '/images/estatus.png' }}" alt=""><span
                    class="mt-1 consultar-recordatorios font-weight-bold ">Recordatorios</span>
            </a>

            <a class="d-flex link item-separator pb-2 item" id="imei" href="{{ route('correo.mailing') }}">
                <img class="ml-2 mr-3 mt-2 item-img" src="{{ '/images/correo.png' }}" alt=""> <span
                    class="mt-2 consultar-usuarios">Mailing</span>
            </a>

            <a class="d-flex link item-separator pb-2 item" id="imei" href="{{ route('usuarios.index') }}">
                <img class="ml-2 mr-3 mt-2 item-img" src="{{ '/images/usuario.png' }}" alt=""> <span
                    class="mt-2 consultar-usuarios">Usuarios</span>
            </a>

        </div>

    </div>

