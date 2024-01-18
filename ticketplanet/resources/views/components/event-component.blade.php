<a href="{{ route('events.mostrar', ['id' => $event->id]) }}">
<div class="show-event-home">
    <img class="show-event-home-img" src="{{ $event->image }}" alt="">
        <p class="show-event-home-title">{{ $event->name }}</p>
        <div class="elementsEvents">
        <p><img src="images/eventos/location.png" alt="" height="25">{{ $event->site }}</p>
        <p><img src="images/eventos/calendar.png" alt="" height="25">{{ $event->sessions[0]->date }}</p>
        <p><img src="images/eventos/precio.png" alt="" height="25">Desde&nbsp;<strong>{{ $event->sessions[0]->price }}€</strong>
        </p>
    </div>
</div>
</a>