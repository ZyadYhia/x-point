<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>X-POINTS: @yield('title')</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href=" {{ asset('adminlte/css/fontawesome.all.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ asset('adminlte/css/adminlte.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="{{ asset('node-modules/sweetalert2/sweetalert2.min.css') }}">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            {{-- <a href="#" class="brand-link">
                <img src=" {{ asset('adminlte/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a> --}}

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src=" {{ asset('adminlte/img/user-profile.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#"
                            class="d-block">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        {{-- <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Sample Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Page one</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Page two</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ url('dashboard') }}"
                                class="nav-link @if (Route::is('dashboard')) active @else @endif">
                                {{-- <i class="nav-icon fas fa-th"></i> --}}
                                <i class="nav-icon fab fa-buromobelexperte"></i>
                                <p>
                                    Rooms
                                </p>
                            </a>
                        </li>
                        @if (Auth::user()->role->name !== 'client' and Auth::user()->role->name !== 'counter')
                            <li class="nav-item">
                                <a href="{{ url('dashboard/rooms/control') }}"
                                    class="nav-link @if (Route::is('control_room')) active @else @endif">
                                    {{-- <i class="nav-icon fas fa-th"></i> --}}
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Control Rooms
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role->name !== 'client')
                            <li class="nav-item">
                                <a href="{{ url('dashboard/invoices') }}"
                                    class="nav-link @if (Route::is('invoices')) active @else @endif">
                                    {{-- <i class="nav-icon fas fa-th"></i> --}}
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>
                                        Invoices
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role->name !== 'client' and Auth::user()->role->name !== 'counter')
                            <li class="nav-item">
                                <a href="{{ url('dashboard/reports') }}"
                                    class="nav-link @if (Route::is('reports')) active @else @endif">
                                    {{-- <i class="nav-icon fas fa-th"></i> --}}
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>
                                        Reports
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role->name == 'superadmin' or Auth::user()->role->name == 'admin')
                            <li class="nav-item">
                                <a href="{{ url('dashboard/users') }}"
                                    class="nav-link @if (Route::is('dashboard_users')) active  @else @endif">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Users
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->role->name == 'superadmin' or Auth::user()->role->name == 'admin')
                            <li class="nav-item">
                                <a href="{{ url('dashboard/clients') }}"
                                    class="nav-link @if (Route::is('dashboard_clients')) active  @else @endif">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Clients
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <template id="remove-template">
            <swal-title>
                Delete!!
            </swal-title>
            <swal-icon type="warning" color="red"></swal-icon>
            <swal-button type="confirm" color="red">
                Delete
            </swal-button>
            <swal-button type="cancel">
                Cancel
            </swal-button>
            <swal-param name="allowEscapeKey" value="false" />
            <swal-param name="customClass" value='{ "popup": "my-popup" }' />
        </template>
        <template id="demote-template">
            <swal-title>
                You're gonna lose your privileges as a <strong style="font-weight: 600;"> Super Admin </strong>
            </swal-title>
            <swal-icon type="warning" color="red"></swal-icon>
            <swal-button type="confirm" color="red">
                Demote
            </swal-button>
            <swal-button type="cancel">
                Cancel
            </swal-button>
            <swal-param name="allowEscapeKey" value="false" />
            <swal-param name="customClass" value='{ "popup": "my-popup" }' />
        </template>
        @include('dashboard.includes.messages')
        @include('dashboard.includes.errors')
        {{-- <button type="button" onclick="cli()" class="btn btn-success swalDefaultSuccess">
            Launch Success Toast
        </button> --}}
        @yield('main')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2022 <a href="">X-Point</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src=" {{ asset('adminlte/js/jquery.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src=" {{ asset('adminlte/js/bootstrap.bundle.js') }}"></script>
    <!-- AdminLTE App -->
    <script src=" {{ asset('adminlte/js/adminlte.js') }}"></script>
    {{-- SweetAlert2 --}}
    <script src="{{ asset('node-modules/sweetalert2/sweetalert2.all.min.js') }}"></script>
    {{-- Fontawesome --}}
    <script src="{{ asset('adminlte/js/fontawesome.all.min.js') }}"></script>
    {{-- Bootstrap switch --}}
    <script src="{{ asset('adminlte/js/bootstrap-switch.min.js') }}"></script>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        var remove = Swal.mixin({
            toast: true,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        $('.del').on('click', function(e) {
            e.preventDefault();
            let href = $(this).attr('href');
            remove.fire({
                template: '#remove-template'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = href
                }
            })
        });
        $('.dem').on('click', function(e) {
            e.preventDefault();
            let href = $(this).attr('href');
            remove.fire({
                template: '#demote-template'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = href
                }
            })
        });

        function cli() {
            Toast.fire({
                icon: 'success',
                title: 'lllllsss'
            })
        }
        if (document.getElementById('session_msg')) {
            Toast.fire({
                icon: 'success',
                title: document.getElementById('session_msg').value
            });
            // successEffect();
        }
        if (document.getElementById('session_error')) {
            Toast.fire({
                icon: 'error',
                title: document.getElementById('session_error').value
            });
            // errorEffect();
        }
    </script>
    @yield('scripts')
    @include('popper::assets')
</body>

</html>
