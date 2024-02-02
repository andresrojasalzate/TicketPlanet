<div class="show-event-home">
  <div class="btneditEvent">
    <a href="{{ route('links.multiplesSesiones',['id' => $event->id]) }}">

      <img src="{{ asset('images/eventos/edit.png') }}" alt="Editar evento" height="30">

    </a>
  </div>
  <a href="{{ route('events.mostrar', ['id' => $event->id]) }}">
      <img class="show-event-home-img" src="{{ asset('images/fotos-subidas/' . $event->image) }}" alt="">
      <p class="show-event-home-title">{{ $event->name }}</p>

      <div class="elementsEvents">
          <p><img src="{{ asset('images/eventos/location.png') }}" alt=""
                  height="25">{{ $event->address }},
              {{ $event->city }}, {{ $event->name_site }}</p>
          <p><img src="{{ asset('images/eventos/calendar.png') }}" alt=""
                  height="25">{{ $event->sessions[0]->date }}</p>
          <p><img src="{{ asset('images/eventos/precio.png') }}precio.png" alt=""
                  height="25">Desde&nbsp;<strong>{{ $event->tickets[0]->price }}€</strong>
          </p>

      </div>
  </a>
</div>
