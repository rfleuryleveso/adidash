<!DOCTYPE html>
<html>
    <head>
        <title>AdiDash | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="/dist/css/normalize.css" />
        <link rel="stylesheet" href="/dist/css/bulma.css" />
        <link rel="stylesheet" href="/dist/css/app.css" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600&display=swap"
            rel="stylesheet"
        />
        <link href="node_modules/css.gg/icons/all.css" rel="stylesheet" />
    </head>
    <body>
        <div class="sidebar">
            <h1>ADIDASH</h1>
            <a class="active" href="#home"
                ><div><i class="gg-home-alt"></i></div>
                Accueil</a
            >
            <a href="#news"
                ><div><i class="gg-work-alt"></i></div>
                Tâches</a
            >
            <a href="#contact"
                ><div><i class="gg-copy"></i></div>
                Projets</a
            >
            <div class="nav-separator"></div>
            <a href="#" class="nav-header">PROJET DRONE</a>
            <a href="#news"
                ><div><i class="gg-pen"></i></div>
                Gestion du projet</a
            >
            <a href="#news"
                ><div><i class="gg-work-alt"></i></div>
                Tâches</a
            >
        </div>

        <div class="content">
            <div class="topbar">
                <div class="notifications">
                    <p><i class="far fa-user"></i></p>
                </div>
                <div class="profile">
                    <p>
                        <i class="far fa-user"></i>{{Auth::user()->fullName}}
                        ({{Auth::user()->classgroup()->first()->name}})
                    </p>
                </div>
            </div>
            <div class="inner">
                <h2>
                    @yield('page_name')
                </h2>
                @yield('content')</div>
        </div>
        <script src="node_modules/@fortawesome/fontawesome-free/js/all.js"></script>
    </body>
</html>
