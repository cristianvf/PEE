
function cargarModal(url, idModal, titulo, btnEnviar, detalle){
  $.ajax({
    url:url,
    dataType: "html",
    type: "get",
    success:function(data){
      var modal = $(idModal);
            var btnCancelar = 'Cancelar';
            modal.find('.modal-title').html(titulo);
            modal.find('.modal-body').html(data);
            modal.find('.modal-footer .modalEnviar').html(btnEnviar);
            modal.find('.modal-footer .modalEnviar').show();
            if (detalle) {
                modal.find('.modal-footer .modalEnviar').hide();
                btnCancelar = 'Cerrar';
            }
            modal.find('.modalCancelar').html(btnCancelar);
            modal.modal("show");
    },
    error: function(){

    }
  });
}


function listar(url, idListado,nivelEducativo){
    $.ajax({
        url: url,
        type:'post',
        data : { niv_edu_id : nivelEducativo},
        dataType: 'html',
        success: function(data){
            $(idListado).html(data);
        },
        error: function (jqXHR, status, error) {

            console.debug(status);
            console.debug(error);
            PNotify.removeAll();
            pNotify(TITLE_NOTIFY_ERROR, MSG_ERROR_DEFAULT, NOTIFY_ERROR);
        }
    });

}

function pNotify(title, message, type) {
(new PNotify({
    title: title,
    text: message,
    type: type,
    desktop: {
        desktop: false,
    },
    addclass: 'pnotify-center'
})).get().click(function (e) {
    if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target))
        return;
});
}

function ajaxPagination(idListado){
    $(idListado).on('click','.ajax-pagination a', function(event) {
        event.preventDefault();
        var pageUrl = $(this).attr('href');
        console.log(pageUrl);
        if(!pageUrl)
        return false;
        listar(pageUrl, idListado);
    });
}
