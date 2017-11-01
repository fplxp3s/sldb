function adicionaProdutoCarrinho(produto, url, token) {

    var produtoJson = JSON.parse(produto);
    var produtoCarrinho = {"id":produtoJson.id, "name":produtoJson.nome,"qty":1/*produtoJson.quantidade*/,"price":produtoJson.preco,"_token":token};

    $.ajax({
        url: url + '/carrinho/adiciona',
        method: 'POST',
        data: produtoCarrinho,
        dataType: 'json',
        statusCode: {
            401: function() {
                sessionStorage.setItem("msg", "E necessario estar logado para adicionar itens ao carrinho.");
                window.location.href = "/login";
            },
            200: function() {
                //$("#cart-modal").load(window.location.href + "#cart-modal");
                window.location.reload();
                //$('#cart-modal').modal();
            }
        }
    })
}

function removeProdutoCarrinho(url) {

    $.ajax({
        url: url,
        method: 'GET',
        statusCode: {
            200: function() {
                //$("#cart-modal").load(window.location.href + "#cart-modal");
                window.location.reload();
            }
        }
    })
}

function atualizaValoresCarrinho(url, idProduto, rowId) {

    qtdItens = $('#qtdItensProduto' + idProduto).val();

    $.ajax({
        url: url + '/carrinho/atualiza/' + rowId + '/' + qtdItens,
        method: 'GET',
        statusCode: {
            200: function() {
                window.location.reload();
            }
        }
    })

}

function esvaziaCarrinho(url) {

    $.ajax({
        url: url,
        method: 'GET',
        statusCode: {
            200: function() {
                window.location.reload();
            }
        }
    })
}


function calculaFrete(url) {

    cep = $('#input-calcular-cep');

    if(cep.val() == null || cep.val() == '' || cep.val() == undefined) {
        cep.addClass('alert-danger');
        cep.focus();
    } else {
        $.ajax({
            url: url + '/carrinho/calcula-frete/' + cep,
            method: 'GET',
            statusCode: {
                200: function(data) {

                    $('#valores-frete .valuePAC').val(data.PAC);
                    $('#valores-frete .valuePAC').html('R$ ' + data.PAC);
                    $('#valores-frete .valueSEDEX').val(data.SEDEX);
                    $('#valores-frete .valueSEDEX').html('R$ ' + data.SEDEX);

                    $('#valor-total').html('<strong>R$ ' + (parseFloat($('#valor-total-input').val().replace(',','')) + parseFloat(data.PAC)) + '</strong>'); //PAC selecionado como padrao
                    $('#valor-total-input').val(parseFloat($('#valor-total-input').val().replace(',','')) + parseFloat(data.PAC));
                    $('#valores-frete').show();
                    cep.removeClass('alert alert-danger');
                }
            }
        })
    }

}

function atualizaValorTotal(tipoFrete) {

    var valorPAC = 0;
    var valorSEDEX = 0;

    $('#valor-total-input').val(0);

    if(tipoFrete=='PAC') {
        valorPAC =  $('#valores-frete .valuePAC').text();
        $('#valor-total').html('<strong>R$ ' + (parseFloat($('#valor-subtotal-input').val().replace(',','')) + parseFloat(valorPAC)) + '</strong>');
        $('#valor-total-input').val(parseFloat($('#valor-subtotal-input').val().replace(',','')) + parseFloat(valorPAC));
    } else if(tipoFrete=='SEDEX') {
        valorSEDEX =  $('#valores-frete .valueSEDEX').text();
        $('#valor-total').html('<strong>R$ ' + (parseFloat($('#valor-subtotal-input').val().replace(',','')) + parseFloat(valorSEDEX)) + '</strong>');
        $('#valor-total-input').val(parseFloat($('#valor-subtotal-input').val().replace(',','')) + parseFloat(valorSEDEX));
    }

}

function salvarEnderecoEntrega(url) {

    var form = $('#form-endereco-entrega');

    if(!form[0].checkValidity()) {
        alert('É necessário preencher todos os dados do endereço.')
    } else {
        var data = form.serializeArray();

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            statusCode: {
                200: function(data) {
                    alert('Endereco cadastrado com sucesso!');
                    $('#form-endereco-entrega :input').attr('disabled', true);
                    //sessionStorage.setItem('_token', $('input[name=_token]').val());
                },
                500: function () {
                    alert('Ocorreu um erro. Favor tentar novamente!');
                }
            }
        })
    }

}

function salvarCompra(url, idFormaPagamento, token) {

    var formaPagamento = '';
    var valorTotal = $('#valorTotalCompra').val();
    var valorSubTotal = $('#valorSubTotalCompra').val();
    var frete = $('#valorFrete').val();
    var enderecoEntregaId = $('#enderecoEntregaId').val();
    var retirarLoja = $('#retirarLoja').val();
    var dataCompra = '';
    //var token = sessionStorage.getItem('_token')==null?token:sessionStorage.getItem('_token');

    if(idFormaPagamento=='btn-pagto-cartao') {
        formaPagamento = 'CARTAO';
    } else if (idFormaPagamento=='btn-pagto-boleto') {
        formaPagamento = 'BOLETO';
    } else {
        formaPagamento = 'DEPOSITO/TRANSFERENCIA';
    }

    var form = $('#form-pagamento-cartao');

    if(formaPagamento=='CARTAO' && !form[0].checkValidity()) {
        alert('É necessário preencher todos os dados do cartão.')
    } else {
        var data = {
            'valor_total':valorTotal,
            'valor_subtotal':valorSubTotal,
            'forma_pagto':formaPagamento,
            'valor_frete':frete,
            'retirar_loja' : retirarLoja,
            'endereco_entrega_id':enderecoEntregaId,
            'data':dataCompra,
            '_token': token
        };

        $.ajax({
            url: url,
            method: 'post',
            data: data,
            statusCode: {
                200: function(data) {
                    window.location.href = '/compra-finalizada';
                }
            }
        })
    }

}