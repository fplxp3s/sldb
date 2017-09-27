@include('site.header')

<body>
    <div id="app">

        @include('site.navigation')

        <div class="container-fluid">
            @yield('content')
        </div>

        @include('site.cart')
        @include('site.verifica-maioridade')
        @include('site.footer')

    </div>

    <div class="loading-modal"></div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/ajaxCalls.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBc1rtaXEKkzBlD9jusfkdV0WOQ5cFQa8&callback=initMap" async defer></script>
    <script src="https://hpneo.github.io/gmaps/gmaps.js"></script>
    <script>
        $(document).ready(function () {
            var msg = sessionStorage.getItem("msg");
            if(msg!=null && msg!='' && msg!=undefined) {
                alert(msg);
                sessionStorage.removeItem('msg');
            }
        });
        $(document).ready(function() {
            var perguntaRespondida = sessionStorage.getItem('maioridadeRespondida');

            if(!perguntaRespondida) {
                $('#maioridade-modal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }

        });
    </script>
</body>
</html>
