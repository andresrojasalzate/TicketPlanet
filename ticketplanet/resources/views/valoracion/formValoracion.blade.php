<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="card-form-valoracion">
    <h1>Deja tu opinión</h1>
    <form method="POST" action="{{ route('guardarValoracion') }}">
        @csrf
        <label>Nombre</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label>Que te ha parecido?</label>
        <div class="ratingSmile">
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceBad.png') }}" width="60">
                <input type="radio" name="caraSeleccionada" value="muy_mal">
            </div>
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceBd.png') }}" width="60">
                <input type="radio" name="caraSeleccionada" value="mal">
            </div>
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceRegular.png') }}" width="60">
                <input type="radio" name="caraSeleccionada" value="regular">
            </div>
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceGood.png') }}" width="60">
                <input type="radio" name="caraSeleccionada" value="bueno">
            </div>
            <div class="ratingSmileRadio">
                <img src="{{ asset('images/valoracion/faces/faceVeryGood.png') }}" width="60">
                <input type="radio" name="caraSeleccionada" value="muy_bueno">
            </div>
        </div><br>

        <label>Puntuación</label><br>
        <div class="rating">
            <input type="hidden" name="puntuacionSeleccionada" id="puntuacionSeleccionada">
            <img src="{{ asset('images/valoracion/star/star1.png') }}" width="60"
                onclick="seleccionarPuntuacion(1)">
            <img src="{{ asset('images/valoracion/star/star1.png') }}" width="60"
                onclick="seleccionarPuntuacion(2)">
            <img src="{{ asset('images/valoracion/star/star1.png') }}" width="60"
                onclick="seleccionarPuntuacion(3)">
            <img src="{{ asset('images/valoracion/star/star1.png') }}" width="60"
                onclick="seleccionarPuntuacion(4)">
            <img src="{{ asset('images/valoracion/star/star1.png') }}" width="60"
                onclick="seleccionarPuntuacion(5)">
        </div><br>

        <label>Título del comentario</label><br>
        <input type="text" id="titulo_comentario" name="titulo-comentario"><br><br>

        <label>Comentario</label><br>
        <textarea id="comentario" name="comentario"></textarea><br><br>

        <button class="btnEnviarValoracion" type="submit" value="Enviar">Enviar</button>
    </form>
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
                estrellas[i].src = "{{ asset('images/valoracion/star/star1-3.png') }}";
            } else {
                estrellas[i].src = "{{ asset('images/valoracion/star/star1.png') }}";
            }
        }
    }
</script>
