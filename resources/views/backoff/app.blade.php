<!DOCTYPE html>
<html>

@include('backoff.head')

<body class="horizontal-menu">
<div class="container-scroller">

    @include('backoff.header')

    <div class="container-fluid page-body-wrapper">
        <div class="row row-offcanvas row-offcanvas-right">

            <div class="content-wrapper">
                @include('flash.back')

                @yield('content')
            </div>
        </div>

    </div>
    @include('backoff.footer')
</div>



@include('backoff.foot')

</body>
</html>
