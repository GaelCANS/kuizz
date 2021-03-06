
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">



        <li class="nav-item @if( Route::currentRouteName() == 'quizz-index' ) active @endif">
            <a class="nav-link" href="{{route('quizz-index')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Quizz</span>
            </a>
        </li>
        @if (auth()->user()->admin)
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                    <i class="icon-settings menu-icon"></i>
                    <span class="menu-title">Paramètres</span>
                </a>
                <div class="collapse" id="ui-advanced" style="">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item @if( Route::currentRouteName() == 'template-index' ) active @endif"><a class="nav-link" href="{{route('template-index')}}"><i class="icon-people mr-2"></i>Templates</a></li>
                    </ul>
                </div>
                <div class="collapse" id="ui-advanced" style="">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item @if( Route::currentRouteName() == 'users-index' ) active @endif"><a class="nav-link" href="{{route('users-index')}}"><i class="icon-people mr-2"></i>Utilisateurs</a></li>
                    </ul>
                </div>
            </li>
        @endif
    </ul>
</nav>

