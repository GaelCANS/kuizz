<!DOCTYPE html>
<html>

@include('frontoff.head')

<body class="">
<div class="container-scroller">

    @include('frontoff.header')

    <div class="container-fluid page-body-wrapper">
        <div class="row row-offcanvas row-offcanvas-right">
            @include('frontoff.side')

            <div class="content-wrapper">

                @yield('content')
            </div>
        </div>

    </div>
    @include('frontoff.footer')
</div>



@include('frontoff.foot')

</body>
</html>
