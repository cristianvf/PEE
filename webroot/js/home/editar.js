$( document ).ready(function() {

  $("#modalEditarActividad .modalEnviar").on('click',function(){
    guardarActividad();
  });
});

function guardarActividad(){
  var form = $("#formGuardarActividad");
  var datos = new FormData(form[0]);
  $.ajax({
        url: urlGuardarActividad,
        data: datos,
        type:'POST',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
          listar(urlListarActividad,"#listado-actividades",idNivelEducativo);
          $('#modalEditarActividad').modal('hide');
          PNotify.removeAll();
          pNotify(TITLE_NOTIFY_SUCCESS, 'Se ha guardado la actividad de forma correcta', NOTIFY_SUCCESS);
        },
        error: function (jqXHR) {
        }

    });
}
