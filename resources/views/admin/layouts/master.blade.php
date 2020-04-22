<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="assets/admin/css/nunito.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="js/dist/jquery.fancybox.min.css" />
    <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       @include('admin.layouts.menu')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.layouts.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                  @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           @include('admin.layouts.footer')
           
</body>

</html>
<script src="assets/client/js/sweetalert2.all.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/admin/js/sb-admin-2.min.js"></script>
<script src="js/dist/jquery.fancybox.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>

<script src="assets/admin/js/ajax.js"></script>
<script src="assets/admin/js/myApp.js"></script>
@if(session()->has('ctSuccess'))
<script type="text/javascript">
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: "{{session('ctMessage')}}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif
@if(session()->has('ctErrorrs'))
<script type="text/javascript">
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: "{{session('ctMessage')}}",
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif