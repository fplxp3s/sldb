@extends('template.painel')

@section('heading')

        <strong>Relat&oacute;rio de Lojas Com Maior N&uacute;mero de Vendas | Total de Registros: {{$totalDeRegistros}}</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if(empty($lojas))
        <div class="alert alert-danger">
            N&atilde;o existem lojas cadastradas no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>Raz&atilde;o Social</th>
                <th>Nome Fantasia</th>
                <th>Representante</th>
                <th>Quantidade de Produtos Vendidos</th>
            </tr>
            @foreach ($lojas as $loja)
                <tr>
                    <td>{{$loja->razao_social }} </td>
                    <td>{{$loja->nome_fantasia }} </td>
                    <td>{{$loja->nome_representante }} </td>
                    <td>{{$loja->total }} </td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection
