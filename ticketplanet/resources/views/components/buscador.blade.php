<div class="buscadorContenedor">
    <form action="{{ route('events.search') }}" method="post">
        @csrf
        <div class="buscador-Form">

            <img class="imagenLupa" src="{{ asset('images/buscador/lupa.png') }}" alt="" height="30" loading="lazy">
            <img id="filtro" class="imagenFiltrar" src="{{ asset('images/buscador/filter.png') }}" alt=""
                height="30" loading="lazy">

            <input class="buscador" type="search" name="busqueda" placeholder="Buscar">
            <button class="btnBuscador" type="submit">Buscar</button>
        </div>

        <div class="filtro-div">
            <p>Filtrar por categoria:</p>
            <select class="filtro" name="category">
                <option value="" selected>Selecciona una opción</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>
