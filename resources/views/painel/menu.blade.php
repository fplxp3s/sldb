<div class="nav-side-menu">
    <div class="brand"><i class="fa fa-dashboard fa-md"></i>&nbsp;&nbsp;Dashboard</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">

            @if(Auth::user()->perfil_id==1) {{--administrador--}}
                <li id="lnk-lista-usuarios" data-toggle="collapse" data-target="#usuarios" class="collapsed">
                    <a href="{{action('UsuarioController@lista')}}">
                        <i class="fa fa-users fa-lg"></i> Usu&aacute;rios{{-- <span class="arrow"></span>--}}</a>
                </li>
                <li data-toggle="collapse" data-target="#lojas" class="collapsed">
                    <a href="{{action('LojaController@lista')}}"><i class="fa fa-shopping-cart fa-lg"></i> Lojas {{--<span class="arrow"></span>--}}</a>
                </li>
                <li data-toggle="collapse" data-target="#relatorios" class="collapsed">
                    <a href="#"><i class="fa fa-pie-chart fa-lg"></i> Relat&oacute;rios <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="relatorios">
                    <li><a href="{{ action('RelatorioController@usuariosCadastrados') }}">Usu&aacute;rios</a></li>
                    <li><a href="{{ action('RelatorioController@lojistasCadastrados') }}">Lojas</a></li>
                    <li><a href="{{ action('RelatorioController@produtosCadastrados') }}">Produtos</a></li>
                    <li><a href="{{ action('RelatorioController@produtosMaisPesquisados') }}">Produtos Mais Pesquisados</a></li>
                    <li><a href="{{ action('RelatorioController@lojasMaisVenderamView') }}">Lojas Mais Venderam</a></li>
                </ul>
                <li>
                    <a href="{{action('LojaController@listaLojasAprovacao')}}">
                        <i class="fa fa-check fa-lg" aria-hidden="true"></i> Aprovar lojas
                    </a>
                </li>
                <li>
                    <a href="{{action('ProdutoController@listaProdutosAprovacao')}}">
                        <i class="fa fa-beer fa-lg"></i> Aprovar bebidas
                    </a>
                </li>
                <li>
                    <a href="{{ url('/') }}">
                        <i class="fa fa fa-globe fa-lg"></i> Site
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa fa-sign-out fa-lg"></i> Sair
                    </a>
                </li>
            @elseif(Auth::user()->perfil_id==2) {{--clientes--}}
                <li id="lnk-lista-compras">
                    <a href="{{action('UsuarioController@listaCompras', Auth::id())}}">
                        <i class="fa fa-tasks fa-lg" aria-hidden="true"></i> Meus Pedidos</a>
                </li>
                <li>
                    <a href="{{ url('/') }}">
                        <i class="fa fa fa-globe fa-lg"></i> Site
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa fa-sign-out fa-lg"></i> Sair
                    </a>
                </li>
            @elseif(Auth::user()->perfil_id==3) {{--Proprietarios de Lojas--}}
                <li data-toggle="collapse" data-target="#lojas" class="collapsed">
                    <a href="{{action('LojaController@lista')}}"><i class="fa fa-shopping-cart fa-lg"></i> Lojas {{--<span class="arrow"></span>--}}</a>
                </li>
                <li data-toggle="collapse" data-target="#relatorios" class="collapsed">
                    <a href="#"><i class="fa fa-pie-chart fa-lg"></i> Relat&oacute;rios <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="relatorios">
                    <li><a href="{{ action('RelatorioController@produtosMaisVendidosView') }}">Produtos Mais Vendidos</a></li>
                    <li><a href="{{ action('RelatorioController@produtosMaisPesquisados') }}">Produtos Mais Pesquisados</a></li>
                </ul>
                <li>
                    <a href="{{ url('/') }}">
                        <i class="fa fa fa-globe fa-lg"></i> Site
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa fa-sign-out fa-lg"></i> Sair
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
