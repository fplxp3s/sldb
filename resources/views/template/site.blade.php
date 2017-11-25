@include('site.header')

<body>
    <div id="app">

        @include('site.navigation')

        <div class="container-fluid">
            @yield('content')
        </div>

        <div id="cart-container">
            @include('site.cart')
        </div>
        @include('site.verifica-maioridade')
        @include('site.footer')

    </div>

    <div class="loading-modal"></div>

    <div class="modal fade" tabindex="-1" role="dialog" id="produto-add-sucesso-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center" style="padding: 20px">
                        <h4 class="text-success">Produto adicionado ao Carrinho com sucesso!</h4>
                        <br>
                        <i class="fa fa-check-circle-o text-success" aria-hidden="true" style="font-size: 80px"></i>
                    </div>
                </div>
                <div class="modal-footer col-sm-offset-4" style="text-align: left">
                    <button type="button" class="btn btn-lg btn-success" data-dismiss="modal" style="width: 170px">Ok</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/ajaxCalls.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
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
