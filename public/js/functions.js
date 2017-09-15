/*$(document).ready(function () {*/
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
    $('#telefone').mask('(99)9999-9999?9');
    $('#telefone2').mask('(99)9999-9999?9');
});

$(document).ready(function () {
    $('div.alert').delay(2000).slideUp(200);
});

$(document).ready(function defineLinkMenuAtivo() {
    var pageId = $('#page-id').val();
    $('#lnk-' + pageId).addClass('active');
});

function confirmarExclusao(urlExclusao) {

    if(confirm("Deseja realmente realizar a exclusão?")) {
        window.location = urlExclusao;
    }
}
