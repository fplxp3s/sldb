@extends('template.painel')

@section('heading')

        <strong>Relat&oacute;rio de Produtos Cadastrados | Total de Registros: {{$totalDeRegistros}}</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if($produtos->isEmpty())
        <div class="alert alert-danger">
            N&atilde;o existem produtos cadastrados no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>ID</th>
                <th>Foto</th>
                <th>Categoria</th>
                <th>Nome</th>
                <th>Pre&ccedil;o</th>
                <th>Estoque</th>
                <th>Status</th>
                <th>Loja</th>
                <th>Data de Cria&ccedil;&atilde;o</th>
                <th>&Uacute;ltima Atualiza&ccedil;&atilde;o</th>
            </tr>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->id }} </td>
                    <td><img style="height: 80px; width: 90px" src="{{env('APP_STORAGE_PATH') . $produto->foto->nome_arquivo}}" alt="{{$produto->nome}}"></td>
                    <td>{{$produto->categoria->descricao }} </td>
                    <td>{{$produto->nome }} </td>
                    <td>R$ {{$produto->preco }} </td>
                    <td>{{$produto->quantidade }} </td>
                    @if($produto->fl_ativo)
                        <td>ATIVO</td>
                    @else
                        <td>INATIVO</td>
                    @endif
                    <td>{{$produto->loja->nome_fantasia }} </td>
                    <td>{{date('d/m/Y', strtotime($produto->created_at)) }} </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($produto->updated_at)) }} </td>
                </tr>
            @endforeach
        </table>
        <div class="col-md-12 no-padding">
            <div class="col-md-2 pull-right no-padding">
                {{ $produtos->links() }}
            </div>
        </div>
    @endif

@endsection
