<div class="show-session-promotor"> 
    <div class="sesion-parte-superior">
        <img class="imagen-sesion-promotor" src="{{ asset('images/fotos-subidas/' . $session->event->image) }}" alt="">
        <div class="info-session-contenedor">
            <p>{{$session->event->name}}</p>
            <div class="info-session">
                <img src="images/eventos/calendar.png" alt="" height="25">
                <p>{{$session->date}}</p>
            </div>
            <div class="info-session">
                <img src="images/sesiones/ticket.png" alt="" height="25">
                <p>{{$session->ticketsSold}}/{{$session->maxCapacity}}</p>
            </div>  
        </div>
        <div class="mostrar-acciones">
            <img class="imagen-mostar-acciones" src="images/sesiones/arrow-right.png" alt="">
        </div>
    </div>
    <div class="buttons-sessions-promotor">
        <button onclick="window.location='{{ route('events.mostrar', ['id' => $session->event->id]) }}'">Mostar evento</button>
        <button>Administrar Evento</button>
        <button>Listado Entradas</button>
    </div>
</div>