<!DOCTYPE html>
<html>

@include('backoff.head')

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    @include('backoff.header')

    @include('backoff.side')

            <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content body">
            @include('backoff.flash')

            @yield('content')
        </div>
    </div>

</div>
<!-- ./wrapper -->

@include('backoff.foot')

</body>
</html>
