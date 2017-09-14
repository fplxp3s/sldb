@include('site.header')

<body>
    <div id="app">

        @include('site.navigation')

        <div class="container-fluid">
            @yield('content')
        </div>

        @include('site.footer')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBc1rtaXEKkzBlD9jusfkdV0WOQ5cFQa8&callback=initMap" async defer></script>
    <script src="https://hpneo.github.io/gmaps/gmaps.js"></script>
</body>
</html>
