<div class="show-session-promotor">
    <div class="sesion-parte-superior">
        @if ($session->event->image)
            @php
                $images = json_decode($session->event->image);
            @endphp
            @if (!empty($images))
            @if(env('API_LOCAL'))
                    <img class="imagen-sesion-promotor" src="http://127.0.0.1:9000/api/images/retrieve/medium/{{json_decode($session->event->image)[0]}}" alt=""
                        loading="lazy">
                @else
                <img class="imagen-sesion-promotor" src="http://10.2.129.105:8080/api/images/retrieve/medium/{{json_decode($session->event->image)[0]}}" alt=""
                        loading="lazy">
                @endif
            @else
                <img class="imagen-sesion-promotor" src="{{ asset('images/fotos-subidas/' . $session->event->image) }}"
                    alt="" loading="lazy">
            @endif
        @endif
        <div class="info-session-contenedor">
            <div class="info-session">
                <p class="info-session-titulo">{{ $session->event->name }}</p>
            </div>
            <div class="info-session">
                <img src="{{ asset('images/eventos/calendar.png') }}" alt="" height="25" loading="lazy">
                <p>{{ $session->date }}</p>
            </div>
            <div class="info-session">
                <img src="{{ asset('images/sesiones/ticket.png') }}" alt="" height="25" loading="lazy">
                <p>{{ $session->ticketsSold }}/{{ $session->maxCapacity }}</p>
            </div>
        </div>
        <div class="mostrar-acciones">
            <img class="imagen-mostar-acciones" src="{{ asset('images/sesiones/arrow-right.png') }}" alt=""
                loading="lazy">
        </div>
    </div>
    <div class="buttons-sessions-promotor">
        <button class="btnSesionesPromotor"
            onclick="window.location='{{ route('events.mostrar', ['id' => $session->event->id]) }}'">Mostar
            evento</button>
        <button class="btnSesionesPromotor">Administrar Evento</button>
        <button class="btnSesionesPromotor">Listado Entradas</button>
        <form class="form-sessiones" action="{{ route('sessions.promotor.cambiarEstado') }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="idSesion" value="{{ $session->id }}">
            @if ($session->open)
                <button class="btnSesionesPromotor">Cerrar sesion</button>
            @else
                <button class="btnSesionesPromotor">Abrir sesion</button>
            @endif
        </form>
    </div>
    <div class="btnCSVcontainer">
        <a href="{{ route('sessions.download.csv', ['id' => $session->id]) }}" class="btnDownloadCSV">
            <button><img src="{{ asset('images/sesiones/download.png') }}" alt="Botón de descarga del csv"
                    height="25" loading="lazy"></button>
        </a>
    </div>
</div>
