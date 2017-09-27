@extends('template.painel')

@section('heading')

        <strong>Lista de Lojas Cadastradas | Total de Registros: {{$totalDeRegistros}}</strong>

        <div class="col-md-6 pull-right no-padding">
            <div class="col-md-7 {{Auth::user()->perfil_id==3?'col-md-offset-2':'col-md-offset-5'}}">
                <form id="pesquisa-lojas-form" action="{{ action('LojaController@lista') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input name="textoPesquisa" type="text" class="form-control input-sm" placeholder="Pesquisar" aria-describedby="search-icon" required>
                        <span class="input-group-addon" id="search-icon" style="cursor: pointer"
                              onclick="event.preventDefault(); document.getElementById('pesquisa-lojas-form').submit();">
                             <i class="glyphicon glyphicon-search"></i>
                        </span>
                    </div>
                </form>
            </div>
            @if(Auth::user()->perfil_id==3) {{--dono de loja--}}
                <div class="col-md-2 pull-right no-padding">
                    <button class="btn btn-sm btn-primary pull-right" type="button"
                            title="Adicionar Loja"
                            onclick="location.href='{{action('LojaController@novo')}}'">
                        <i class="glyphicon glyphicon-plus"></i> Adicionar Loja
                    </button>
                </div>
            @endif
        </div>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if($lojas->isEmpty())
        <div class="alert alert-danger">
            N&atilde;o existem Lojas cadastradas no momento.
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
                        <button class="btn btn-xs btn-default" type="button"
                                onclick="location.href ='{{action('LojaController@mostra', $loja->id)}}'" title="Visualizar Informacoes">
                            <i class="fa fa-search fa-lg"></i> Visualizar
                        </button>

                        <button class="btn btn-xs btn-info" type="button"
                                onclick="location.href ='{{action('LojaController@edita', $loja->id)}}'" title="Editar Informacoes">
                            <i class="fa fa-pencil-square-o fa-lg"></i> Editar
                        </button>

                        <button class="btn btn-xs btn-danger" type="button" onclick="confirmarExclusao('{{action('LojaController@remove', $loja->id)}}');" title="Excluir Loja">
                            <i class="glyphicon glyphicon-trash"></i> Excluir
                        </button>

                        <button class="btn btn-xs btn-success" type="button"
                                onclick="location.href ='{{action('ProdutoController@lista', ['loja_id' => $loja->id])}}'" title="Gerenciar Produtos">
                            <i class="fa fa-shopping-cart fa-lg"></i> Produtos
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="col-md-12 no-padding">
            <div class="col-md-6 pull-left no-padding">
                <ul style="padding-top: 30px; padding-left: 0">

                    <form id="lista-lojas-form" action="{{ action('LojaController@lista') }}" method="POST">
                        {{ csrf_field() }}
                        <strong>Quantidade de resultados a serem exibidos:</strong>
                        <select name="qtdItens" onchange="event.preventDefault(); document.getElementById('lista-lojas-form').submit();">
                            <option @if($qtdItens==10) {{'selected="selected"'}} @endif value="10">10</option>
                            <option @if($qtdItens==20) {{'selected="selected"'}} @endif value="20">20</option>
                            <option @if($qtdItens==30) {{'selected="selected"'}} @endif value="30">30</option>
                            <option @if($qtdItens==50) {{'selected="selected"'}} @endif value="50">50</option>
                            <option @if($qtdItens==100) {{'selected="selected"'}} @endif value="100">100</option>
                        </select>
                    </form>

                </ul>
            </div>
            <div class="col-md-2 pull-right no-padding">
                {{ $lojas->appends(['qtdItens' => $qtdItens])->links() }}
            </div>

        </div>
    @endif

@endsection
