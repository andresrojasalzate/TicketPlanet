<div class="category-home">
   <p>{{$nombreCategoria}}</p>
   <div class="events-category-home">
   @foreach ($events as $event)
        <x-event-component :event="$event"/>
   @endforeach        
   
   <button class="botonBuscador">ver mas</button>
   </div>
</div>