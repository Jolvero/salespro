<section  class="ml-5 ml-md-0">
    <h3 class="font-weight-bold mb-5 mr-5 mr-md-0 p-3 bg-white border-0 shadow" style="border-radius: 2rem;" data-aos="fade-down" data-aos-duration="1000">Bienvenido/a {{ $nombre }}</h3>
    <div class="row ml-4 justify-content-center">
        {{-- <div class="col-md-3">
            <div class="card ml-3">
                <div class="card-body shadow">
                    <div class="d-flex">
                    <img src="{{'/images/envase.png'}}" alt="">
                    <p class="font-weight-bold ml-3">x importaciones</p>
                </div>
                </div>
            </div>
        </div> --}}

        <div class="col-md-3 mr-5 mr-md-0 mb-5 mb-md-0">
            <div class="d-flex">
            <div class="card ml-3 border-0 shadow" style="border-radius: 2rem;" data-aos="flip-down" data-aos-duration="2000">
                <div class="card-body">
                        <img src="{{ '/images/clientes.png' }}" alt="">
                        <p class="font-weight-bold ml-3 mt-4 text-center">{{ $clientes }} Clientes</p>
                    </div>
                </div>
            </div>
        </div>

        @php
            $dia = date('Y-m-d')
        @endphp

        <div class="col-md-3 mr-5 mr-md-0">
            <div class="d-flex">
            <div class="card ml-3 border-0 shadow" style="border-radius: 2rem;" data-aos="flip-down" data-aos-duration="2000">
                <div class="card-body">
                        <img src="{{ '/images/human-resource.png'}}" alt="">
                        <p class="font-weight-bold ml-3 mt-4 text-center">{{ $prospectadores }} Prospectadores</p>
                    </div>
                </div>
            </div>
        </div>
</section>

<section class="distribuciones mt-5" data-aos="zoom-in" data-aos-duration="1300">
    <div class="card card-body border-0 shadow" style="border-radius: 2rem;">
    <h2 class="font-weight-bold ml-5">Clientes del Mes</h2>
    <figure class="ml-5 ml-md-0">
        <div id="containerClientes">

        </div>
    </figure>
</div>
    </div>
</section>

<section class="inventario mt-5 pt-3">

        <div class="mt-5 card card-body border-0 shadow" style="border-radius: 2rem;">
            <h2 class="font-weight-bold text-center">Prospectos del mes</h2>

            <figure class="ml-5 ml-md-0">
                <div id="mesProspectos"></div>
            </figure>
        </div>

        {{-- <div class="col-md-12 mt-5 pt-5 ml-5 ml-md-0">
            <h2 class="text-center font-weight-bold">Kpis</h2>

            <figure>
                <div id="kpis"></div>
            </figure>
        </div> --}}
    <div>
        <input type="hidden" value="{{$recordatorios}}" id="recordatorio">
    </div>
</section>

<section class="prospectos-usuarios mt-5 pt-3">

        <div class="mt-5 card card-body border-0 shadow" style="border-radius: 2rem;">
            <h2 class="font-weight-bold text-center">Prospectos del mes por Prospectador</h2>

            <figure class="ml-5 ml-md-0">
                <div id="mesProspectadores"></div>
            </figure>
        </div>
</section>

