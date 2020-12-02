<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />

        <title>AdiTime | @yield('title')</title>

        <!-- Font Awesome Icons -->
        <link
            rel="stylesheet"
            href="/dist/plugins/fontawesome-free/css/all.min.css"
        />
        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/adminlte.min.css" />
        <!-- Google Font: Source Sans Pro -->
        <link
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
            rel="stylesheet"
        />
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <nav
                class="main-header navbar navbar-expand navbar-white navbar-light"
            >
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-widget="pushmenu"
                            href="#"
                            role="button"
                            ><i class="fas fa-bars"></i
                        ></a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge"
                                >15</span
                            >
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                        >
                            <span class="dropdown-header"
                                >15 Notifications</span
                            >
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new
                                messages
                                <span class="float-right text-muted text-sm"
                                    >3 mins</span
                                >
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend
                                requests
                                <span class="float-right text-muted text-sm"
                                    >12 hours</span
                                >
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm"
                                    >2 days</span
                                >
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer"
                                >See All Notifications</a
                            >
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img
                        src="dist/img/logo-adimaker.png"
                        alt="Adimaker Logo"
                        class="brand-image"
                        style="opacity: 0.8"
                    />
                    <span class="brand-text font-weight-light">AdiTime</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img
                                src="dist/img/user2-160x160.jpg"
                                class="img-circle"
                                alt="User Image"
                            />
                        </div>
                        <div class="info">
                        <a href="#" class="d-block">{{Auth::user()->name}} {{Auth::user()->surname}}</a>
                        <a class="d-block text-muted">{{Auth::user()->classgroup()->first()->name}}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i
                                        class="nav-icon fas fa-tachometer-alt"
                                    ></i>
                                    <p>
                                        Starter Pages
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link active">
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Active Page</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i
                                                class="far fa-circle nav-icon"
                                            ></i>
                                            <p>Inactive Page</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Simple Link
                                        <span class="right badge badge-danger"
                                            >New</span
                                        >
                                    </p>
                                </a>
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
                                <h1 class="m-0 text-dark">Starter Page</h1>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Starter Page
                                    </li>
                                </ol>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Développé en 2020
                </div>
                <!-- Default to the left -->
                <strong
                    >Copyright &copy; 2020
                    <a href="https://www.adimaker.fr/">Adimaker</a>.</strong
                >
                Tous droits réservés.
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="/dist/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/dist/js/adminlte.min.js"></script>
    </body>
</html>
