<?php use Gloudemans\Shoppingcart\Facades\Cart; ?>
<div id="cart-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            @if(!Auth::guest())

                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Carrinho de Compras de {{Auth::user()->name}}</h4>
                </div>

                <div class="modal-body">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Produtos</th>
                                <th>Qtd</th>
                                <th>Pre&ccedil;o</th>
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
                                    <td>{{$itemCart->name}}</td>
                                    <td>{{$itemCart->qty}}</td>
                                    <td>R$ {{$itemCart->price}}</td>
                                    <td>R$ {{$itemCart->subtotal()}}</td>
                                    <td title="Remover Produto">
                                        <a href="" onclick="javascript:removeProdutoCarrinho('{{action('CartController@removeProdutoCarrinho', $itemCart->rowId)}}')" class="text-danger">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot class="bg-info">
                            <tr>&nbsp;</tr>
                            <tr>
                                <td class="text-uppercase text-black"><strong>Total</strong></td>
                                <td colspan="2">&nbsp;</td>
                                <td class="text-uppercase text-danger"><strong>R$ {{Cart::subtotal()}}</strong></td>
                                <td colspan="1">&nbsp;</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @if(!Cart::content()->isEmpty())
                    <div class="modal-footer">
                        <button type="button" class="btn btn-preco" data-dismiss="modal" onclick="window.location.href='/carrinho/checkout'">
                            <i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp;Finalizar Compra
                        </button>
                        <button type="button" class="btn btn-danger" onclick="javascript:esvaziaCarrinho('{{action('CartController@esvaziaCarrinho')}}')">
                            <i class="glyphicon glyphicon-trash"></i>&nbsp;&nbsp;Esvaziar Carrinho
                        </button>
                    </div>
                @endif
            @else
                <div class="modal-body">
                    <p>&Eacute; necess&aacute;rio estar logado para acessar seu carrinho de compras.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="window.location.href='/login'">Entrar</button>
                </div>
            @endif


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->