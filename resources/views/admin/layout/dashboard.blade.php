<!DOCTYPE html>
<html lang="en">
@include('admin.layout.header')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

        @include('admin.layout.preloader')

        @include('admin.layout.sticky_header')

        <!-- Main Sidebar Container -->
        @include('admin.layout.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                @include('admin.layout.contentHeader')
                <!-- /.content-header -->

                <!-- Main content -->
                        @yield('content')
                <!-- /.content -->
        </div>
</div>
<!-- ./wrapper -->

<!-- footer -->
@include('admin.layout.footer')

<!-- jQuery -->
@yield('custom-scripts')

</body>
</html>
