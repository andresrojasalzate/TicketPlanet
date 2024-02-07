<div class="show-event-home">
    <a href="{{ route('events.mostrar', ['id' => $event->id]) }}">
        <img class="show-event-home-img" src="{{ asset('images/fotos-subidas/' . $event->image) }}" alt="">
        <p class="show-event-home-title">{{ $event->name }}</p>
        <div class="elementsEvents">
            <div class="elementsEvents-direccion">
                <img src="{{ asset('images/eventos/location.png') }}" alt="" height="25">
                <p>{{ $event->address }},
                {{ $event->city }}, {{ $event->name_site }}</p>
            </div>
           
            <p><img src="{{ asset('images/eventos/calendar.png') }}" alt=""
                    height="25">{{ $event->sessions[0]->date }}</p>
            <p><img src="{{ asset('images/eventos/precio.png') }}" alt=""
                    height="25">Desde&nbsp;<strong>{{ $event->tickets[0]->price }}€</strong>
            </p>
            
        </div>
    </a>
</div>
