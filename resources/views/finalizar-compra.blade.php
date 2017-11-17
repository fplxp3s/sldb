@extends('template.site')

@section('content')

    <input type="hidden" id="valorTotalCompra" value="{{$dadosCompra['valorTotalCompra']}}">
    <input type="hidden" id="valorFrete" value="{{$dadosCompra['valorTotalCompra'] - $dadosCompra['valorSubTotalCompra']}}">
    <input type="hidden" id="valorSubTotalCompra" value="{{$dadosCompra['valorSubTotalCompra']}}">
    <input type="hidden" id="enderecoEntregaId" value="{{$enderecoEntrega->id}}">

    <div class="container">
        <div style="padding: 15px;">

            <div class="col-md-12">
                <div class="col-md-12" style="border: 1px solid lightgrey;background-color: white;">
                    <div class="col-md-3 pull-left">
                        <h3>Finalizar Compra</h3>
                    </div>
                    <div class="col-md-7 pull-right">
                        <h3 class="text-right">Valor Total da Compra: <strong class="text-success">R$ {{$dadosCompra['valorTotalCompra']}}</strong></h3>
                    </div>
                </div>
            </div>

            <br>
            <br>

            <div class="row" style="margin-top: 30px">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row bg-divs-finalizar-compra">
                                <h4 class="text-center">Dados Pessoais</h4>
                                <div class="col-md-12 text-center" style="margin-bottom: 25px">
                                    <h5>Ol&aacute; {{$usuario->name}}! (N&atilde;o &eacute; voce? <a href="{{URL::to('/logout')}}">sair</a>)</h5>
                                </div>
                                <div class="col-md-12">
                                    <strong>Nome:</strong> {{$usuario->name}}<br>
                                    <strong>E-Mail:</strong> {{$usuario->email}}<br>
                                    <strong>CPF: </strong> {{$usuario->cpf}}<br>
                                    <strong>Telefone: </strong>{{$usuario->telefone}}<br>
                                    <strong>&Uacute;ltima Atualiza&ccedil;&atilde;o:</strong> {{date('d/m/Y', strtotime($usuario->updated_at))}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row bg-divs-finalizar-compra">
                                <h4 class="text-center">Endere&ccedil;o</h4>
                                <div class="col-md-12">
                                    <h5 class="text-primary text-center" style="margin-bottom: 25px"><strong>Endere&ccedil;o de Entrega</strong></h5>
                                </div>
                                <div class="col-md-12">
                                    <form id="form-endereco-entrega" class="form-horizontal" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                        <input type="hidden" name="id" value="{{$enderecoEntrega->id}}">
                                        <div class="form-group{{ $errors->has('identificador') ? ' has-error' : '' }}">
                                            <label for="identificador" class="col-md-4 control-label">Identificador</label>

                                            <div class="col-md-8">
                                                <input id="identificador" type="text" class="form-control" name="identificador" value="{{ $enderecoEntrega->identificador }}" placeholder="Ex.: Casa, Trabalho" required>

                                                @if ($errors->has('identificador'))
                                                    <span class="help-block"><strong>{{ $errors->first('identificador') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('cep') ? ' has-error' : '' }}">
                                            <label for="cep" class="col-md-4 control-label">CEP</label>

                                            <div class="col-md-8">
                                                <input id="cep" type="text" class="form-control" name="cep" value="{{ $enderecoEntrega->cep }}" required>

                                                @if ($errors->has('cep'))
                                                    <span class="help-block"><strong>{{ $errors->first('cep') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('endereco') ? ' has-error' : '' }}">
                                            <label for="endereco" class="col-md-4 control-label">Endere&ccedil;o</label>

                                            <div class="col-md-8">
                                                <input id="endereco" type="text" class="form-control" name="endereco" value="{{ $enderecoEntrega->endereco }}" required>

                                                @if ($errors->has('endereco'))
                                                    <span class="help-block"><strong>{{ $errors->first('endereco') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('numero') ? ' has-error' : '' }}">
                                            <label for="numero" class="col-md-4 control-label">N&uacute;mero</label>

                                            <div class="col-md-8">
                                                <input id="numero" type="text" class="form-control" name="numero" value="{{ $enderecoEntrega->numero }}" required>

                                                @if ($errors->has('numero'))
                                                    <span class="help-block"><strong>{{ $errors->first('numero') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('complemento') ? ' has-error' : '' }}">
                                            <label for="complemento" class="col-md-4 control-label">Complemento</label>

                                            <div class="col-md-8">
                                                <input id="complemento" type="text" class="form-control" name="complemento" value="{{ $enderecoEntrega->complemento }}" placeholder="Ex.: Ap, Bloco">

                                                @if ($errors->has('complemento'))
                                                    <span class="help-block"><strong>{{ $errors->first('complemento') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('bairro') ? ' has-error' : '' }}">
                                            <label for="bairro" class="col-md-4 control-label">Bairro</label>

                                            <div class="col-md-8">
                                                <input id="bairro" type="text" class="form-control" name="bairro" value="{{ $enderecoEntrega->bairro }}" required>

                                                @if ($errors->has('bairro'))
                                                    <span class="help-block"><strong>{{ $errors->first('bairro') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('cidade') ? ' has-error' : '' }}">
                                            <label for="cidade" class="col-md-4 control-label">Cidade</label>

                                            <div class="col-md-8">
                                                <input id="cidade" type="text" class="form-control" name="cidade" value="{{ $enderecoEntrega->cidade }}" required>

                                                @if ($errors->has('cidade'))
                                                    <span class="help-block"><strong>{{ $errors->first('cidade') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('estado') ? ' has-error' : '' }}">
                                            <label for="estado" class="col-md-4 control-label">Estado</label>

                                            <div class="col-md-8">

                                                <select name="estado" class="form-control">
                                                    @foreach($estados as $estado)
                                                        <option @if($enderecoEntrega->estado==$estado->sigla) {{'selected="selected"'}} @endif value="{{$estado->sigla}}">{{$estado->descricao}}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('estado'))
                                                    <span class="help-block"><strong>{{ $errors->first('estado') }}</strong></span>
                                                @endif
                                            </div>
                                        </div>
                                        <button type="button" id="endereco-submit" class="btn btn-primary btn-lg btn-full" style="margin-bottom: 10px" onclick="javascript:salvarEnderecoEntrega('{{action('CartController@salvaEnderecoEntrega')}}')">
                                            Salvar Endere&ccedil;o
                                        </button>
                                    </form>
                                    <div class="col-sm-12 text-center" style="padding-top: 5px; margin-bottom: 20px">
{{--                                        <input  id="retirarLojaFinalizarCompra"
                                                type="checkbox"
                                                --}}{{--checked="{{$dadosCompra['retirarLoja']}}"--}}{{--
                                                name="retirarLoja"
                                                >&nbsp;
                                                --}}
                                        @if($dadosCompra['retirarLoja']=='on')
                                            <span class="text-danger"><strong>Produto será retirado na loja.</strong></span>
                                        @endif

                                        <input type="hidden" id="retirarLoja" value="{{$dadosCompra['retirarLoja']}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-12">
                            <div class="row bg-divs-finalizar-compra">
                                <h4 class="text-center">Pagamento</h4>
                                <div class="col-sm-6 col-md-12">
                                    <h5 class="text-primary text-center" style="margin-bottom: 25px"><strong>Resumo da compra</strong></h5>
                                    <div class="resume">
                                        <p id="totalProduct" class="">Total em produtos: <span>R$ <strong>{{$dadosCompra['valorSubTotalCompra']}}</strong></span></p>
                                        <p id="shipping" class="">Despesas com frete: <span>R$ <strong>{{round($dadosCompra['valorTotalCompra'] - $dadosCompra['valorSubTotalCompra'], 2)}}</strong></span></p>
                                        <p id="total" class="last">Total a pagar: <span>R$ <strong>{{$dadosCompra['valorTotalCompra']}}</strong></span></p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-12">
                                    <h5 class="text-primary"><strong>Formas de Pagamento</strong></h5>
                                    <div>
                                        <div class="panel-group" id="accordion">

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Cart&atilde;o de Cr&eacute;dito</a>
                                                    </h5>
                                                </div>
                                                <div id="collapse1" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="payment  first" style="display: block;">
                                                            <label title="Cartão de crédito Visa" class="cartao-visa">
                                                                <span class="payment-ico"></span>
                                                                <input type="radio" name="payment" value="2">
                                                            </label>
                                                            <label title="Cartão de crédito Master" class="cartao-master">
                                                                <span class="payment-ico"></span>
                                                                <input type="radio" name="payment" value="7">
                                                            </label>
                                                            <label title="Cartão de crédito American Express" class="cartao-amex">
                                                                <span class="payment-ico"></span>
                                                                <input type="radio" name="payment" value="8">
                                                            </label>
                                                            <label title="Cartão de crédito Diners" class="cartao-diners">
                                                                <span class="payment-ico"></span>
                                                                <input type="radio" name="payment" value="9">
                                                            </label>
                                                            <label title="Cartão de crédito Elo" class="cartao-elo">
                                                                <span class="payment-ico"></span>
                                                                <input type="radio" name="payment" value="15">
                                                            </label>
                                                            <label title="Cartão Discover" class="cartao-discover">
                                                                <span class="payment-ico"></span>
                                                                <input type="radio" name="payment" value="16">
                                                            </label>
                                                            <div class="payment-data">
                                                                <form id="form-pagamento-cartao" class="form-horizontal">
                                                                    <input type="hidden" name="formaPagto" value="cartao">
                                                                    <fieldset class="amex">
                                                                        <div class="form-group">
                                                                            <label for="portadorNome" class="col-xs-12 control-label">* Nome do titular</label>
                                                                            <div class="col-xs-12">
                                                                                <input name="portadorNome" type="text" class="form-control required" id="portadorNome" data-alert="Nome do titular" maxlength="80" placeholder="Nome no cartão" autocomplete="off" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="cartaoNumero" class="col-xs-12 control-label">* Número do cartão</label>
                                                                            <div class="col-xs-12">
                                                                                <input name="cartaoNumero" type="tel" class="form-control required mkx-card-2-mask" id="cartaoNumero" data-alert="Número do cartão" minlength="14" maxlength="16" placeholder="" autocomplete="off" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group code">
                                                                            <label for="cartaoCodigoSeguranca" class="col-xs-12 control-label">* Código de Segurança </label>
                                                                            <div class="col-xs-12">
                                                                                <input name="cartaoCodigoSeguranca" type="tel" class="form-control required mkx-card-secure-4-mask" id="cartaoCodigoSeguranca" data-alert="Código de Segurança" maxlength="4" placeholder="xxxx" autocomplete="off" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="cartaoValidade" class="col-xs-12 control-label">* Vencimento</label>
                                                                            <div class="col-xs-12">
                                                                                <input name="cartaoValidade" type="text" class="form-control required mkx-venc-mask" id="cartaoValidade" data-alert="Nome do titular" maxlength="5" placeholder="mm/aa" autocomplete="off" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nparcels" class="col-xs-12 control-label">* Número de parcelas</label>
                                                                            <div class="col-xs-12">
                                                                                <select name="nparcels" class="form-control required" data-alert="Número de parcelas">
                                                                                    <option value="" class="disabled" disabled="" selected="">Selecione</option>
                                                                                    <option value="1">1x de R$ {{round($dadosCompra['valorTotalCompra'], 2)}}, sem acréscimo</option>
                                                                                    <option value="2">2x de R$ {{round($dadosCompra['valorTotalCompra'] / 2, 2)}}, sem acréscimo</option>
                                                                                    <option value="3">3x de R$ {{round($dadosCompra['valorTotalCompra'] / 3, 2)}}, sem acréscimo</option>
                                                                                    <option value="4">4x de R$ {{round($dadosCompra['valorTotalCompra'] / 4, 2)}}, sem acréscimo</option>
                                                                                    <option value="5">5x de R$ {{round($dadosCompra['valorTotalCompra'] / 5, 2)}}, sem acréscimo</option>
                                                                                    <option value="6">6x de R$ {{round($dadosCompra['valorTotalCompra'] / 6, 2)}}, sem acréscimo</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <button id="btn-pagto-cartao"
                                                                                type="button"
                                                                                class="btn btn-primary btn-lg btn-comprar btn-full"
                                                                                onclick="javascript:salvarCompra('{{action('CartController@salvaPagamento')}}', this.id, '{{csrf_token()}}');">
                                                                            Finalizar Compra
                                                                        </button>
                                                                    </fieldset>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Boleto Banc&aacute;rio </a>
                                                    </h5>
                                                </div>
                                                <div id="collapse2" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="payment" style="display: block;">
                                                            <label title="Boleto bancário" class="boleto-bancario">
                                                                <span class="payment-ico"></span>
                                                                <input type="radio" name="payment" value="18">
                                                            </label>
                                                            <div class="payment-data">
                                                                <form id="form-paymet">
                                                                    <input type="hidden" name="formaPagto" value="boleto">
                                                                    <button id="btn-pagto-boleto"
                                                                            type="button"
                                                                            class="btn btn-primary btn-lg btn-comprar btn-full"
                                                                            onclick="javascript:salvarCompra('{{action('CartController@salvaPagamento')}}', this.id, '{{csrf_token()}}');">
                                                                        Finalizar Compra
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Dep&oacute;sito, D&eacute;bito e Transfer&ecirc;ncia </a>
                                                    </h5>
                                                </div>
                                                <div id="collapse3" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="payment" style="display: block;">
                                                            <label title="Depósito identificado" class="deposito-bb"><span class="payment-ico"></span><input type="radio" name="payment" value="12"></label>
                                                            <label title="Transferência" class="transferencia-bb"><span class="payment-ico"></span><input type="radio" name="payment" value="20"></label>
                                                            <label title="Itaú Shopline" class="itau-shopline"><span class="payment-ico"></span><input type="radio" name="payment" value="21"></label>
                                                            <div class="payment-data">
                                                                <form id="form-paymet">
                                                                    <input type="hidden" name="formaPagto" value="deposito_transferencia">
                                                                    <button id="btn-pago-deposito"
                                                                            type="button"
                                                                            class="btn btn-primary btn-lg btn-comprar btn-full"
                                                                            onclick="javascript:salvarCompra('{{action('CartController@salvaPagamento')}}', this.id, '{{csrf_token()}}');">
                                                                        Finalizar Compra
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

