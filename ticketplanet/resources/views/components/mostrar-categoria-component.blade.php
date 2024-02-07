<div class="category-home">
   <p>{{$nombreCategoria}}</p>
   <div class="category-home-events">
   @foreach ($events as $event)
        <x-event-component :event="$event"/>
   @endforeach        
   </div>
   <form  class="ver-mas-button"action="{{ route('events.category') }}" method="post">
      @csrf
      <input type="hidden" name="category" value="{{$categoryId}}">
      <button class="btnBuscador" type="submit">Ver más</button>
   </form>
</div>