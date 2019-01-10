<!DOCTYPE html>
<html>

@include('frontoff.head')

<body class="vertical-center">
<div id="container">


   <!--<div class="container-fluid page-body-wrapper">
        <div class="row row-offcanvas row-offcanvas-right">-->
            @include('frontoff.side')


                @include('flash.front')

                @yield('content')
            </div>
        <!--</div>

    </div>-->
    @include('frontoff.footer')
</div>



@include('frontoff.foot')
@yield('content_after')

</body>
</html>
