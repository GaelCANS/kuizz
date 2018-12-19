<nav class="navbar col-lg-12 col-12 p-0  d-flex flex-row">
    <div class="text-center navbar-brand-wrapper">
        <img src="{{ asset('/img/logo.jpg') }}"  class="d-block mx-auto mt-2 pt-1">
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <a href="{{action('QuizzController@create')}}">
            <button type="button" class="btn btn-primary" title="Ajouter">+ Créer un quizz</button>
        </a>

        <ul class="navbar-nav header-title">

                <li class="nav-item @if( Route::currentRouteName() == 'quizz-index' ) active @endif">
                    <a class="nav-link" href="{{route('quizz-index')}}">
                        <i class="icon-list mr-1 ml-4"></i>
                        <span class="menu-title">Quizz</span>
                    </a>
                </li>
            @if (auth()->user()->admin)

            <li class="nav-item @if( Route::currentRouteName() == 'template-index' ) active @endif">
                    <a class="nav-link" href="{{route('template-index')}}"><i class="icon-layers mr-2"></i>Templates</a>
                </li>

                <li class="nav-item @if( Route::currentRouteName() == 'users-index' ) active @endif">
                    <a class="nav-link" href="{{route('users-index')}}"><i class="icon-people mr-2"></i>Utilisateurs</a>
                </li>

                @endif


        </ul>
        <ul class="navbar-nav navbar-nav-right">



            <li class="nav-item @if( Route::currentRouteName() == 'template-index' ) active @endif">
                <a class="nav-link" href="{{route('mon-compte' , array(auth()->user()))}}">
                    <i class="icon-user mr-1"></i>
                    <span class="name">
                            @if (auth()->user())
                            {{ auth()->user()->fullname }}
                        @endif
                    </span>
                </a>
            </li>

            <li class="nav-item @if( Route::currentRouteName() == 'template-index' ) active @endif">
                <a class="nav-link" href="{{URL::to('/')}}/logout">
                    <i class="icon-logout mr-1"></i>
                </a>
            </li>


        </ul>

    </div>
</nav>
