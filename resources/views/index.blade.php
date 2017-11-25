@extends('template.site')

@section('content')

    <div class="row" style="margin-top: -22px">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img class="first-slide" src="{{asset('images/banner1.jpg')}}" alt="First slide">
                </div>
                <div class="item">
                    <img class="second-slide" src="{{asset('images/banner2.jpg')}}" alt="Second slide">
                </div>
                <div class="item">
                    <img class="third-slide" src="{{asset('images/banner3.jpg')}}" alt="Third slide">
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Pr&oacute;ximo</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="col-sm-12 produtos-destaque">
        <h2 style="padding-left: 16px; padding-top: 5px" class="text-center">Novas Bebidas</h2>
            <div class="clearfix"><br></div>
            @foreach($produtos as $produto)
                <div class="col-sm-3 col-md-3">
                    <div class="thumbnail" title="{{$produto->nome}}">
                        <a href="{{action('SiteController@exibeDetalhesProduto', $produto->nome)}}">
                            <img class="img-thumbnail img-default-size" src="{{env('APP_STORAGE_PATH') . $produto->foto->nome_arquivo}}" alt="{{$produto->nome}}">
                        </a>
                        <div class="caption text-center">
                            <h5 style="color: #2a88bd; min-height: 30px;"><a href="{{action('SiteController@exibeDetalhesProduto', $produto->nome)}}"><strong>{{$produto->nome }}</strong></a></h5>
                            <h6><a href="{{action('SiteController@exibeDetalhesLoja', $produto->loja->razao_social)}}" style="text-decoration: none; color: grey"><strong>{{$produto->loja->razao_social }}</strong></a></h6>
                            <p class="preco"><strong>R$ {{$produto->preco }}</strong></p>
                            <p>
                                <a
                                    href="#"
                                    onclick="javascript:adicionaProdutoCarrinho('{{$produto}}', '{{URL::to('/')}}', '{{csrf_token()}}');"
                                    class="btn btn-preco">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>  Adicionar ao Carrinho
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

