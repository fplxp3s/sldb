@extends('template.painel')

@section('heading')

        <strong>Lista de Lojas a serem aprovadas | Total de Registros: {{$totalDeRegistros}}</strong>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if($lojas->isEmpty())
        <div class="alert alert-danger">
            N&atilde;o existem Lojas a serem aprovadas no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>ID</th>
                <th>Raz&atilde;o Social</th>
                <th>Nome Fantasia</th>
                <th>Nome Representante</th>
                <th>Propriet&aacute;rio</th>
                <th>Data de Cria&ccedil;&atilde;o</th>
                <th>&Uacute;ltima Atualiza&ccedil;&atilde;o</th>
                <th class="text-center">A&ccedil;&otilde;es</th>
            </tr>
            @foreach ($lojas as $loja)
                <tr>
                    <td>{{$loja->id }} </td>
                    <td>{{$loja->razao_social }} </td>
                    <td>{{$loja->nome_fantasia }} </td>
                    <td>{{$loja->nome_representante }} </td>
                    <td>{{$loja->user->name }} </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($loja->created_at)) }} </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($loja->updated_at)) }} </td>

                    <td align="center" >
                        <button class="btn btn-xs btn-success" type="button"
                                onclick="location.href ='{{action('LojaController@aprovarLoja', $loja->id)}}'" title="Aprovar Loja">
                            <i class="fa fa-check fa-lg"></i> Aprovar
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection
