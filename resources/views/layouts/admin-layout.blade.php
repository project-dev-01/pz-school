@include('includes.header')
@yield('css')
</head>

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
<!-- add spinner  -->
<div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div>
    <!-- Begin page -->
    <div id="wrapper">

        @include('includes.navbar')

        @include('includes.sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div> <!-- content -->
            @include('includes.footer')
            @yield('scripts')

</body>

</html>