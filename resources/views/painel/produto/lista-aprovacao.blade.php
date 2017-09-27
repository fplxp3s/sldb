@extends('template.painel')

@section('heading')

        <strong>Lista de Produtos em aprova&ccedil;&atilde;o | Total de Registros: {{$totalDeRegistros}}</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if($produtos->isEmpty())
        <div class="alert alert-danger">
            N&atilde;o existem Produtos a serem aprovados no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>ID</th>
                <th>Foto</th>
                <th>Categoria</th>
                <th>Nome</th>
                <th>Pre&ccedil;o</th>
                <th>Quantidade</th>
                <th>Data de Cria&ccedil;&atilde;o</th>
                <th>&Uacute;ltima Atualiza&ccedil;&atilde;o</th>
                <th class="text-center">A&ccedil;&otilde;es</th>
            </tr>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->id }} </td>
                    <td><img style="height: 80px; width: 90px" src="{{env('APP_STORAGE_PATH') . $produto->foto->nome_arquivo}}" alt="{{$produto->nome}}"></td>
                    <td>{{$produto->categoria->descricao }} </td>
                    <td>{{$produto->nome }} </td>
                    <td>R$ {{$produto->preco }} </td>
                    <td>{{$produto->quantidade }} </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($produto->created_at)) }} </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($produto->updated_at)) }} </td>

                    <td align="center" >
                        <button class="btn btn-xs btn-success" type="button"
                                onclick="location.href ='{{action('ProdutoController@aprovarProduto', $produto->id)}}'" title="Aprovar Produto">
                            <i class="fa fa-check fa-lg"></i> Aprovar
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>

    @endif

@endsection
