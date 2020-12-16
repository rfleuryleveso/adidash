<!DOCTYPE html>
<html>

<head>
    <title>AdiDash | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/dist/css/normalize.css" />
    <link rel="stylesheet" href="/dist/css/bulma.css" />
    <link rel="stylesheet" href="/dist/css/app.css" />
    <link rel="stylesheet" href="/dist/css/css.gg.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="sidebar">
        <h1>ADIDASH</h1>
        <a class="active" href="{{ route('student.home') }}">
            <div><i class="gg-home-alt"></i></div>
            Accueil
        </a>
        <a href="{{ route('student.tasks') }}">
            <div><i class="gg-work-alt"></i></div>
            Tâches
        </a>
        <a href="{{ route('student.projects') }}">
            <div><i class="gg-copy"></i></div>
            Projets
        </a>
        <div class="nav-separator"></div>
        <a href="#" class="nav-header">PROJET DRONE</a>
        <a href="#news">
            <div><i class="gg-pen"></i></div>
            Gestion du projet
        </a>
        <a href="#news">
            <div><i class="gg-work-alt"></i></div>
            Tâches
        </a>
    </div>

    <div class="content">
        <div class="topbar">
            <div class="notifications">
                <p><i class="far fa-user"></i></p>
            </div>
            <div class="profile">
                <div class="dropdown">
                    <div class="dropdown-trigger">
                        <a aria-haspopup="true" aria-controls="dropdown-menu">
                            <span><i class="far fa-user"></i>{{ Auth::user()->fullName }}
                                @if (Auth::user()->hasClassGroup())
                                    ({{ Auth::user()->getClassGroup()->name }}) @endif
                            </span>
                        </a>
                    </div>
                    <div class="dropdown-menu" id="dropdown-menu" role="menu">
                        <div class="dropdown-content">
                            <a class="dropdown-item" href={{ route('settings') }}>
                                Paramètres
                            </a>
                            <a class="dropdown-item" href={{ route('logout') }}>
                                Déconnexion
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="inner">
            <h2>
                @yield('page_name')
            </h2>
            @yield('content')
        </div>
    </div>
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <script src="/dist/js/app.js"></script>
</body>

</html>
