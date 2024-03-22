@include('includes.header')
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

        @include('includes.navbar')

        @include('includes.sidebar')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div> <!-- content -->
            <!-- insert here url in the array -->
            @php
                $urlAr = [
                    'admin/student',
                    'admin/dashboard',
                    'parent/index',
                    'employee/employeelist',
                    'school_role/index',
                ];
            @endphp
            @include('includes.footer')
            @if (in_array(request()->path(), $urlAr))
                @include('includes.js')
            @endif

            @yield('scripts')

</body>

</html>