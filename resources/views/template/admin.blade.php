<!DOCTYPE html>
<html lang="en" style="--theme-deafult: #168eea; --theme-secondary: #90b4cd;">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets') }}/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/favicon.png" type="image/x-icon">
    <title>Toko Ternak - {{ $title }}</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/button-builder.css">
    @yield('cssplugins')
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('assets') }}/css/color-3.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/css/responsive.css">
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-main-header">
            <div class="main-header-right row m-0">
                <div class="main-header-left">
                    <div class="logo-wrapper"><a href="index.html">Toko Ternak</a></div>
                    <div class="dark-logo-wrapper"><a href="index.html">Toko Ternak</a></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center"
                            id="sidebar-toggle"></i></div>
                </div>
                <div class="nav-right col pull-right right-menu p-0">
                    <ul class="nav-menus">
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i
                                    data-feather="maximize"></i></a></li>
                        <li class="onhover-dropdown">
                            <div class="notification-box"><i data-feather="bell"></i><span id="bellMasuk"
                                    class="dot-animated"></span>
                            </div>
                            <ul class="notification-dropdown onhover-show-div">

                                <li class="noti-primary">
                                    <a href="{{ route('admin.order.masuk') }}" class="">
                                        <div class="media"><span class="notification-bg bg-light-primary"><i
                                                    data-feather="activity"> </i></span>
                                            <div class="media-body">
                                                <p>Order masuk </p><span id="orderMasuk"></span>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="onhover-dropdown p-0">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-primary-light" type="submit"><a href="login_two.html"><i
                                            data-feather="log-out"></i>Log out</a></button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
        <!-- Page Header Ends                              -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper horizontal-menu">
            <!-- Page Sidebar Start-->
            <header class="main-nav">
                <div class="sidebar-user text-center"><a class="setting-primary"
                        href="{{ route('admin.profil') }}"><i data-feather="settings"></i></a><img
                        class="img-90 rounded-circle" src="{{ asset('assets') }}/images/dashboard/1.png"
                        alt="">
                    <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a
                        href="user-profile.html">
                        <h6 class="mt-3 f-14 f-w-600">{{ Session::get('email') }}</h6>
                    </a>
                    <p class="mb-0 font-roboto">Admin</p>
                </div>
                <nav>
                    <div class="main-navbar">
                        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                        <div id="mainnav">
                            <ul class="nav-menu custom-scrollbar">
                                <li class="back-btn">
                                    <div class="mobile-back text-end"><span>Back</span><i
                                            class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                </li>
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6>General </h6>
                                    </div>
                                </li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('admin') }}"><i
                                            data-feather="home"></i><span>Dashboard</span></a></li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('operator.index') }}"><i
                                            data-feather="user"></i><span>Operator</span></a></li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('peternak.index') }}"><i
                                            data-feather="user"></i><span>Peternak</span></a></li>

                                <li class="sidebar-main-title">
                                    <div>
                                        <h6>Hewan </h6>
                                    </div>
                                </li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('jenishewan.index') }}"><i
                                            data-feather="settings"></i><span>Jenis Hewan</span></a></li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('hewan.index') }}"><i data-feather="feather"></i><span>Hewan
                                            Ternak</span></a></li>
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6>Transaksi </h6>
                                    </div>
                                </li>
                                <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i
                                            data-feather="tag"></i><span>Transaksi</span></a>
                                    <ul class="nav-submenu menu-content">
                                        <li><a href="{{ route('admin.order.masuk') }}">Order Masuk</a></li>
                                        <li><a href="{{ route('admin.order.diproses') }}">Order Diproses</a></li>
                                        <li><a href="{{ route('admin.order.selesai') }}">Order Selesai</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a class="nav-link menu-title link-nav"
                                        href="{{ route('admin.laporan') }}"><i
                                            data-feather="file-text"></i><span>Laporan Transaksi</span></a></li>
                            </ul>
                        </div>
                        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                    </div>
                </nav>
            </header>
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                @yield('content')
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2021-22 © viho All rights reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="pull-right mb-0">Hand crafted & made with <i
                                    class="fa fa-heart font-secondary"></i></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="{{ asset('assets') }}/js/jquery-3.5.1.min.js"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets') }}/js/icons/feather-icon/feather.min.js"></script>
    <script src="{{ asset('assets') }}/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets') }}/js/sidebar-menu.js"></script>
    <script src="{{ asset('assets') }}/js/config.js"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets') }}/js/bootstrap/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/bootstrap/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{ asset('assets') }}/js/notify/notify-script.js"></script>
    <!-- Plugins JS start-->
    @yield('jsplugins')
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('assets') }}/js/script.js"></script>
    {{-- <script src="{{ asset('assets') }}/js/theme-customizer/customizer.js"></script> --}}
    <!-- login js-->
    <!-- Plugin used-->
    <script>
        function successAlert(msg) {
            $.notify({
                title: 'Succes',
                message: msg,
            }, {
                type: 'success',
                allow_dismiss: false,
                newest_on_top: false,
                mouse_over: false,
                showProgressbar: false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animated bounce',
                    exit: 'animated bounce'
                }
            });
        }

        function orderAlert(title, msg, url) {
            $.notify({
                title: title,
                message: msg,
                url: '{{ route('admin') }}',
                target: '_blank'
            }, {
                type: 'warning',
                allow_dismiss: true,
                newest_on_top: true,
                mouse_over: false,
                showProgressbar: false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'left'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animated bounce',
                    exit: 'animated bounce'
                }
            });
        }

        function dangerAlert(msg) {
            $.notify({
                title: 'Failed',
                message: msg
            }, {
                type: 'danger',
                allow_dismiss: false,
                newest_on_top: false,
                mouse_over: false,
                showProgressbar: false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animated bounce',
                    exit: 'animated bounce'
                }
            });
        }

        function doPoll() {
            // Get the JSON

            $.ajax({
                url: '{{ route('ajax.notifikasi') }}',
                type: 'get',
                success: function(data) {

                    if (data != null) {
                        // Yeah, there is a new notification! Show it to the user
                        data.forEach(row => {
                            orderAlert(row.notifikasi_judul, row.notifikasi_isi, row.notifikasi_url)
                        });

                    }
                },
                dataType: "json"
            });
            $.ajax({
                url: '{{ route('ajax.orderMasuk') }}',
                type: 'get',
                success: function(data) {

                    if (data != null) {
                        // Yeah, there is a new notification! Show it to the user
                        if (data > 0) {
                            $('#bellMasuk').attr('class', 'dot-animated')
                        } else {
                            $('#bellMasuk').attr('class', '')
                        }
                        $('#orderMasuk').text(data + ' order baru masuk!')
                    }

                },
                dataType: "json"
            });
            // Retry after a second
            setTimeout(doPoll, 10000);
        }
        doPoll();
    </script>
    @yield('scripts')
</body>

</html>
