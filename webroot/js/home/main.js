$( document ).ready(function() {
  cambiarPestanaMenu(idNivelEducativo)
  listar(urlListarActividad,"#listado-actividades",idNivelEducativo);
  ajaxPagination('#listado-actividades');
  $('#modalEditarActividad').on('hidden.bs.modal', function (){
       $('#modalEditarActividad .modalEnviar').off('click');
    });

});

function cambiarPestanaMenu(idNivelEducativo){
  var pestanaPrevia = $(".active");
  $(pestanaPrevia).removeClass("active");
  switch (idNivelEducativo) {
  case NIVEL_EDUCATIVO_SECUNDARIA:
    $(".menu-sec").addClass('active');
    break;
  case NIVEL_EDUCATIVO_BACHILLERATO:
    $(".menu-bach").addClass('active');
    break;

  case NIVEL_EDUCATIVO_UNIVERSIDAD:
    $(".menu-uni").addClass('active');
    break;
}
}

function modalRegistrarActividad(idNivelEducativo){
  cargarModal(urlEditarActividad + '/' + idNivelEducativo  ,'#modalEditarActividad','Registrar actividad','Guardar',false);
}

function modalDetalleActividad(id){
  cargarModal(urlDetalleActividad+"/"+id,'#modalDetalleActividad','Detalle de actividad','',true);
}

function modalEditarActividad(idNivelEducativo,id){
  cargarModal(urlEditarActividad+ "/" + idNivelEducativo +"/"+id,'#modalEditarActividad','Editar actividad','Guardar',false);

}

function eliminarArchivo(id) {
    if($(id).hasClass('archivoActividad')){
        $(".archivoActividadOculto").val('');
    }else{
        dataId = $(id).attr('data-id');
        $("input[data-id="+dataId+"]").val('');
    }
    $(id).parent().parent().find(".archivo").prop("disabled", false);
    $(id).closest('.archivoSubido').remove();
     $('.tooltip').remove();
}
function eliminarActividad(id){
  var titulo = TITULO_ELIMINAR_ACTIVIDAD;
  var modal = $('#modalEliminarActividad');
  modal.find('.modal-footer .modalEnviar').show();
  modal.find('.modal-footer .modalEnviar').attr('onclick', 'cambiarEstadoActividad(' + id + ');');
  modal.find('.modal-title').html(titulo);
  modal.find('.modal-body').html(MSG_BORRAR_ACTIVIDAD);
  modal.modal('show');
}

function cambiarEstadoActividad(id){
  $.ajax({
        url: urlEliminarActividad,
        data : { actividad_id : id },
        type:'POST',
        dataType: 'json',
        success: function(data){
          var modal = $('#modalEliminarActividad');
          PNotify.removeAll();
          if(data.response.estatus){
              listar(urlListarActividad,"#listado-actividades",idNivelEducativo);
              pNotify(TITLE_NOTIFY_SUCCESS, 'Se ha eliminado la actividad de forma correcta', NOTIFY_SUCCESS);
          }else{
              pNotify(TITLE_NOTIFY_ERROR, MSG_ERROR_DEFAULT, NOTIFY_ERROR);
          }
          modal.modal('hide');
        },
        error: function (jqXHR) {

        }
    });
}
