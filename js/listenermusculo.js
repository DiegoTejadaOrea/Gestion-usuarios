// var enlacesMenu = document.querySelectorAll('.list-group-item');

// enlacesMenu.forEach(function(enlace) {
//   enlace.addEventListener('click', function() {
//     var grupoMuscular = this.getAttribute('data-grupo');
//     console.log('Se hizo clic en el grupo muscular:', grupoMuscular);
//   });
// });
var grupoMuscularSeleccionado = "";

  function seleccionarGrupo(grupo) {
    grupoMuscularSeleccionado = grupo;
    console.log("Grupo muscular seleccionado: " + grupoMuscularSeleccionado);

    // enviar el resultado a PHP mediante una solicitud POST
    fetch('../templates/home.php', {
      method: 'POST',
      body: JSON.stringify({grupoMuscularSeleccionado: grupoMuscularSeleccionado}),
    });
  }
