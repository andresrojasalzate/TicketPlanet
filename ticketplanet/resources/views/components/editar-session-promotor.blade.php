<div class="show-session-promotor"> 
  <div class="sesion-parte-superior">
      <img class="imagen-sesion-promotor" src="{{ asset('images/fotos-subidas/' . $session->event->image) }}" alt="">
      <div class="info-session-contenedor">
          <div class="info-session">
              <p class="titulo-mostar-sesion-promotor">{{$session->event->name}}</p>
          </div>   
          <div class="info-session">
              <img src="{{ asset('images/eventos/calendar.png') }}" alt="" height="25">
              <p>{{$session->date}}</p>
          </div>
          <div class="info-session">
              <img src="{{ asset('images/sesiones/ticket.png') }}" alt="" height="25">
              <p>{{$session->ticketsSold}}/{{$session->maxCapacity}}</p>
          </div>  
      </div>
      <div class="mostrar-acciones">
          <img class="imagen-mostar-acciones" src="{{ asset('images/sesiones/arrow-right.png') }}" alt="">
      </div>
  </div>
  <div class="buttons-sessions-promotor">
      <button onclick="window.location='{{ route('links.sesionesEventoEditar', ['id' => $session->id]) }}'">Editar Sesion</button>
  </div>
</div>