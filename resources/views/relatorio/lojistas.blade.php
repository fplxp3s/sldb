@extends('template.painel')

@section('heading')

        <strong>Relat&oacute;rio de Lojas Cadastradas | Total de Registros: {{$totalDeRegistros}}</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if($lojas->isEmpty())
        <div class="alert alert-danger">
            N&atilde;o existem lojas cadastradas no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>ID</th>
                <th>Raz&atilde;o Social</th>
                <th>Nome Fantasia</th>
                <th>Representante</th>
                <th>CNPJ</th>
                <th>Endere&ccedil;o</th>
                <th>Bairro</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Telefone</th>
                <th>Data de Cadastro</th>
                <th>&Uacute;ltima Atualiza&ccedil;&atilde;o</th>
            </tr>
            @foreach ($lojas as $loja)
                <tr>
                    <td>{{$loja->id }} </td>
                    <td>{{$loja->razao_social }} </td>
                    <td>{{$loja->nome_fantasia }} </td>
                    <td>{{$loja->nome_representante }} </td>
                    <td>{{$loja->cnpj }} </td>
                    <td>{{$loja->endereco }} </td>
                    <td>{{$loja->bairro }} </td>
                    <td>{{$loja->cidade }} </td>
                    <td>{{$loja->estado }} </td>
                    <td>{{$loja->telefone }} </td>
                    <td>{{date('d/m/Y', strtotime($loja->created_at)) }} </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($loja->updated_at)) }} </td>
                </tr>
            @endforeach
        </table>
        <div class="col-md-12 no-padding">
            <div class="col-md-2 pull-right no-padding">
                {{ $lojas->links() }}
            </div>
        </div>
    @endif

@endsection
