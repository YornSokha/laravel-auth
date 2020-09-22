<html>
<head>
    <title>MLMUPC-ACCOUNTING-@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/app.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/simple-sidebar.css')  }}">
    <link rel="stylesheet" href="{{ asset('css/font.css')  }}">
    {{--    <script type="text/javascript" src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="https://fonts.googleapis.com/css?family=Kantumruy&display=swap" rel="stylesheet">

    {{--    font awesome--}}
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    {{--    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript"
            src="http://datatables.net/download/build/dataTables.tableTools.nightly.js?_=60133663e907c73303e914416ea258d8"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
    @yield('style')
</head>
<body class="app header-fixed sidebar-fixed sidebar-lg-show">
<header class="app-header navbar">
    <button id="hamburger" class="navbar-toggler sidebar-toggler d-lg-none" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a href="#" class="navbar-brand">
        <h2>Mlmupc</h2>
    </a>
    <ul id="avata" class="nav navbar-nav ml-auto">
        <li id="avata-dropdown" class="nav-item dropdown">
            <a role="button" class="dropdown-toggle nav-link">
                <span>
                                            <img
                                                src="/media/3/conversions/F9qvv57FCesWgk2JdJo5l325x2zlMe0BDAHoIByo-thumb_150.jpg"
                                                class="avatar-photo">

                                            <span class="hidden-md-down">BabyIT </span>

                </span>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center"><strong>Account</strong></div>
                <a href="http://127.0.0.1:8000/admin/profile" class="dropdown-item"><i class="fa fa-user"></i>
                    Profile</a>
                <a href="http://127.0.0.1:8000/admin/password" class="dropdown-item"><i class="fa fa-key"></i> Password</a>

                <a href="http://127.0.0.1:8000/admin/logout" class="dropdown-item"><i class="fa fa-lock"></i> Logout</a>
            </div>
        </li>
    </ul>
</header>
<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav ps">
            <ul class="nav">
                <li class="nav-title" style="display: none;">Content</li>
                <li class="nav-title">Settings</li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/expense') }}">ចំណាយ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/revenue') }}">ចំណូល</a></li>

            </ul>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
        </nav>
        <button id="minimizer" class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>

    @yield('app')
</div>
<script>
    $(document).ready(function () {
        let minimizerClick = 0;
        let hamburgerClick = 0;
        let avataClick = 0;
        $('#minimizer').click(function () {
            minimizerClick++;
            if (minimizerClick % 2 === 1) {
                $('body').addClass('brand-minimized sidebar-minimized');
            } else {
                $('body').removeClass('brand-minimized sidebar-minimized');
            }
        })
        $('#hamburger').click(function () {
            hamburgerClick++;
            if (hamburgerClick % 2 === 1) {
                $('body').addClass('sidebar-show');
            } else {
                $('body').removeClass('sidebar-show');
            }
        })
        $('#avata-dropdown').click(function () {
            avataClick++;
            if (avataClick % 2 === 1) {
                $('#avata-dropdown').addClass('open');
            } else {
                $('#avata-dropdown').removeClass('open');
            }
        })
    })
</script>
</body>
</html>
