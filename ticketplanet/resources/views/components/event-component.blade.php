<div class="show-event-home">
    <a href="{{ route('events.mostrar', ['id' => $event->id]) }}">
        <div class="show-event-home-img">
            <img  src="{{ asset('images/fotos-subidas/' . $event->image) }}" alt="">
        </div>
        <p class="show-event-home-title">{{ $event->name }}</p>
        <div class="elementsEvents">
            <p><img src="{{ asset('images/eventos/location.png') }}" alt="" height="25">{{ $event->address }},
                {{ $event->city }}, {{ $event->name_site }}</p>
            @if (count($event->sessions) > 0)
                <p><img src="{{ asset('images/eventos/calendar.png') }}" alt=""
                        height="25">{{ $event->sessions[0]->date }}</p>
            @endif
            @if (count($event->tickets) > 0)
                <p><img src="{{ asset('images/eventos/precio.png') }}" alt=""
                        height="25">Desde&nbsp;<strong>{{ $event->tickets[0]->price }}€</strong>
                </p>
            @endif
        </div>
    </a>
</div>
