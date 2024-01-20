<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon/logoFavicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <header>
        <x-header />
    </header>
    <div class="contenedorLayout">
        <form action="{{ route('links.store') }}" method="post">
            @csrf
            <div class="div1">
                <div class="parte1formulario">

                    <label for="title">Titulo</label>
                    <input type="text" name="name" id="title" value="{{old('name')}}">
                  
                  @error('name')
                  <small style="color: red">{{$message}}</small>
                  @enderror

                    <label for="Categoria">Categoria</label>

                    <select name="categoria">
                      @foreach ($categorias as $categoria)
                          <option value=" {{$categoria->id}} ">{{$categoria->name}} </option>
                      @endforeach
                    </select>
                </div>


                <div class="parte2formulario">
                    <div class="descripcionFormulario">

                        <label for="Descripcion Esdeveniment">Descripcion Esdeveniment</label>
                        <input class="descripcionFormularioInput" type="text" name="description"
                            id="descripcioEsdeveniment" value="{{old('description')}}">
                            <br>
                            @error('description')
                            <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>

                      <div class="imagenFormulario">
                      <label for="Imagen Principal de l'esdeveniment">Imagen principal de l'esdeveniment</label>
                      <input type="file" name="image" id="imagenEsdeveniment" value="{{old('image')}}">
                        
                      @error('image')
                      <small style="color: red">{{$message}}</small>
                  @enderror

                    </div>
                    
                </div>

                <div class="parte3formulario">

                  <div class="adrecaFormulario">

                    <label for="numeroDireccion">Numero Direccion Codigo Postal Provincia</label>
                    <input type="text" name="address" list="addresses" id="numeroDireccion" value="{{old('address')}}">
                    <datalist id="addresses">
                            @foreach ($addresses as $address)
                                <option>{{$address->address}}</option>
                            @endforeach
                        </datalist>

                        @error('address')
                        <small style="color: red">{{$message}}</small>
                    @enderror

                </div>

                </div>

                <div class="parteEntradasFormulario">

                  <div class="entradasVisibles">

                    <label for="entradasVisibles">Entradas Visibles</label>
            
                  </div>
                  <div class="entradasVisiblesEleccion">
            
                    <div class="eleccionSi">
            
                      <input type="radio" name="visible" value="true"{{old('visible') == 'true' ? 'checked' : ''}}>Si
            
                    </div>
            
                    <div class="eleccionNo">
            
                      <input type="radio" name="visible" value="false"{{old('visible') == 'false' ? 'checked' : ''}}>No
            
                    </div>
                  </div>
                  @error('visible')
                  <small style="color: red">{{$message}}</small>
              @enderror
            </div>
            </div>

            <div class="div2">
                <div class="parte4formulario">

                    <div class="nombreLocalFormulario">

                        <label for="Nombre del local">Nombre del Local</label>
                        <input class="nombreLocalFormularioInput" type="text" list="nameSites" name="name_site" id="nombreLocal" value="{{old('name_site')}}">
                        <datalist id="nameSites">
                            @foreach ($nameSites as $nameSite)
                                <option>{{$nameSite->name_site}}</option>
                            @endforeach
                        </datalist>
                        <br>
                        @error('name_site')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    </div>

                    <div class="capacidadLocalFormulario">

                        <label for="Capacidad del local">Capacidad del local</label>
                        <input class="capacidadLocalFormularioInput" type="number" list="capacitys" name="capacity"
                            id="capacidadLocal" value="{{old('capacity')}}">
                        <datalist id="capacitys">
                            @foreach ($capacitys as $capacity)
                                <option>{{$capacity->capacity}}</option>
                            @endforeach
                        </datalist>
                        <br>
                        @error('capacity')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    </div>


                </div>

                <div class="parte5formulario">

                    <div class="ciudadFormulario">

                        <label for="Ciudad">Ciudad</label>
                        <input class="ciudadFormularioInput" type="text" list="citys" name="city" id="ciudad" value="{{old('city')}}">
                        <datalist id="citys">
                            @foreach ($citys as $city)
                                <option>{{$city->city}}</option>
                            @endforeach
                        </datalist>
                        @error('city')
                        <small style="color: red">{{$message}}</small>
                    @enderror

                    </div>
                    <div class="fechaFinFormulario">

                      <label for="fechaFin">Fecha Fin</label>
                      <input class="fechaFinFormularioInput" type="date" name="finishDate" id="fechaFin" value="{{old('finishDate')}}">

                      @error('finishDate')
                      <small style="color: red">{{$message}}</small>
                  @enderror
                  </div>
  
                  <div class="horaFinFormulario">
  
                    <label for="horaFin">Hora Fin</label>
                    <input class="HoraFinFormularioInput" type="time" name="finishTime" id="HoraFin" value="{{old('finishTime')}}">
                    
                    @error('finishTime')
                    <small style="color: red">{{$message}}</small>
                @enderror
                </div>

                </div>

                <div class="parte6formulario">

                    <div class="fechaCelebracionFormulario">

                        <label for="Fecha celebracion">Fecha celebracion</label>
                        <input class="fechaCelebracionFormularioInput" type="date" name="date"
                            id="fechaCelebracion" value="{{old('date')}}">

                            @error('date')
                            <small style="color: red">{{$message}}</small> 
                        @enderror
                    </div>

                    <div class="horaCelebracionFormulario">

                        <label for="Hora celebracion">Hora celebracion</label>
                        <input class="horaCelebracionFormularioInput" type="time" name="time"
                            id="horaCelebracion" value="{{old('time')}}">

                            @error('time')
                            <small style="color: red">{{$message}}</small> 
                        @enderror
                    </div>

                    <div class="aforoMaximoFormulario">

                        <label for="Aforo Maximo">Aforo Maximo</label>
                        <input class="aforoMaximoFormularioInput" type="number" name="maxCapacity" id="aforoMaximo" value="{{old('maxCapacity')}}">

                        @error('maxCapacity')
                       <small style="color: red">{{$message}}</small> 
                    @enderror
                    </div>



                </div>
                <div class="botones">

                  <button class="btnGuardarEntradas" type="button">Entradas</button>
                  <button class="btnGuardarEntradas" type="submit">Guardar Evento</button>
                  
                </div>

            </div>





        </form>
        <a href="{{ route('links.comprarEntradas') }}">Entradas</a>
    </div>
    <footer>
        <x-footer />
    </footer>
</body>

</html>
