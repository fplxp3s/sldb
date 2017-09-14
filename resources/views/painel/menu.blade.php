<div class="nav-side-menu">
    <div class="brand"><i class="fa fa-dashboard fa-md"></i>&nbsp;&nbsp;Dashboard</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out">

            <li id="lnk-lista-usuarios" data-toggle="collapse" data-target="#usuarios" class="collapsed">
                <a href="{{action('UsuarioController@lista')}}">
                <i class="fa fa-users fa-lg"></i> Usu&aacute;rios{{-- <span class="arrow"></span>--}}</a>
            </li>
            {{--<ul class="sub-menu collapse" id="usuarios">--}}
                {{--<li id="novo-usuario"><a href="{{action('UsuarioController@novo')}}">Novo</a></li>--}}
                {{--<li id="lista-usuario"><a href="{{action('UsuarioController@lista')}}">Listar</a></li>--}}
                {{--<li id="busca-usuario"><a href="#">Buscar</a></li>--}}
            {{--</ul>--}}

            <li data-toggle="collapse" data-target="#lojas" class="collapsed">
                <a href="{{action('LojaController@lista')}}"><i class="fa fa-shopping-cart fa-lg"></i> Lojas {{--<span class="arrow"></span>--}}</a>
            </li>
            {{--<ul class="sub-menu collapse" id="lojas">
                <li class="active"><a href="#">CSS3 Animation</a></li>
                <li><a href="#">General</a></li>
                <li><a href="#">Buttons</a></li>
                <li><a href="#">Tabs & Accordions</a></li>
            </ul>--}}


{{--            <li data-toggle="collapse" data-target="#produtos" class="collapsed">
                <a href="{{action('ProdutoController@lista')}}"><i class="fa fa-credit-card fa-lg"></i> Produtos --}}{{--<span class="arrow"></span>--}}{{--</a>
            </li>--}}
            {{--<ul class="sub-menu collapse" id="produtos">
                <li>New Service 1</li>
                <li>New Service 2</li>
                <li>New Service 3</li>
                <li>New Service 3</li>
            </ul>--}}


            <li data-toggle="collapse" data-target="#relatorios" class="collapsed">
                <a href="#"><i class="fa fa-pie-chart fa-lg"></i> Relat&oacute;rios <span class="arrow"></span></a>
            </li>
            <ul class="sub-menu collapse" id="relatorios">
                <li>New New 1</li>
                <li>New New 2</li>
                <li>New New 3</li>
                <li>New New 3</li>
            </ul>

            <li>
                <a href="#aprovarbebidas">
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

        </ul>
    </div>
</div>
