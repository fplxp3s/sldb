@extends('template.site')

@section('content')

    <div class="container" style="margin-bottom: 50px">
        <div style="padding: 15px;">
            <div class="col-md-12">
                <div class="col-md-3 pull-left">
                    <h4>Meu Carrinho</h4>
                </div>
                <div class="col-md-5 pull-right">
                    <button type="button" class="btn btn-preco pull-right" data-dismiss="modal" onclick="window.location.href='/carrinho/checkout'">
                        <i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp;Finalizar Compra
                    </button>
                </div>
            </div>
            <form id="checkout-form" action="{{action('CartController@finalizarCompra')}}" method="post">
                {{csrf_field()}}
                <table class="table table-condensed checkout-table">
                    <thead class="bg-info">
                    <tr>
                        <th>Produto(s)</th>
                        <th>&nbsp;</th>
                        <th>Pre&ccedil;o</th>
                        <th>Qtd</th>
                        <th>Subtotal</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(Cart::content()->isEmpty())
                        <h5>Carrinho vazio.</h5>
                    @else
                        @foreach(Cart::content() as $itemCart)
                            <tr>
                                <td><img style="height: 80px; width: 90px" src="{{env('APP_STORAGE_PATH') . $produtos[$loop->index]->foto->nome_arquivo}}" alt="{{$produtos[$loop->index]->nome}}"></td>
                                <td style="padding-top: 25px">
                                    <a href="{{URL::to('/Produto/'.$produtos[$loop->index]->nome)}}">{{$itemCart->name}}</a><br>
                                    <h6><a href="{{URL::to('/Loja/'.$produtos[$loop->index]->loja->nome_fantasia)}}">{{$produtos[$loop->index]->loja->nome_fantasia}}</a></h6>
                                </td>
                                <td style="padding-top: 20px">R$ {{$itemCart->price}}</td>
                                <td style="padding-top: 20px" class="col-md-2">
                                    <input id="qtdItensProduto{{$itemCart->id}}"
                                           class="col-md-6 form-control"
                                           type="number"
                                           value="{{$itemCart->qty}}"
                                           max="{{$produtos[$loop->index]->quantidade}}"
                                           onchange="javascript:atualizaValoresCarrinho('{{URL::to('/')}}', '{{$itemCart->id}}', '{{$itemCart->rowId}}')"
                                           onkeyup="javascript: if (this.value > this.max) this.value = this.max;">
                                </td>
                                <td style="padding-top: 25px">R$ {{$itemCart->subtotal()}}</td>
                                <td style="padding-top: 25px" title="Remover Produto">
                                    &nbsp;
                                    <a href="" onclick="javascript:removeProdutoCarrinho('{{action('CartController@removeProdutoCarrinho', $itemCart->rowId)}}')" class="text-danger" title="Remover Produto">
                                        <i class="glyphicon glyphicon-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">&nbsp;</td>
                        </tr>
                    @endif
                    </tbody>
                    <tfoot class="bg-info">
                    <tr>&nbsp;</tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td class="text-uppercase text-black"><strong>Subtotal</strong></td>
                        <td class="text-uppercase text-danger" id="valor-subtotal"><strong>R$ {{str_replace(',','', Cart::subtotal())}}</strong></td>
                        <td colspan="1">&nbsp;</td>
                    </tr>
                    <tr><td colspan="6">&nbsp;</td></tr>
{{--                    <tr>
                        <td colspan="1">&nbsp;</td>
                        <td colspan="2" class="text-right">Informe seu CEP para cálculo do frete:</td>
                        <td><input id="input-calcular-cep" name="cepEntrega" type="text" class="col-sm-3 form-control"></td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="javascript:calculaFrete('{{URL::to('/')}}')">
                                <i class="glyphicon glyphicon-ok"></i>&nbsp;Ok
                            </button>
                        </td>
                        <td>&nbsp;</td>
                    </tr>--}}
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td>Valores Frete</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr id="valores-frete">
                        <td colspan="3">&nbsp;</td>
                        <td style="font-size: 12px">
                            <fieldset class="carriers">
                                <label class="option correios">
                                    <input type="radio" name="carrier" value="PAC" title="" onclick="javascript:atualizaValorTotal('PAC')">
                                    <span class="name">Capital R$</span>
                                    <span class="valuePAC text-success">10,00</span>
                                </label>
                                <br>
                                <label class="option correios last disabled">
                                    <input type="radio" name="carrier" value="SEDEX" title="" onclick="javascript:atualizaValorTotal('SEDEX')">
                                    <span class="name">Demais Regi&otilde;es R$</span>
                                    <span class="valueSEDEX text-success">13,00</span>
                                </label>
                            </fieldset>
                        </td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td colspan="2"><input type="checkbox" name="retirarLoja" onclick="javascript:desabilitaRadiosFrete(this);">&nbsp;Desejo retirar o produto na loja</td>
                        <td></td>
                    </tr>
                    <td colspan="6">&nbsp;</td>

                    <tr id="valores-totais">
                        <td colspan="3">&nbsp;</td>
                        <td class="text-uppercase text-black"><strong>TOTAL</strong></td>
                        <td id="valor-total" class="text-uppercase text-success"><strong>R$ {{str_replace(',','', Cart::subtotal())}}</strong></td>
                        <input id="valor-subtotal-input" name="valorSubTotalCompra" type="hidden" value="{{str_replace(',','', Cart::subtotal())}}">
                        <input id="valor-total-input" name="valorTotalCompra" type="hidden" value="{{str_replace(',','', Cart::subtotal())}}">
                        <td>&nbsp;</td>
                    </tr>

                    <tr style="border-bottom: 1px solid lightgray !important;">
                        <td colspan="6"></td>
                    </tr>
                    </tfoot>
                </table>
            </form>
            <div class="col-md-12">
                <button type="button" class="btn btn-preco pull-right" data-dismiss="modal" onclick="javascript:validaDadosCarrinho();">
                    <i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp;Finalizar Compra
                </button>
                <div class="pull-right" style="padding-right: 10px; padding-top: 7px">
                    <a href="{{URL::to('/')}}">continuar comprando </a>
                    <spam>ou</spam>
                </div>
            </div>

        </div>
    </div>

@endsection

