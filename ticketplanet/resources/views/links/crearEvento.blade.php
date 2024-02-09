
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styleSASS.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <header>
        <x-header/>
    </header>
    <div class="contenedorLayout">
        <form action="{{ route('links.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="div1">
                <div class="parte1formulario">

                    <label for="title">Titulo</label>
                    <input type="text" name="name" id="title"
                        value="{{ isset($evento) ? $evento->name : old('name') }}">

                    @error('name')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                    <br>
                    <label for="Categoria">Categoria</label>

                    <select name="categoria">
                        @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ isset($evento) && $evento->category_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->name }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="parte2formulario">
                    <div class="formularioDescripcion">

                        <label for="Descripcion Esdeveniment">Descripcion Esdeveniment</label>
                        <input type="text" name="description" id="descripcioEsdeveniment"
                            value="{{ isset($evento) ? $evento->description : old('description') }}">
                        <br>
                        @error('description')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioImagen">
                        <label for="Imagen Principal de l'esdeveniment">Imagen principal</label>
                        <input type="file" name="image" id="imagenEsdeveniment" value="{{ isset($evento) ? $evento->image : old('image') }}">

                        @error('image')
                            <small style="color: red">{{ $message }}</small>
                        @enderror

                        <!-- Mostrar la imagen si ya está definida -->
                        @if (isset($evento) && $evento->image)
                            <img src="{{ asset('images/fotos-subidas/' . $evento->image) }}"
                                alt="Imagen principal" width="150" loading="lazy">
                        @endif

                    </div>

                </div>

                <div class="parte3formulario">

                    <div class="formularioAdreca">

                        <label for="numeroDireccion">Numero Direccion | Codigo Postal | Provincia</label>
                        <input type="text" name="address" list="addresses" id="numeroDireccion"
                            value="{{ isset($evento) ? $evento->address : old('address') }}">
                        <datalist id="addresses">
                            @foreach ($addresses as $address)
                                <option>{{ $address->address }}</option>
                            @endforeach
                        </datalist>

                        @error('address')
                            <small style="color: red">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                <div class="parteEntradasFormulario">

                    <div class="entradasVisibles">

                        <label for="entradasVisibles">Entradas Visibles</label>

                    </div>
                    <div class="entradasVisiblesEleccion">

                        <div>

                            <input type="radio" name="visible"
                                value="true"{{ (isset($evento) && $evento->visible == 'true') || old('visible') == 'true' ? 'checked' : '' }}>Si

                        </div>

                        <div>

                            <input type="radio" name="visible"
                                value="false"{{ (isset($evento) && $evento->visible == 'false') || old('visible') == 'false' ? 'checked' : '' }}yy>No

                        </div>
                    </div>
                    @error('visible')
                        <small style="color: red; display:flex;justify-content:center">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="div2">
                <div class="parte4formulario">

                    <div class="formularioNombreLocal">

                        <label for="Nombre del local">Nombre del Local</label>
                        <input class="formularioNombreLocalInput" type="text" list="nameSites" name="name_site"
                            id="nombreLocal" value="{{ isset($evento) ? $evento->name_site : old('name_site') }}">
                        <datalist id="nameSites">
                            @foreach ($nameSites as $nameSite)
                                <option>{{ $nameSite->name_site }}</option>
                            @endforeach
                        </datalist>
                        <br>
                        @error('name_site')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioCapacidadLocal">

                        <label for="Capacidad del local">Capacidad del local</label>
                        <input class="formularioCapacidadLocalInput" type="number" list="capacitys" name="capacity"
                            id="capacidadLocal" min="1"
                            value="{{ isset($evento) ? $evento->capacity : old('capacity') }}">
                        <datalist id="capacitys">
                            @foreach ($capacitys as $capacity)
                                <option>{{ $capacity->capacity }}</option>
                            @endforeach
                        </datalist>
                        <br>
                        @error('capacity')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>


                </div>

                <div class="parte5formulario">

                    <div class="formularioCiudad">

                        <label for="Ciudad">Ciudad</label>
                        <input class="formularioCiudadInput" type="text" list="citys" name="city" id="ciudad"
                            value="{{ isset($evento) ? $evento->city : old('city') }}">
                        <datalist id="citys">
                            @foreach ($citys as $city)
                                <option>{{ $city->city }}</option>
                            @endforeach
                        </datalist>
                        @error('city')
                            <small style="color: red">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="formularioFechaFin">

                        <label for="fechaFin">Fecha Fin</label>
                        <input class="formularioFechaFinInput" type="date" name="finishDate" id="fechaFin" min="<?php echo date('Y-m-d'); ?>"
                            value="{{ isset($evento) ? $evento->finishDate : old('finishDate') }}">

                        @error('finishDate')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioHoraFin">

                        <label for="horaFin">Hora Fin</label>
                        <input class="formularioHoraFinInput" type="time" name="finishTime" id="HoraFin"
                            value="{{ isset($evento) ? $evento->finishTime : old('finishTime') }}">

                        @error('finishTime')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="parte6formulario">

                    <div class="formularioFechaCelebracion">

                        <label for="Fecha celebracion">Fecha celebracion</label>
                        <input class="formularioFechaCelebracionInput" type="date" name="date" min="<?php echo date('Y-m-d'); ?>"
                            id="fechaCelebracion" value="{{ isset($sesion) ? $sesion->date : old('date') }}">
                        <br>
                        @error('date')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioHoraCelebracion">

                        <label for="Hora celebracion">Hora celebracion</label>
                        <input class="formularioHoraCelebracionInput" type="time" name="time"
                            id="horaCelebracion" value="{{ isset($sesion) ? $sesion->time : old('time') }}">
                        <br>
                        @error('time')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioAforoMaximo">

                        <label for="Aforo Maximo">Aforo Maximo</label>
                        <input class="formularioAforoMaximoInput" type="number" name="maxCapacity" id="aforoMaximo"
                            min="1" value="{{ isset($sesion) ? $sesion->maxCapacity : old('maxCapacity') }}">
                        <br>
                        @error('maxCapacity')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>



                </div>
                <div class="botones">

                    <button class="btnGuardarEntradas" type="submit">
                        {{ isset($evento) ? 'Editar Evento' : 'Crear Evento' }}
                    </button>
                </div>
            </div>

        </form>

    </div>
    <footer>
        <x-footer/>
    </footer>
</body>

</html>
