$(document).ready(function () {
    // Remove Search if user Resets Form or hits Escape!
    $('body, .navbar-collapse form[role="search"] button[type="reset"]').on('click keyup', function(event) {
        console.log(event.currentTarget);
        if (event.which == 27 && $('.navbar-collapse form[role="search"]').hasClass('active') ||
            $(event.currentTarget).attr('type') == 'reset') {
            closeSearch();
        }
    });

    function closeSearch() {
        var $form = $('.navbar-collapse form[role="search"].active')
        $form.find('input').val('');
        $form.removeClass('active');
    }

    // Show Search if form is not active // event.preventDefault() is important, this prevents the form from submitting
    $(document).on('click', '.navbar-collapse form[role="search"]:not(.active) button[type="submit"]', function(event) {
        event.preventDefault();
        var $form = $(this).closest('form'),
            $input = $form.find('input');
        $form.addClass('active');
        $input.focus();

    });
    // ONLY FOR DEMO // Please use $('form').submit(function(event)) to track from submission
    // if your form is ajax remember to call `closeSearch()` to close the search container
    $(document).on('click', '.navbar-collapse form[role="search"].active button[type="submit"]', function(event) {
        event.preventDefault();
        var $form = $(this).closest('form'),
            $input = $form.find('input');
        $('#showSearchTerm').text($input.val());
        closeSearch()
    });
});



function initMap() {
    map = new GMaps({
        div: '#map',
        lat: -12.043333,
        lng: -77.028333
    });

    GMaps.geocode({
        address: $('#endereco_loja').val() + ' - ' + $('#bairro_loja').val(),
        callback: function(results, status) {
            if (status == 'OK') {
                var latlng = results[0].geometry.location;
                map.setCenter(latlng.lat(), latlng.lng());
                map.setZoom(16);
                map.addMarker({
                    lat: latlng.lat(),
                    lng: latlng.lng(),
                    title: $('#nome_loja').val()
                });
            }
        }
    });
}

$(document).ready(function(){
    $('#cep').mask('99999-999');
    $('#cnpj').mask('99.999.999/9999');
    $('#cpf_representante').mask('999.999.999-99');
    $('#cpf').mask('999.999.999-99');
    $('#telefone').mask('(99)9999-9999?9');
    $('#telefone2').mask('(99)9999-9999?9');
    $('#input-calcular-cep').mask('99999-999');
    $('#cartaoNumero').mask('9999-9999-9999-9999');
    $('#cartaoCodigoSeguranca').mask('999');
    $('#cartaoValidade').mask('99/99');
});

$(document).ready(function () {
    $('div.alert').delay(2000).slideUp(200);
});

$(document).ready(function defineLinkMenuAtivo() {
    var pageId = $('#page-id').val();
    $('#lnk-' + pageId).addClass('active');
});


$body = $("body");

$(document).on({
    ajaxStart: function() { $body.addClass("loading"); },
    ajaxStop: function() { $body.removeClass("loading"); }
});

//desabilita os campos do endereco se ja houver um endereco cadastrado
$(document).ready(function () {

   var identificadorEndereco = $('#identificador').val();

   if(identificadorEndereco!=null && identificadorEndereco!='' && identificadorEndereco!=undefined) {
       $('#form-endereco-entrega :input').attr('disabled', true);
   }

});

function confirmarExclusao(urlExclusao) {

    if(confirm("Deseja realmente realizar a exclusão?")) {
        window.location = urlExclusao;
    }
}

function desabilitaFormEndereco(checked) {
    $('#form-endereco-entrega :input').attr('disabled', checked);
}