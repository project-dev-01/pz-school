@include('forum-includes.header')

<body>
    <!-- tt-mobile menu -->
    @include('forum-includes.navbar')
    @yield('content')
    @include('forum-includes.footer')
    @yield('scripts')

</body>

</html>