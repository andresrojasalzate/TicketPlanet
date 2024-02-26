<div class="show-session-promotor"> 
    <div class="sesion-parte-superior">
        {{-- <img class="imagen-sesion-promotor" src="{{ asset('images/fotos-subidas/' . $session->event->image) }}" alt="" loading="lazy"> --}}
        @if ($session->event->image)
            @php
                $images = json_decode($session->event->image);
            @endphp
            @if (!empty($images))
                <img class="imagen-sesion-promotor" src="{{ asset('images/fotos-subidas/' . json_decode($session->event->image)[0]) }}" alt=""
                    loading="lazy">
            @else
                <img class="imagen-sesion-promotor" src="{{ asset('images/fotos-subidas/' . $session->event->image) }}" alt="" loading="lazy">
            @endif
        @endif
        <div class="info-session-contenedor">
            <div class="info-session">
                <p class="info-session-titulo">{{$session->event->name}}</p>
            </div>   
            <div class="info-session">
                <img src="{{ asset('images/eventos/calendar.png') }}" alt="" height="25" loading="lazy">
                <p>{{$session->date}}</p>
            </div>
            <div class="info-session">
                <img src="{{ asset('images/sesiones/ticket.png') }}" alt="" height="25" loading="lazy">
                <p>{{$session->ticketsSold}}/{{$session->maxCapacity}}</p>
            </div>  
        </div>
        <div class="mostrar-acciones">
            <img class="imagen-mostar-acciones" src="{{ asset('images/sesiones/arrow-right.png') }}" alt="" loading="lazy">
        </div>
    </div>
    <div class="buttons-sessions-promotor">
        <button class="btnSesionesPromotor" onclick="window.location='{{ route('events.mostrar', ['id' => $session->event->id]) }}'">Mostar evento</button>
        <button class="btnSesionesPromotor">Administrar Evento</button>
        <button class="btnSesionesPromotor">Listado Entradas</button>
    </div>
</div>