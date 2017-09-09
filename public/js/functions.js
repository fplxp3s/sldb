$(document).ready(function () {
    $('div.alert').delay(2000).slideUp(200);
});

$(document).ready(function defineLinkMenuAtivo() {
    var pageId = $('#page-id').val();
    $('#lnk-' + pageId).addClass('active');
});

$(document).ready(function confirmaExclusaoUsuario() {

    var $idUsuario = '';

    $('#confirmDelete').on('show.bs.modal', function (e) {
        $idUsuario = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text('Deseja realmente excluir o usuario?');
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
    });

    $('#confirm').click(function () {
        document.location = document.getElementById('lnk-excluir-usuario-' + $idUsuario).href;
    });

});