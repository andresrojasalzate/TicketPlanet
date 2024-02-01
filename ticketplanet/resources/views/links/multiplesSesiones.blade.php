<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styleSASS.css') }}">
</head>

<body>
    <header>
        <x-header />
    </header>
    <div class="contenedorLayout">
        <form action="{{ route('links.crearMultiplesSesiones', ['id' => $event->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="div1">
                <div class="parte1formulario">

                    <label for="title">Titulo</label>
                    
                    <input class="readonly-field" type="text" name="name" id="title" readonly value="{{ $event->name }}">
                  
                    @error('name')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                    <br>
                    <label for="Categoria">Categoria</label>

                      <input class="readonly-field" type="text" readonly value="{{ $event->category->name }}">
                </div>


                <div class="parte2formulario">
                  <div class="formularioDescripcion">

                        <label for="Descripcion Esdeveniment">Descripcion Esdeveniment</label>
                        <input class="readonly-field"  type="text" name="description"
                            id="descripcioEsdeveniment" readonly value="{{ $event->description }}">
                        <br>
                        @error('description')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioImagen">
                      <label for="Imagen Principal de l'esdeveniment">Imagen principal</label>
                      <img src="{{ asset('../../public/images/fotos/subidas' . $event->image) }}" alt="Imagen principal" width="200">

                        @error('image')
                            <small style="color: red">{{ $message }}</small>
                        @enderror

                    </div>

                </div>

                <div class="parte3formulario">

                  <div class="formularioAdreca">

                        <label for="numeroDireccion">Numero Direccion | Codigo Postal | Provincia</label>
                        <input class="readonly-field" type="text" name="address" list="addresses" id="numeroDireccion" readonly
                        value="{{ $event->address }}">

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

                          <input type="radio" name="visible" value="true" {{ $event->visible == true ? 'checked' : '' }} disabled>
                          <label for="visible_true">Si</label>

                        </div>

                        <div>

                          <input type="radio" name="visible" value="false" {{ $event->visible == false ? 'checked' : '' }} disabled>
                          <label for="visible_false">No</label>
                        </div>
                    </div>
                    @error('visible')
                        <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="div2">
                <div class="parte4formulario">

                    <div class="formularioNombreLocal">

                        <label for="Nombre del local">Nombre del Local</label>
                        <input class="formularioNombreLocalInput readonly-field" type="text" list="nameSites" name="name_site" id="nombreLocal" readonly value="{{ $event->name_site }}">
                        <br>
                        @error('name_site')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioCapacidadLocal">

                        <label for="Capacidad del local">Capacidad del local</label>
                        <input class="formularioCapacidadLocalInput readonly-field" type="number" list="capacitys" name="capacity" readonly
                            id="capacidadLocal"  value="{{ $event->capacity }}">
                        <br>
                        @error('capacity')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>


                </div>

                <div class="parte5formulario">

                    <div class="formularioCiudad">

                        <label for="Ciudad">Ciudad</label>
                        <input class="formularioCiudadInput readonly-field" type="text" list="citys" name="city" id="ciudad" readonly value="{{ $event->city }}">
                        @error('city')
                            <small style="color: red">{{ $message }}</small>
                        @enderror

                    </div>
                    <div class="formularioFechaFin">

                        <label for="fechaFin">Fecha Fin</label>
                        <input class="formularioFechaFinInput readonly-field" type="date" name="finishDate" id="fechaFin" readonly value="{{ $event->finishDate }}">

                        @error('finishDate')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioHoraFin">

                        <label for="horaFin">Hora Fin</label>
                        <input class="formularioHoraFinInput readonly-field" type="time" name="finishTime" id="HoraFin"
                         readonly value="{{ $event->finishTime }}">

                        @error('finishTime')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="parte6formulario">

                    <div class="formularioFechaCelebracion">

                        <label for="Fecha celebracion">Fecha celebracion</label>
                        <input class="formularioFechaCelebracionInput" type="date" name="date"
                            id="fechaCelebracion" value="{{ $sessions->date }}">

                        @error('date')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioHoraCelebracion">

                        <label for="Hora celebracion">Hora celebracion</label>
                        <input class="formularioHoraCelebracionInput" type="time" name="time"
                            id="horaCelebracion" value="{{ $sessions->time }}">

                        @error('time')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioAforoMaximo">

                        <label for="Aforo Maximo">Aforo Maximo</label>
                        <input class="formularioAforoMaximoInput" type="number" name="maxCapacity" id="aforoMaximo" value="{{ $sessions->maxCapacity }}">

                        @error('maxCapacity')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>



                </div>
                <div class="botones">

                    <button class="btnGuardarEntradas" type="submit" >Crear Evento</button>

                </div>

            </div>

        </form>
        
    </div>
    <footer>
        <x-footer />
    </footer>
</body>

</html>
