@extends('template.painel')

@section('heading')

        <strong>Lista de Usu&aacute;rios Cadastrados | Total de Registros: {{$totalDeRegistros}}</strong>

        <div class="col-md-6 pull-right no-padding">
            <div class="col-md-7 col-md-offset-5">
                <form id="pesquisa-usuarios-form" action="{{ action('UsuarioController@lista') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input name="textoPesquisa" type="text" class="form-control input-sm" placeholder="Pesquisar" aria-describedby="search-icon" required>
                        <span class="input-group-addon" id="search-icon" style="cursor: pointer"
                              onclick="event.preventDefault(); document.getElementById('pesquisa-usuarios-form').submit();">
                             <i class="glyphicon glyphicon-search"></i>
                        </span>
                    </div>
                </form>
            </div>
{{--            <div class="col-md-2 pull-right no-padding">
                <button class="btn btn-sm btn-primary pull-right" type="button"
                        title="Adicionar Usu&aacute;rio"
                        onclick="location.href='{{action('UsuarioController@novo')}}'">
                    <i class="glyphicon glyphicon-plus"></i> Adicionar Usuario
                </button>
            </div>--}}
        </div>

@endsection

@section('content')

    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            <strong>{{ Session::get('flash_message') }}</strong>
        </div>
    @endif

    @if($usuarios->isEmpty())
        <div class="alert alert-danger">
            N&atilde;o existem usu&aacute;rios cadastrados no momento.
        </div>
    @else
        <table class="table table-striped table-hover">
            <tr style="background-color: #2e353d; color: whitesmoke">
                <th>ID</th>
                <th>Nome</th>
                <th>E-Mail</th>
                <th>Perfil</th>
                <th>Data de Cria&ccedil;&atilde;o</th>
                <th>&Uacute;ltima Atualiza&ccedil;&atilde;o</th>
                <th class="text-center">A&ccedil;&otilde;es</th>
            </tr>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{$usuario->id }} </td>
                    <td>{{$usuario->name }} </td>
                    <td>{{$usuario->email }} </td>
                    @if($usuario->perfil_id==1)
                        <td>Administrador</td>
                    @elseif($usuario->perfil_id==2)
                        <td>Cliente</td>
                    @else
                        <td>Propriet&aacute;rio</td>
                    @endif
                    <td>{{date('d/m/Y H:i:s', strtotime($usuario->created_at)) }} </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($usuario->updated_at)) }} </td>

                    <td align="center" >
                        <button class="btn btn-xs btn-default" type="button"
                                onclick="location.href ='{{action('UsuarioController@mostra', $usuario->id)}}'" title="Visualizar">
                            <i class="fa fa-search fa-lg"></i> Visualizar
                        </button>

{{--                        <button class="btn btn-xs btn-info" type="button"
                                onclick="location.href ='{{action('UsuarioController@edita', $usuario->id)}}'" title="Editar Informacoes">
                            <i class="fa fa-pencil-square-o fa-lg"></i> Editar
                        </button>--}}

                        <button class="btn btn-xs btn-danger" type="button" onclick="confirmarExclusao('{{action('UsuarioController@remove', $usuario->id)}}');">
                            <i class="glyphicon glyphicon-trash"></i> Excluir
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="col-md-12 no-padding">
            <div class="col-md-6 pull-left no-padding">
                <ul style="padding-top: 30px; padding-left: 0">

                    <form id="lista-usuarios-form" action="{{ action('UsuarioController@lista') }}" method="POST">
                        {{ csrf_field() }}
                        <strong>Quantidade de resultados a serem exibidos:</strong>
                        <select name="qtdItens" onchange="event.preventDefault(); document.getElementById('lista-usuarios-form').submit();">
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
                {{ $usuarios->appends(['qtdItens' => $qtdItens])->links() }}
            </div>

        </div>
    @endif

@endsection
