<?php use Gloudemans\Shoppingcart\Facades\Cart; ?>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <strong>{{ config('app.name') }}</strong>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                    <li><a href="#" style="padding-left: 20px; cursor: default">COMPRE COM A GENTE E ENCONTRE AS MELHORES OFERTAS.</a> </li>
                    {{--<li><a href="#" style="padding-left:0; color: #3097D1;"><strong>COMPRAR!</strong></a></li>--}}
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Criar Conta</a></li>
                    <li><a href="/quemsomos">Quem Somos</a></li>
                    <li><a href="/contato">Contato</a></li>
                @else
                    <li><a href="/quemsomos">Quem Somos</a></li>
                    <li><a href="/contato">Contato</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                @if (Auth::user()->perfil_id==2) {{--Cliente--}}
                                    <a href="{{ route('site.painel') }}">Meus Pedidos</a>
                                @else
                                    <a href="{{ route('site.painel') }}">Painel de Controle</a>
                                @endif
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Sair
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif

                {{--Search--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span style="font-size: 18px" class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu" style="width: 425px;padding: 20px;">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" name="texto-busca" id="texto-busca" class="form-control" placeholder="Nome do Produto">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button">Buscar</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                {{--Shopping Cart--}}
                <li style="background-color: #3097D1;">
                    <a href="#" data-toggle="modal" data-target="#cart-modal">
                        <span style="font-size: 18px; color: white" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                        <span class="badge" style="background-color: #f8ac31 !important;">{{Cart::count()}}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="container-fluid" style="background-color: #636b6f">
        <div class="sub-menu container">
            <ul class="nav navbar-nav">
                <?php use sldb\Models\Categoria;$categorias = Categoria::all(); ?>
                @foreach($categorias as $categoria)
                    <li><a href="{{action('SiteController@listaProdutosPorCategoria', $categoria->descricao)}}">{{$categoria->descricao}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="container-fluid" style="background-color: #2a88bd">
        <div class="sub-menu container">
            <ol class="page-breadcrumb">
                <li>
                    <i class="fa fa-home" style="color: white">&nbsp;</i>
                    <a href="{{route('site.index')}}">Home&nbsp;</a>
                    <i class="fa fa-angle-right" style="color: white">&nbsp;</i>
                </li>
                @for($i = 0; $i <= count(Request::segments()); $i++)
                    <li>
                        @if($i==count(Request::segments()))
                            <a href="" style="color: #f8b73d !important; font-weight: 300">{{Request::segment($i)}}&nbsp;</a>
                        @else
                            <a href="">{{Request::segment($i)}}&nbsp;</a>
                        @endif
                        @if($i < count(Request::segments()) & $i > 0)
                            {!!'<i class="fa fa-angle-right" style="color: white">&nbsp;</i>'!!}
                        @endif
                    </li>
                @endfor
            </ol>
        </div>
    </div>
</nav>