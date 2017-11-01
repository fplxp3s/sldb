@extends('template.site')

@section('content')

    <div class="row" style="margin-bottom: 70px; margin-top: -22px;">
            <div id="map" style="width: 100%; height: 350px;"></div>
        </div>
    </div>

    <div class="container">

        <input type="hidden" id="endereco_loja" value="{{$loja->endereco}}" />
        <input type="hidden" id="bairro_loja" value="{{$loja->bairro}}" />
        <input type="hidden" id="nome_loja" value="{{$loja->razao_social}}" />

        <h2 class="text-center">{{$loja->razao_social}}</h2>

        <div class="col-md-12">

            <div class="col-md-4 detalhe-produto-thumbnail">
                <img src="{{asset('images/loja.png')}}" alt="{{$loja->nome_fantasia}}" class="img-detalhe-produto">
            </div>

            <div class="col-md-8" style="padding: 0.45em;box-shadow: 5px 0px 5px #b2afaf; min-height: 366px">
                <ul class="list-unstyled detalhe-loja">
{{--                    <li>
                        <strong class="text-black">Propriet&aacute;rio:</strong> {{$loja->user->name}}
                    </li>--}}
                    <li>
                        <strong class="text-black">Nome Fantasia:</strong> {{$loja->nome_fantasia}}
                    </li>
{{--                    <li>
                        <strong class="text-black">Nome Representante:</strong> {{$loja->nome_representante}}
                    </li>--}}
{{--                    <li>
                        <strong class="text-black">CPF Representante:</strong> {{$loja->cpf_representante}}
                    </li>--}}
{{--                    <li>
                        <strong class="text-black">CNPJ:</strong> {{$loja->cnpj}}
                    </li>--}}
                    <li>
                        <strong class="text-black">Endere&ccedil;o:</strong> {{$loja->endereco}}, {{$loja->bairro}}
                    </li>
                    <li>
                        <strong class="text-black">Cidade:</strong> {{$loja->cidade}}
                    </li>
                    <li>
                        <strong class="text-black">Estado:</strong> {{$loja->estado}}
                    </li>
                    <li>
                        <strong class="text-black">Telefone:</strong> {{$loja->telefone}}
                    </li>
                    @if($loja->telefone2 != '' && $loja->telefone2 != null)
                        <li>
                            <strong class="text-black">Telefone2:</strong> {{$loja->telefone2}}
                        </li>
                    @endif
                </ul>
        </div>

        <div class="col-md-12" style="margin-top: 65px">

            @if(!$produtos->isEmpty())
                <div class="col-sm-12 produtos-destaque" style="margin-top: 50px; margin-bottom: 70px">
                    <h2 class="text-center">Produtos da loja <small>{{$loja->razao_social}}</small></h2>
                    <div class="clearfix"><br></div>
                    @foreach($produtos as $produto)
                        <div class="col-sm-3 col-md-3">
                            <div class="thumbnail" title="{{$produto->nome}}">
                                <a href="{{action('SiteController@exibeDetalhesProduto', $produto->nome)}}">
                                    <img class="img-thumbnail img-default-size" src="{{env('APP_STORAGE_PATH') . $produto->foto->nome_arquivo}}" alt="{{$produto->nome}}">
                                </a>
                                <div class="caption text-center">
                                    <h5 style="color: #2a88bd; min-height: 30px;"><a href="{{action('SiteController@exibeDetalhesProduto', $produto->nome)}}"><strong>{{$produto->nome }}</strong></a></h5>
                                    <h6><a href="{{action('SiteController@exibeDetalhesLoja', $loja->razao_social)}}" style="text-decoration: none; color: grey"><strong>{{$produto->loja->razao_social }}</strong></a></h6>
                                    <p class="preco"><strong>R$ {{$produto->preco }}</strong></p>
                                    <p><a href="" onclick="javascript:adicionaProdutoCarrinho('{{$produto}}', '{{URL::to('/')}}', '{{csrf_token()}}');" class="btn btn-preco" role="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Adicionar ao Carrinho</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

@endsection

