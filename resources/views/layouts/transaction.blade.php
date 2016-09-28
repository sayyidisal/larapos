@include('partials.header')

<body>
    @include('partials.navbar')

    @include('partials.notification')

    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/all.js"></script>
</body>
</html>
