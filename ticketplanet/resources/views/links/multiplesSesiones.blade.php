@extends('layouts.app')

@section('title', 'Crear Sesiones')

@section('content')
    <div class="contenedorLayout">
        <form action="{{ route('links.crearMultiplesSesiones', ['id' => $event->id])}}" method="post" enctype="multipart/form-data">
            @csrf
@if (session('error'))
    <div class="alert-danger">
        {{ session('error') }}
      <button type="button" class="cerrarFeedbackFallido">
     <span aria-hidden="true">&times;</span>
     </button>
   </div> 
@endif

            <div class="div1Sesion">

                <div class="parte6formularioSesion">

                    <div class="formularioFechaCelebracionSesion">

                        <label for="Fecha celebracion">Fecha celebracion</label>
                        <input class="formularioFechaCelebracionSesionInput" type="date" name="date" value="{{ $sessions->date }}"
                            id="fechaCelebracion">

                        @error('date')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioHoraCelebracionSesion">

                        <label for="Hora celebracion">Hora celebracion</label>
                        <input class="formularioHoraCelebracionSesionInput" type="time" name="time" value="{{ $sessions->time }}"
                            id="horaCelebracion">

                        @error('time')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="formularioAforoMaximoSesion">

                        <label for="Aforo Maximo">Aforo Maximo</label>
                        <input class="formularioAforoMaximoSesionInput" type="number" name="maxCapacity" id="aforoMaximo" min="1" value="{{ $sessions->maxCapacity }}">

                        @error('maxCapacity')
                            <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <button class="btnCrearSesion" type="submit" >Crear Sesion</button>

                </div>

            </div>

        </form>
        
    </div>
    <script src="{{ asset('js/session.js') }}"></script>
@endsection
