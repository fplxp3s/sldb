@extends('template.site')

@section('content')

    <div class="container">

        <input type="hidden" id="endereco_loja" value="{{$loja->endereco}}" />
        <input type="hidden" id="bairro_loja" value="{{$loja->bairro}}" />
        <input type="hidden" id="nome_loja" value="{{$loja->razao_social}}" />

        <div class="col-md-12" style="margin-top: 65px">
            <div class="col-md-4 detalhe-produto-thumbnail">
                <img class="img-detalhe-produto" src="{{asset('storage/'.$produto->foto->nome_arquivo)}}" alt="{{$produto->nome}}">
            </div>
            <div class="col-md-6 col-md-offset-2">

                <h3 style="color: black" class="text-uppercase"><strong>{{$produto->nome}}</strong></h3>

                <div class="stars">
                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                    <i class="fa fa-star blue-star" aria-hidden="true"></i>
                    <i class="fa fa-star gray-star" aria-hidden="true"></i>
                </div>

                <h4 style="padding-top: 15px; color: black"><strong>Descri&ccedil;&atilde;o</strong></h4>
                <p class="text-justify">{{$produto->descricao}}</p>

                <h4 style="padding-top: 15px; color: black; display: inline; float: left"><strong>R$ {{$produto->preco}}</strong></h4>
{{--                <div class="col-md-4 col-md-offset-1" style="display: inline;padding-top: 15px;">
                    <label for="qtd" class="col-md-1 control-label" style="padding-top: 8px; color: black !important;">Qtd: </label>
                    <div class="col-md-8">
                        <input class="form-control" type="number" name="quantidade" min="1" max="{{$produto->quantidade}}"
                               placeholder="Qtd" onchange="" value="1">
                    </div>
                </div>--}}
                <div class="clearfix"></div>
                <br>
                <br>
                <div class="col-md-12 no-padding">
                    <p>
                        <a style="border-radius: 0px !important;" href="#" class="btn btn-preco" role="button">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>  Adicionar ao Carrinho
                        </a>
                        <a style="text-decoration: none" href="{{action('SiteController@exibeDetalhesLoja', $loja->razao_social)}}"><small>&nbsp;&nbsp;&nbsp;&nbsp;Deseja comprar o produto na Loja?</small></a>
                    </p>
                </div>
            </div>

{{--            <div class="col-sm-12" style="margin-top: 120px; margin-bottom: 70px">
                <h2 class="text-center">Prefere retirar na loja?  <small>{{$loja->razao_social}}</small></h2>
                <div id="map" style="width: 100%; height: 320px;"></div>
            </div>--}}

            @if(!$produtos->isEmpty())
                <div class="col-sm-12 produtos-destaque" style="margin-top: 170px; margin-bottom: 70px">
                    <h2 class="text-center">Produtos Semelhantes</h2>
                    <div class="clearfix"><br></div>
                    @foreach($produtos as $produto)
                        <div class="col-sm-3 col-md-3">
                            <div class="thumbnail" title="{{$produto->nome}}">
                                <a href="{{action('SiteController@exibeDetalhesProduto', $produto->nome)}}"><img class="img-thumbnail img-default-size" src="{{asset('storage/'.$produto->foto->nome_arquivo)}}" alt="{{$produto->nome}}"></a>
                                <div class="caption text-center">
                                    <h5 style="color: #2a88bd"><a href="{{action('SiteController@exibeDetalhesProduto', $produto->nome)}}"><strong>{{$produto->nome }}</strong></a></h5>
                                    <h6><a href="{{action('SiteController@exibeDetalhesLoja', $loja->razao_social)}}" style="text-decoration: none; color: grey"><strong>{{$produto->loja->razao_social }}</strong></a></h6>
                                    <p class="preco"><strong>R$ {{$produto->preco }}</strong></p>
                                    <p><a href="#" class="btn btn-preco" role="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Adicionar ao Carrinho</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

@endsection

