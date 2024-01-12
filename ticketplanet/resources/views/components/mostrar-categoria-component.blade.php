<div class="category-home">
   <p>{{$nombreCategoria}}</p>
   <div class="events-category-home">
   @foreach ($events as $event)
        <x-event-component :event="$event"/>
   @endforeach        
   <form action="{{ route('events.category') }}" method="post">
      @csrf
      <input type="hidden" name="category" value="{{$categoryId}}">
      <button class="botonBuscador" type="submit">ver mas</button>
   </form>
     
   </a>
   </div>
</div>