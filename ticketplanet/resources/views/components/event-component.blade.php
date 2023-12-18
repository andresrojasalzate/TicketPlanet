<div class="show-event-home">
    <img src="{{ $event->image }}" alt="">
    <p>{{ $event->name }}</p>
    <p>{{ $event->site }}</p>
    <p>{{ $event->sessions[0]->date }}</p>
    <p>{{ $event->sessions[0]->price }}</p>
</div>