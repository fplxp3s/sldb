@extends('template.painel')

@section('heading')
        <strong>Detalhes do Pedido #{{$compra->id}}</strong>
@endsection

@section('content')

<div class="col-md-12">
    <fieldset name="dadosCompra" class="form-group">
        <legend>Pedido</legend>
        <ul class="list-unstyled">
            <li>
                <b>Data:</b> {{date('d/m/Y', strtotime($compra->data))}}
            </li>
            <li>
                <b>Subtotal:</b> R$ {{$compra->valor_subtotal}}
            </li>
            <li>
                <b>Valor do Frete:</b> R$ {{$compra->valor_frete}} {{--verificar se produto foi retirado em loja--}}
            </li>
            <li>
                <b>Total:</b> R$ {{$compra->valor_total}}
            </li>
            <li>
                <b>Forma Pagto:</b> {{$compra->forma_pagto}}
            </li>
        </ul>
    </fieldset>
    <fieldset name="dadosEntrega" class="form-group">
        <legend>Endere&ccedil;o de Entrega</legend>

        @if(!isset($enderecoEntrega))
            <h4>Usu&aacute;rio ir&aacute; retirar o pedido na loja.</h4>
        @else

            <ul class="list-unstyled">
                <li>
                    <b>Identificador:</b> {{$enderecoEntrega->identificador}}
                </li>
                <li>
                    <b>CEP:</b> {{$enderecoEntrega->cep}}
                </li>
                <li>
                    <b>Endere&ccedil;o:</b> {{$enderecoEntrega->endereco}} {{--verificar se produto foi retirado em loja--}}
                </li>
                <li>
                    <b>N&uacute;mero:</b> {{$enderecoEntrega->numero}}
                </li>
                <li>
                    <b>Complemento:</b> {{$enderecoEntrega->complemento}}
                </li>
                <li>
                    <b>Bairro:</b> {{$enderecoEntrega->bairro}}
                </li>
                <li>
                    <b>Cidade:</b> {{$enderecoEntrega->cidade}}
                </li>
                <li>
                    <b>Estado:</b> {{$enderecoEntrega->estado}}
                </li>
            </ul>

        @endif
    </fieldset>
    <fieldset class="form-group">
        <legend>Itens do Pedido</legend>
        <table class="table table-condensed">
{{--            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>ID</th>
                <th>Data da Compra</th>
                <th>Valor Total</th>
                <th>Forma Pagto</th>
                <th class="text-center">A&ccedil;&otilde;es</th>
            </tr>--}}
            @foreach ($itemsCompra as $item)
                <tr>
                    {{--<td style="border-top: none"># {{$item->id}} </td>--}}
                    <td style="border-top: none; vertical-align: middle"><img style="height: 80px; width: 90px" src="{{env('APP_STORAGE_PATH') . $produtos[$loop->index]->foto->nome_arquivo}}" alt="{{$produtos[$loop->index]->nome}}"></td>
                    <td style="border-top: none; vertical-align: middle">Produto: {{$item->nome_produto}} </td>
                    <td style="border-top: none; vertical-align: middle">Pre&ccedil;o: R$ {{$item->valor_produto}} </td>
                    <td style="border-top: none; vertical-align: middle">Quantidade: {{$item->quantidade}} </td>
                    <td style="border-top: none; vertical-align: middle">Loja: {{$produtos[$loop->index]->loja->razao_social}}</td>
                    <td style="border-top: none; vertical-align: middle">
                        Endere&ccedil;o: {{$produtos[$loop->index]->loja->endereco}}, {{$produtos[$loop->index]->loja->bairro}} - {{$produtos[$loop->index]->loja->cidade}}
                    </td>
                </tr>
            @endforeach
        </table>
    </fieldset>
</div>

@endsection
