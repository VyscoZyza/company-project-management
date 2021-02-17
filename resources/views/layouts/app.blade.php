<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/logo-BRI.png')}}">
    <title>BRI Kanwil Semarang</title>
    <link rel="stylesheet" href=" {{asset('bootstrap-4.0.0/dist/css/bootstrap.min.css')}} ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />


    <!-- Ajax -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- -------------- -->
    <!-- <script src="//code.jquery.com/jquery-3.1.0.slim.min.js"></script> -->
    <script src="table-progressbarify.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Ion Slider -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}">
    <!-- bootstrap slider -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/bootstrap-slider/css/bootstrap-slider.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('lte/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <style>
        .font-sidebar i,
        p {
            font-size: 14px !important;
        }
    </style>
</head>
<style type="text/css">
    .blue {
        background-color: #292f4c;
        color: white;
    }

    .bl {
        color: #292f4c;
    }

    .bg {
        background-color: #f4f6f9;
    }

    .navbar {
        -webkit-border-radius: 0;
        -moz-border-radius: 0;
        border-radius: 0;
    }

    .exit {
        background: #dc3545;
        border-top-left-radius: 10% 10%;
        border-bottom-left-radius: 10% 10%;
        border-top-right-radius: 10% 10%;
        border-bottom-right-radius: 10% 10%;
    }

    .container {
        margin-top: 150px;
    }

    table.dataTable thead th {
        border-bottom: none;
    }

    .page-item.active .page-link {
        background-color: blue !important;
        border: none;
    }

    .page-link {
        color: blue !important;
    }

    table.dataTable.no-footer {
        border-bottom: 0 !important;
    }

    h4 {
        margin-bottom: 30px;
    }

    #example_filter input {
        border-radius: 100px;
    }



    .bubble {
        margin-left: -15px;

    }

    .dropdown-caret {
        color: blue;
    }

    .page-item.active .page-link {
        background-color: lightgrey !important;
        border: 1px solid black;
    }

    .page-link {
        color: black !important;
    }

    /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg border-0">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars bl"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->

                <!-- Authentication Links -->

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <i class="fas fa-gear bl"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('password.edit') }}">
                            {{ __('Ganti Password') }}
                        </a>


                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(rgba(41, 47, 76, 1), rgba(41, 47, 76, 1)),  url('/dist/img/img1.jpg') !important; background-position:  center !important; background-repeat: no-repeat !important; background-size: cover !important; color: white !important; ">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{asset('img/Side-Logo.png')}}" alt="Logo" class="brand-image" style="display: block; margin-left: auto!important; margin-right: auto!important; width: 95%; max-height: 70px;">
                <br> <br>
                {{-- <span class="brand-text font-weight-light">Bank Rakyat Indonesia</span> --}}
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://gitlabcommitvirtual.com/wp-content/uploads/2020/06/person-dummy-e1553259379744.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
                        <li class="nav-item font-sidebar">
                            <a href="{{ route('home.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p class="text-white">
                                    Beranda
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Task
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('my.task') }}" class="nav-link">
                                        <i class="ml-4"></i>
                                        <p>My Task</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    @if (Auth::user()->level == 01)
                                    <a href="{{ route('company.task') }}" class="nav-link">
                                        <i class="ml-4"></i>
                                        <p>Company Task</p>
                                    </a>
                                    @else
                                    <a href=" {{ route('team.task') }}" class="nav-link">
                                        <i class="ml-4"></i>
                                        <p>Team Task</p>
                                    </a>
                                    @endif
                                </li>
                            </ul>
                        </li>

                        <li class=" nav-item font-sidebar">

                            <a href="{{ route('history') }}" class="nav-link">
                                <i class="nav-icon fas fa-clock"></i>
                                <p class="text-white">
                                    Riwayat

                                </p>
                            </a>

                        </li>
                        <li class="nav-item font-sidebar">
                            @if (Auth::user()->level == 04)
                            <a href="{{ route('team') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-white">
                                    Lihat Team

                                </p>
                            </a>
                            @elseif(Auth::user()->level == 03)
                            <a href="{{ route('staff') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-white">
                                    Lihat Staff

                                </p>
                            </a>
                            @elseif(Auth::user()->level == 02)
                            <a href="{{ route('staff') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-white">
                                    Lihat Staff

                                </p>
                            </a>
                            @elseif(Auth::user()->level == 01)

                            @endif
                        </li>
                        <li class="nav-item font-sidebar">
                            @if (Auth::user()->level == 04)

                            @elseif(Auth::user()->level == 03)
                            <a href="{{ route('supervisor') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-white">
                                    Lihat Supervisor

                                </p>
                            </a>
                            @elseif(Auth::user()->level == 02)
                            <a href="{{ route('supervisor') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-white">
                                    Lihat Supervisor

                                </p>
                            </a>
                            @elseif(Auth::user()->level == 01)
                            <a href="{{ route('kabag') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-white">
                                    Lihat Kabag

                                </p>
                            </a>
                            @endif
                        </li>
                        <li class="nav-item font-sidebar">
                            @if (Auth::user()->level == 02)
                            <a href="{{ route('list') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-white">
                                    Daftar Staff

                                </p>
                            </a>
                            @elseif (Auth::user()->level == 01)
                            <a href="{{ route('list2') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-white">
                                    Daftar Staff

                                </p>
                            </a>
                            @endif
                        </li>


                        <li class="nav-item font-sidebar exit">




                            <a class="nav-link  " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa fa-sign-out"></i>
                                <p class="text-white">
                                    Keluar

                                </p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2021.</strong>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- DataTables -->
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('lte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
</body>

</html>