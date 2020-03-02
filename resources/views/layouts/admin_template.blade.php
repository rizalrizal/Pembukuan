<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pembukuan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset("template/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("template/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset("template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset("template/plugins/select2/css/select2.min.css")}}">
  <link rel="stylesheet" href="{{ asset("template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset("template/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset("template/plugins/jqvmap/jqvmap.min.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("template/dist/css/adminlte.min.css")}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset("template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset("template/plugins/daterangepicker/daterangepicker.css")}}">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset("template/plugins/summernote/summernote-bs4.css")}}">
  <!-- dropdown logout -->
  <link rel="stylesheet" href="{{ asset("template/dist/css/_dropdown.scss")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 <!-- Header -->
    @include('header')

    <!-- Sidebar -->
    @include('sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       @yield('content-header')
      <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('footer')

</div><!-- ./wrapper -->


<!-- jQuery -->
<script src="{{ asset("template/plugins/jquery/jquery.min.js")}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset("template/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset("template/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- Select2 -->
<script src="{{ asset("template/plugins/select2/js/select2.full.min.js")}}"></script>
<!-- DataTables -->
<script src="{{ asset("template/plugins/datatables/jquery.dataTables.js")}}"></script>
<script src="{{ asset("template/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>
<!-- ChartJS -->
<script src="{{ asset("template/plugins/chart.js/Chart.min.js")}}"></script>
<!-- Sparkline -->
<script src="{{ asset("template/plugins/sparklines/sparkline.js")}}"></script>
<!-- JQVMap -->
<script src="{{ asset("template/plugins/jqvmap/jquery.vmap.min.js")}}"></script>
<script src="{{ asset("template/plugins/jqvmap/maps/jquery.vmap.world.js")}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset("template/plugins/jquery-knob/jquery.knob.min.js")}}"></script>
<!-- daterangepicker -->
<script src="{{ asset("template/plugins/moment/moment.min.js")}}"></script>
<script src="{{ asset("template/plugins/daterangepicker/daterangepicker.js")}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset("template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js")}}"></script>
<!-- Summernote -->
<script src="{{ asset("template/plugins/summernote/summernote-bs4.min.js")}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset("template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("template/dist/js/adminlte.js")}}"></script>
<script src="{{ asset("js/main.js")}}"></script>
@yield('addscript')
</body>
</html>


