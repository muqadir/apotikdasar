<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>Go Ready| Dashboard</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        
        
       
      
        <!-- Google Font: Source Sans Pro -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <!-- iCheck -->
        {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
        <!-- JQVMap -->
        {{-- <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}"> --}}
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/datatables.css') }}">
        <link rel="stylesheet" href="{{ asset('sweetalert2/css/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/adminlte/plugins/toastr/toastr.min.css') }}">
      
      
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ asset('select2/dist/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.css') }}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
        
          <!-- Preloader -->
          <div class="preloader flex-column justify-content-center align-items-center">
            {{-- <img class="animation__shake" src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60"> --}}
          </div>
        
          <!-- Navbar -->
          <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
        
            </ul>
        
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
        
                        <x-dropdown-link :href="route('logout')" class="btn btn-sm btn-info"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
        
                </li>
        
        
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                    <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}
            </ul>
          </nav>
          <!-- /.navbar -->
        
          <!-- Main Sidebar Container -->
          <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="brand-link">
              <img src="{{ asset('adminlte/dist/img/pemdaaceh.png') }}" alt="RSJ Aceh Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light">Apotik </span>
            </a>
        
            <!-- Sidebar -->
            <div class="sidebar">
              <!-- Sidebar user panel (optional) -->
              <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                  {{-- <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
                </div>
                <div class="info">
                  <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                </div>
              </div>
        
              <!-- SidebarSearch Form -->
              <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                    </button>
                  </div>
                </div>
              </div>
        
              <!-- Sidebar Menu -->
              <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
                @role('superadmin')
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-database"></i>
                      <p>
                       Data Master
                        <i class="fas fa-angle-left right"></i>
        
                      </p>
                    </a>
        
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('supplier.index') }}" class="nav-link">
                          <i class="fas fa-shopping-basket nav-icon"></i>
                          <p>Suplayer</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('obat.index') }}" class="nav-link">
                          <i class="fas fa-shopping-basket nav-icon"></i>
                          <p>Obat</p>
                        </a>
                      </li>
                     
                      <li class="nav-item">
                        <a href="{{ route('stock.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Stock Obat</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('pembayaran.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Penjualan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('opname.index') }}" class="nav-link">
                          <i class="nav-icon fas fa-laptop-medical"></i>
                          <p>Opname Barang</p>
                        </a>
                      </li>
                    </ul>
                  </li>
        
                  <i class="fas fa-analytics"></i>
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-balance-scale"></i>
                      <p>
                        Transaksi
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('penjualan.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Penjualan Barang</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('belanja.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Pembelian Barang</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('laporan.index') }}" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Laporan </p>
                        </a>
                      </li>
        
                    </ul>
                  </li>
                  <li class="nav-header">Setting</li>
        
        
        
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas  fa-cog"></i>
                      <p>Setting</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('management.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>User Management</p>
                    </a>
                  </li>
                @endrole
        
                @role('gudang|helper_gudang|role_kasir')
                  <li class="nav-item">
                    <a href="{{ route('obat.index')}}" class="nav-link">
                      <i class="nav-icon fas fa-shopping-basket"></i>
                      <p>Katalog</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('stock.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tablets"></i>
        
                      <p>Stock Obat</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('opname.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-laptop-medical"></i>
                      <p>Opname Barang</p>
                    </a>
                  </li>
                @endrole
        
                @role('kasir')
        
                  <li class="nav-item">
                    <a href="{{ route('stock.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-database"></i>
                      <p>Stock Obat</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('penjualan.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-shopping-basket"></i>
                      <p>Transaksi Penjualan</p>
                    </a>
                  </li>
                @endrole
                </ul>
              </nav>
              <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
          </aside>
        
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{-- <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div> --}}
            <!-- /.content-header -->
        
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
        
                <!-- Small boxes (Stat box) -->
        
                @role('superadmin')
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>150</h3>
        
                        <p>New Orders</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
        
                        <p>Bounce Rate</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3>44</h3>
        
                        <p>User Registrations</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3>65</h3>
        
                        <p>Unique Visitors</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
                @endrole
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                  <!-- Left col -->
                  <section class="col-lg-12 connectedSortable">
        
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">
                          {{-- <i class="fas fa-chart-pie mr-1"></i>
                          Apotik --}}
                        </h3>
        
                        <main>
                            {{ $slot }}
                        </main>
                      </div>
        
                    </div>
        
                  </section>
        
                </div>
                <!-- /.row (main row) -->
              </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
          <footer class="main-footer">
            {{-- <strong>Copyright &copy; 2014-2021 <a href="#">Muqadir, ST</a>.</strong>
            All rights reserved. --}}
            <div class="float-center text-center d-none d-sm-inline-block">
              <strong>Copyright &copy; 2014-2021 <a href="#">Muqadir, ST</a>.</strong> All rights reserved.
            </div>
            <div class="float-right d-none d-sm-inline-block">
              <b>Version</b> 3.2.0
            </div>
          </footer>
        
          <!-- Control Sidebar -->
          <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
          </aside>
          <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        
        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- ChartJS -->
        <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
        <!-- Sparkline -->
        {{-- <script src="{{ asset('adminlte/plugins/sparklines/sparkline.js') }}"></script> --}}
        <!-- JQVMap -->
        {{-- <script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
        {{-- <script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
        <!-- jQuery Knob Chart -->
        {{-- <script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
        <!-- daterangepicker -->
        {{-- <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script> --}}
        
        <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        {{-- <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
        <!-- Summernote -->
        {{-- <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
        <!-- overlayScrollbars -->
        <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        {{-- <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script> --}}
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
        @stack('js')
        </body>

</html>
