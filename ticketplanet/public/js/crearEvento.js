document.addEventListener('DOMContentLoaded', function() {
  const formulario = document.getElementById('formulario');
  const inputImagen = document.getElementById('imagenEsdeveniment');
  const errorImagen = document.getElementById('errorImagen');

  formulario.addEventListener('submit', function(event) {
      // Verifica las extensiones de los archivos seleccionados
      for (let i = 0; i < inputImagen.files.length; i++) {
          const fileName = inputImagen.files[i].name;
          if (!fileName.includes('.')) {
              errorImagen.style.display = 'block';
              event.preventDefault();
              return;
          }
      }
  });
});