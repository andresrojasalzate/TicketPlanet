<div class="show-event-home">
    <a href="{{ route('events.mostrar', ['id' => $event->id]) }}">
        <div class="show-event-home-img">
            @if ($event->image)
                @php
                    $images = json_decode($event->image);
                @endphp
                @if (!empty($images))
                    <img src="{{ asset('images/fotos-subidas/' . json_decode($event->image)[0]) }}" alt="" loading="lazy">
                @endif
            @endif
        </div>
        <p class="show-event-home-title">{{ $event->name }}</p>
        <div class="elementsEvents">
            <div class="elementsEvents-direccion">
                <img src="{{ asset('images/eventos/location.png') }}" alt="" height="25" loading="lazy">
                <p>{{ $event->address }},
                    {{ $event->city }}, {{ $event->name_site }}</p>
            </div>
            @if (count($event->sessions) > 0)
                <p><img src="{{ asset('images/eventos/calendar.png') }}" alt="" height="25"
                        loading="lazy">{{ $event->sessions[0]->date }}</p>
            @endif
            @if (count($event->tickets) > 0)
                <p><img src="{{ asset('images/eventos/precio.png') }}" alt="" height="25"
                        loading="lazy">Desde&nbsp;<strong>{{ $event->tickets[0]->price }}€</strong>
                </p>
            @endif
        </div>
    </a>
</div>
