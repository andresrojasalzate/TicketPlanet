<div class="contenedorBuscador">
      <form class="form-buscador" action="{{ route('events.search') }}" method="get">
        @csrf
        <img class="imagenLupa" src="{{ asset('images/buscador/lupa.png') }}" alt="" height="30">
            <input class="buscador" type="search" name="busqueda" placeholder="Buscar">
            <img id="filtro" class="imagenFiltrar" src="{{ asset('images/buscador/filter.png') }}" alt="" height="30">
            <button class="botonBuscador" type="submit">Buscar</button>
        <div class="div_filtro">
          <p>Filtrar por categoria:</p>
          <select class="filtro" name="category">
            <option value="" selected>Selecciona una opción</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id}}">{{ $category->name}}</option>
            @endforeach
          </select>
        </div>
      </form>
    </div>