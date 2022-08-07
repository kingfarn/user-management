<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendors/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendors/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/dist/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('vendors/plugins/sweetalert2/sweetalert2.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" role="button">
                        <i class="fas fa-align-right mt-2"></i>
                    </a>
                </li>
            </ul>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="/images/{{ Auth::user()->image }}" class="p-1 mb-1" height="30px" width="35px">
                        <i class="fas fa-braille"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <div class="nav">
                            <div class="nav-body">


                                <a class="dropdown-item" href="{{ route('users.profile', Auth::user()->id) }}">
                                    <i class="fas fa-id-card"></i>
                                    <span class="ml-1">{{ __('View Profle') }}</span>
                                </a>

                                <a class="dropdown-item " href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> <span class="ml-1">{{ __('Log Out') }}</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- /.navbar -->
        <div>
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-3">
                <!-- Brand Logo -->
                <span><img src="{{ asset('vendors/dist/img/Logo.png') }}" class="w-100 p-2"></span>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="{{ URL::to('dashboard') }}" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item menu-open">
                                <a href="#" class="nav-link " class="nav-link active">
                                    <i class="nav-icon fas fa-users-cog"></i>
                                    <p>
                                        User Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                @can('user.view')
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ URL::to('users') }}" class="nav-link ">
                                                <i class="far fa-user"></i>
                                                <p>Users</p>
                                            </a>
                                        </li>
                                    </ul>
                                @endcan

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ URL::to('roles') }}" class="nav-link ">
                                            <i class="fas fa-user-tag"></i>
                                            <p>Roles</p>
                                        </a>
                                    </li>
                                </ul>

                            </li>

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
        </div>
