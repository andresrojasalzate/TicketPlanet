<div class="show-event-home">
    <div class="btneditEvent">
        <a href="{{ route('links.editarEvento', ['id' => $event->id]) }}">
            <img src="{{ asset('images/eventos/edit.png') }}" alt="Editar evento" height="30" loading="lazy">
        </a>
    </div>
    <a href="{{ route('events.mostrar', ['id' => $event->id]) }}">
        <div class="show-event-home-img">
            @if ($event->image)
                @php
                    $images = json_decode($event->image);
                @endphp
                @if (!empty($images))
                @if(env('API_LOCAL'))
                    <img src="http://127.0.0.1:9000/api/images/retrieve/medium/{{json_decode($event->image)[0]}}" alt=""
                        loading="lazy">
                @else
                <img src="http://10.2.129.105:8080/api/images/retrieve/medium/{{json_decode($event->image)[0]}}" alt=""
                        loading="lazy">
                @endif
                @else
                    <img src="{{ asset('images/fotos-subidas/' . $event->image) }}" alt="" loading="lazy">
                @endif
            @endif
        </div>
        
        <p class="show-event-home-title">{{ $event->name }}</p>

        <div class="elementsEvents">
            <p><img src="{{ asset('images/eventos/location.png') }}" alt=""
                    height="25" loading="lazy">{{ $event->address }},
                {{ $event->city }}, {{ $event->name_site }}</p>
            @if (count($event->sessions) > 0)
                <p><img src="{{ asset('images/eventos/calendar.png') }}" alt=""
                        height="25" loading="lazy">{{ $event->sessions[0]->date }}</p>
            @endif
            @if (count($event->tickets) > 0)
                <p><img src="{{ asset('images/eventos/precio.png') }}" alt=""
                        height="25" loading="lazy">Desde&nbsp;<strong>{{ $event->tickets[0]->price }}€</strong>
                </p>
            @endif
        </div>
    </a>
</div>
