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
    {{-- @extends('layouts.app')

@section('title', 'Eventos del Promotor')

@section('content') --}}
    <div class="contenedorLayout">
        <form action="{{ route('links.crearMultiplesSesiones', ['id' => $event->id])}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="div1Sesion">

                <div class="parte6formularioSesion">

                    <div class="formularioFechaCelebracionSesion">

                        <label for="Fecha celebracion">Fecha celebracion</label>
                        <input class="formularioFechaCelebracionSesionInput" type="date" name="date" value="{{ old('date') }}"
                            id="fechaCelebracion">

                        @error('date')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioHoraCelebracionSesion">

                        <label for="Hora celebracion">Hora celebracion</label>
                        <input class="formularioHoraCelebracionSesionInput" type="time" name="time" value="{{ old('time') }}"
                            id="horaCelebracion">

                        @error('time')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioAforoMaximoSesion">

                        <label for="Aforo Maximo">Aforo Maximo</label>
                        <input class="formularioAforoMaximoSesionInput" type="number" name="maxCapacity" id="aforoMaximo" min="1" value="{{ old('maxCapacity') }}">

                        @error('maxCapacity')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <button class="btnCrearSesion" type="submit" >Crear Sesion</button>

                </div>

            </div>

        </form>
        
    </div>

    
    <footer>
        <x-footer />
    </footer>
</body>

</html>

{{-- @endsection --}}
