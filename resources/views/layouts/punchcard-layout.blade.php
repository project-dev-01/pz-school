@include('punch_card_includes.header')
@yield('css')
</head>

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    <!-- add spinner  -->
    <!-- <div id="overlay">
    <div class="cv-spinner">
        <span class="spinner"></span>
    </div>
</div> -->
    <div id="overlay">
        <div class="lds-spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        <div class="container">
            <div class="content">
                @yield('content')
            </div> <!-- content -->
            @include('punch_card_includes.footer')
            @yield('scripts')
        </div>

</body>

</html>