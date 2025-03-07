<!doctype html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('web/assets/images/favicon-32x32.png') }}" type="image/png"/>

    <!-- Plugins -->
    <link href="{{ asset('web/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('web/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet"/>
    <link href="{{ asset('web/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet"/>

    <!-- Loader -->
    <link href="{{ asset('web/assets/css/pace.min.css') }}" rel="stylesheet"/>
    <script src="{{ asset('web/assets/js/pace.min.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('web/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('web/assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/icons.css') }}" rel="stylesheet">

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('web/assets/css/dark-theme.css') }}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/semi-dark.css') }}"/>
    <link rel="stylesheet" href="{{ asset('web/assets/css/header-colors.css') }}"/>

    <title>Kumpulan Cerita Rakyat Riau</title>

    <style>
        @keyframes shake {
            0%, 100% {
                transform: translateX(0);
            }

            10%, 30%, 50%, 70%, 90% {
                transform: translateX(-10px);
            }

            20%, 40%, 60%, 80% {
                transform: translateX(10px);
            }
        }

        .shake-effect {
            animation: shake 0.8s ease-in-out; /* Durasi efek shake */
        }

        .corner-button {
            position: fixed;
            right: 20px;
            top: 20px;
            z-index: 1000;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: scale(1.02);
        }


        .btn {
            border-radius: 30px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary {
            background: #007bff;
            color: #ffffff;
            border: none;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-danger {
            background: #ff5a5a;
            color: #ffffff;
            border: none;
        }

        .btn-danger:hover {
            background: #d43f3f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 90, 90, 0.3);
        }
    </style>
</head>

<body
    style="background: linear-gradient(to right, rgb(179, 221, 240), rgba(179, 221, 240, 0.811)), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
<h1 class="mt-4 text-center font-riau-with-shadow-white fw-bold" style="font-size: 60px; color: #081b47;">
    Collection of Riau Folktales
</h1>

<div class="watermark">
    <img src="{{ asset('web/assets/images/bg/watermark3.png') }}" alt="Logo Riau" class="watermark-logo">
</div>

<!-- Wrapper -->
<div class="wrapper">
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-content shake-effect">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
                @forelse ($ceritas as $cerita)
                    <div class="col mb-2">
                        <div class="position-relative text-center">
                            <img src="{{ asset('public/cerita/' . $cerita->image) }}" class="card-img-top"
                                 alt="{{ $cerita->nama_cerita }}"
                                 style="border-radius: 20px; width: 100%; height: auto;">
                            <div
                                class="position-absolute top-50 start-50 translate-middle text-white fw-bold font-riau-with-shadow-dark"
                                style="width: 100%;">
                                <span>{{ $cerita->nama_cerita }}</span>
                                <p class="mt-2" style="font-size: 14px;">{{ $cerita->deskripsi }}</p>
                            </div>
                        </div>
                        <a href="{{ route('pageweb.detail', $cerita->nama_cerita) }}" class="stretched-link"></a>
                    </div>
                @empty
                    <div class="col text-center">
                        <h5 class="text-muted">No stories available at the moment.</h5>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Back Button -->
    @if(Route::has('pageweb.index'))
        <a href="{{ route('pageweb.index') }}" class="btn btn-sm btn-danger corner-button">Back</a>
    @endif

    <!-- Overlay -->
    <div class="overlay toggle-icon"></div>

    <!-- Back To Top Button -->
    <a href="javascript:" class="back-to-top">
        <i class='bx bxs-up-arrow-alt'></i>
    </a>
</div>

<footer class="page-footer"
        style="background: linear-gradient(to right, rgb(179, 221, 240), transparent), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
    <p class="mb-0 font-riau-with-shadow-white">Collection of Riau Folktales</p>
</footer>
</body>
</html>
