<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">

    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="d-none navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav header-title" style="width: 65%;">
            <li class="nav-item  d-lg-flex">
            </li>
            <li class="mx-auto d-sm-flex nav-item  align-items-center justify-content-md-center ">

                <div class="mx-auto text-center">


                    <h5 class="text-uppercase" id="zone-title"></h5>


                </div>
            </li>

        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item  align-items-center justify-content-md-center d-none d-lg-flex ">
                <i class="icon-bubbles icon-sm"></i>
                <div class="ml-3 text-center" style="line-height: 1.4;font-size: 0.70rem;">


                </div>
            </li>
            <li class="nav-item dropdown ml-2">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown" >

                    <i class="icon-arrow-down mx-0"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item preview-item" href="{{route('mon-compte' , array(auth()->user()))}}">

                        <div class="preview-thumbnail">
                            <div class="preview-icon">
                                <i class="icon-settings mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <span class="preview-subject font-weight-medium">Mon compte</span>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item" href="{{URL::to('/')}}/logout">
                        <div class="preview-thumbnail">
                            <div class="preview-icon">
                                <i class="icon-logout mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <span class="preview-subject font-weight-medium">Se déconnecter</span>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas" >
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
