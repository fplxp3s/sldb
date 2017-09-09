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
                    <li><a href="#" style="padding-left:0; color: #3097D1;"><strong>COMPRAR!</strong></a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Criar Conta</a></li>
                    <li><a href="#">Ajuda/Contato</a></li>
                    <li><a href=""><span style="font-size: 18px" class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                    <li><a href=""><span style="font-size: 18px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
                @else
                    <li><a href="#">Ajuda/Contato</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('painel') }}">Painel de Controle</a>
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
                    <li><a href=""><span style="font-size: 18px" class="glyphicon glyphicon-search" aria-hidden="true"></span></a></li>
                    <li><a href=""><span style="font-size: 18px" class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>