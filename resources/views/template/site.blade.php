@include('site.header')

<body>
    <div id="app">

        @include('site.navigation')

        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js', env("HTTPS")) }}"></script>
    {{--<script src="{{ asset('js/bootstrap.min.js') }}"></script>--}}
</body>
</html>
