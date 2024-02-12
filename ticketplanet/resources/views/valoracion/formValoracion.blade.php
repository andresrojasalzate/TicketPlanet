<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div id="formulario-container" class="card-form-valoracion">
    <h1>Deja tu opinión</h1>
    @if ($errors->any())
        <div class="credenciales">
        
                @foreach ($errors->all() as $error)
                   <p>{{ $error }}</p>
                @endforeach
          
        </div>
    @endif
    <form method="POST" action="{{ route('guardarValoracion') }}">
        @csrf
        <input type="hidden" name="evento_id" value="{{ $eventoId }}">

        <label>Nombre</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label>Que te ha parecido?</label>
        <div class="ratingSmile">
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceBad.png') }}" width="60" loading="lazy">
                <input type="radio" name="caraSeleccionada" value="faceBad">
            </div>
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceBd.png') }}" width="60" loading="lazy">
                <input type="radio" name="caraSeleccionada" value="faceBd">
            </div>
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceRegular.png') }}" width="60" loading="lazy">
                <input type="radio" name="caraSeleccionada" value="faceRegular">
            </div>
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceGood.png') }}" width="60" loading="lazy">
                <input type="radio" name="caraSeleccionada" value="faceGood">
            </div>
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceVeryGood.png') }}" width="60" loading="lazy">
                <input type="radio" name="caraSeleccionada" value="faceVeryGood">
            </div>
        </div><br>

        <label>Puntuación</label><br>
        <div class="rating">
            <input type="hidden" name="puntuacionSeleccionada" id="puntuacionSeleccionada">
            <img src="{{ asset('images/valoracion/star/starNegra.png') }}" width="60" loading="lazy" 
                onclick="seleccionarPuntuacion(1)">
            <img src="{{ asset('images/valoracion/star/starNegra.png') }}" width="60" loading="lazy" 
                onclick="seleccionarPuntuacion(2)">
            <img src="{{ asset('images/valoracion/star/starNegra.png') }}" width="60" loading="lazy" 
                onclick="seleccionarPuntuacion(3)"> 
            <img src="{{ asset('images/valoracion/star/starNegra.png') }}" width="60" loading="lazy" 
                onclick="seleccionarPuntuacion(4)">
            <img src="{{ asset('images/valoracion/star/starNegra.png') }}" width="60" loading="lazy" 
                onclick="seleccionarPuntuacion(5)">
        </div><br>

        <label>Título del comentario</label><br>
        <input type="text" id="tituloComentario" name="tituloComentario"><br><br>

        <label>Comentario</label><br>
        <textarea id="comentario" name="comentario"></textarea><br><br>

        <button class="btnEnviarValoracion" type="submit" value="Enviar">Enviar</button>
    </form>
</div>
<div id="agradecimiento-container" class="card-form-valoracion" style="{{ session('valoracionGuardada') ? '' : 'display: none;' }}">
    <h2>¡Gracias por compartir tu opinión!</h2>
</div>


<script>
    function seleccionarCara(valor) {
        // Obtener todos los radios
        let radios = document.getElementsByName('caraSeleccionada');
        // Recorrer los radios y establecer el valor del radio seleccionado
        for (let i = 0; i < radios.length; i++) {
            if (radios[i].value === valor) {
                radios[i].checked = true;
            }
        }
    }

    function seleccionarPuntuacion(valor) {
        document.getElementById('puntuacionSeleccionada').value = valor;
        // Obtener todas las imágenes de las estrellas
        let estrellas = document.querySelectorAll('.rating img');
        // Cambiar la imagen de las estrellas hasta el índice seleccionado
        for (let i = 0; i < estrellas.length; i++) {
            if (i < valor) {
                estrellas[i].src = "{{ asset('images/valoracion/star/star1-4.png') }}";
            } else {
                estrellas[i].src = "{{ asset('images/valoracion/star/starNegra.png') }}";
            }
        }
    }

    // Obtener el formulario y el mensaje de agradecimiento por su ID
    const formulario = document.getElementById('formulario-container');
    const agradecimiento = document.getElementById('agradecimiento-container');

    // Verificar si se ha guardado la valoración con éxito
    @if(session('valoracionGuardada'))
        formulario.style.display = 'none';
        agradecimiento.style.display = 'block';
    @endif
</script>
