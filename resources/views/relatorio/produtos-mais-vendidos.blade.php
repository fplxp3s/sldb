@extends('template.painel')

@section('heading')

        <strong>Relat&oacute;rio de Produtos Mais Vendidos | Total de Registros: {{$totalDeRegistros}}</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if(empty($produtos))
        <div class="alert alert-danger">
            N&atilde;o existem produtos cadastrados no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>Nome Produto</th>
                <th>Quantidade de Vendas</th>
            </tr>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->nome_produto }} </td>
                    <td>{{$produto->total }} </td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection
