<div class="contenedorBuscador">
      <form class="form-buscador" action="{{ route('events.search') }}" method="post">
        @csrf
        <img class="imagenLupa" src="images/buscador/lupa.png" alt="" height="30">
            <input class="buscador" type="search" name="busqueda" placeholder="Buscar">
            <img id="filtro" class="imagenFiltrar" src="images/buscador/filter.png" alt="" height="30">
            <button class="botonBuscador" type="submit">Buscar</button>
        <div class="div_filtro">
          <p>Filtrar por categoria:</p>
          <select class="filtro" name="category">
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="musica">Musica</option>
            <option value="teatro">Teatro</option>
            <option value="cine">Cine</option>
          </select>
        </div>
      </form>
    </div>