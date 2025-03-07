<!doctype html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('web/assets/images/favicon-32x32.png') }}" type="image/png"/>

    <!-- Plugin Styles -->
    <link href="{{ asset('web/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('web/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('web/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>

    <!-- Loader -->
    <link href="{{ asset('web/assets/css/pace.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('web/assets/js/pace.min.js') }}"></script>

    <!-- Core Styles -->
    <link href="{{ asset('web/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('web/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/icons.css') }}" rel="stylesheet">

    <!-- Theme Styles -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/dark-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/semi-dark.css') }}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/header-colors.css') }}"/>

    <title>Kumpulan Cerita Rakyat Riau</title>

    <style>
        .uniform-button {
            width: 250px; /* Set consistent button width */
        }
    </style>
</head>

<body
    style="background: linear-gradient(to right, rgb(179, 221, 240), rgba(179, 221, 240, 0.811)), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
<header>
    <h1 class="mt-4 text-center font-riau-with-shadow-white fw-bold" style="font-size: 60px; color: #081b47;">Collection
        of Riau Folktales</h1>
    <p class="text-center font-riau-with-shadow-white fw-bold" style="font-size: 20px; color: #081b47;">
        Welcome to the Collection of Riau Folktales
        @if(auth()->check())
            {{ auth()->user()->nama_lengkap ?? 'User' }}
        @else
            , please login first
        @endif
    </p>
</header>
<div class="watermark">
    <img src="{{ asset('web/assets/images/bg/watermark3.png') }}" alt="Logo Riau" class="watermark-logo">
</div>
<main class="wrapper">
    <div class="page-wrapper">
        <div class="page-content text-center">
            @if(auth()->check())
                @if(Route::has('pageweb.list'))
                    <div>
                        <a href="{{ route('pageweb.list') }}" class="btn btn-success mb-2 uniform-button">
                            <i class='bx bx-book'></i> Let's Story
                        </a>
                    </div>
                @endif

                @if(Route::has('pageweb.reading'))
                    <div>
                        <a href="{{ route('pageweb.reading') }}" class="btn btn-warning mb-2 uniform-button">
                            <i class='bx bx-book-open'></i> Let's Reading
                        </a>
                    </div>
                @endif

                @if(Route::has('pageweb.listening'))
                    <div>
                        <a href="{{ route('pageweb.listening') }}" class="btn btn-secondary mb-2 uniform-button">
                            <i class='bx bx-headphone'></i> Let's Listening
                        </a>
                    </div>
                @endif

                @if(Route::has('pageweb.quiz'))
                    <div>
                        <a href="{{ route('pageweb.quiz') }}" class="btn btn-primary mb-2 uniform-button">
                            <i class='bx bx-file'></i> Let's Play Quiz
                        </a>
                    </div>
                @endif

                @if(Route::has('logoutuser.index'))
                    <div>
                        <a href="{{ route('logoutuser.index') }}" class="btn btn-danger mb-2 uniform-button">
                            <i class='bx bx-log-out'></i> Logout
                        </a>
                    </div>
                @endif
            @else
                @if(Route::has('loginuser.index'))
                    <div>
                        <a href="{{ route('loginuser.index') }}" class="btn btn-primary mb-2 uniform-button">
                            <i class='bx bx-log-in'></i> Login
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
</main>
<footer class="page-footer"
        style="background: linear-gradient(to right, rgb(179, 221, 240), transparent), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
    <p class="mb-0 font-riau-with-shadow-white">Collection of Riau Folktales</p>
</footer>

</body>
</html>
