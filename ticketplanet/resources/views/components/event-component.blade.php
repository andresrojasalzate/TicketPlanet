<div class="show-event-home">
    <img class="show-event-home-img" src="{{ $event->image }}" alt="">
    <div class="elementsEvents">
        <p class="show-event-home-title">{{ $event->name }}</p>
        <p><img src="images/eventos/location.png" alt="" height="25">{{ $event->site }}</p>
        <p><img src="images/eventos/calendar.png" alt="" height="25">{{ $event->sessions[0]->date }}</p>
        <p><img src="images/eventos/precio.png" alt="" height="25">Desde {{ $event->sessions[0]->price }}€
        </p>
    </div>
</div>
