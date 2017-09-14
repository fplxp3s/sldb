@extends('template.site')

@section('content')

    <div class="container">
        <div class="row">
            @foreach($produtos as $produto)
                <div class="col-sm-3 col-md-3">
                    <div class="thumbnail">
                        <a href="{{action('SiteController@exibeDetalhesProduto', $produto->nome)}}">
                            <img class="img-thumbnail img-default-size" src="{{Illuminate\Support\Facades\Storage::url($produto->foto->nome_arquivo)}}" alt="{{$produto->nome}}">
                        </a>
                        <div class="caption text-center">
                            <h5 style="color: #2a88bd; min-height: 30px;"><a href="{{action('SiteController@exibeDetalhesProduto', $produto->nome)}}"><strong>{{$produto->nome }}</strong></a></h5>
                            <h6><a href="{{action('SiteController@exibeDetalhesLoja', $produto->loja->razao_social)}}" style="text-decoration: none; color: grey"><strong>{{$produto->loja->razao_social }}</strong></a></h6>
                            <p class="preco"><strong>R$ {{$produto->preco }}</strong></p>
                            <p><a href="#" class="btn btn-preco" role="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i>  Adicionar ao Carrinho</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

