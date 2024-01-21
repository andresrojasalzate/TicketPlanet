<div class="category-home">
   <p>{{$nombreCategoria}}</p>
   <div class="events-category-home">
   @foreach ($events as $event)
        <x-event-component :event="$event"/>
   @endforeach        
   </div>
   <form  class="ver-mas-button"action="{{ route('events.category') }}" method="get">
      @csrf
      <input type="hidden" name="category" value="{{$categoryId}}">
      <button class="botonBuscador" type="submit">Ver más</button>
   </form>
</div>