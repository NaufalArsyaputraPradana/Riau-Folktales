<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('web/assets/images/favicon-32x32.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('web/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/app.css') }}" rel="stylesheet">
    <title>Score - Listening Quiz</title>

    <style>

        .corner-button {
            position: fixed;
            right: 20px;
            top: 20px;
            z-index: 1000;
        }

        .corner-button-left {
            position: fixed;
            left: 20px;
            top: 20px;
            z-index: 1000;
        }


        .quiz-container {
            max-width: 850px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fdfdfd;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease-in-out;
        }

        .quiz-container:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        .card {
            border-radius: 20px;
            background: linear-gradient(to right, #e6f7ff, #ffffff);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.12);
            padding: 25px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .audio-container {
            padding: 20px;
            background: #f8faff;
            border: 2px solid #d8e7f8;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .audio-container #displayText {
            font-size: 24px;
            font-weight: 700;
            color: #004085;
            margin-bottom: 10px;
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

        #result {
            font-size: 20px;
            font-weight: 500;
            color: #333333;
            margin-top: 10px;
        }

    </style>
</head>

<body
    style="background: linear-gradient(to right, rgb(179, 221, 240), rgba(179, 221, 240, 0.811)), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
<h1 class="mt-4 text-center font-riau-with-shadow-white fw-bold" style="font-size: 60px; color: #081b47;">Listening</h1>
<div class="watermark">
    <img src="{{ asset('web/assets/images/bg/watermark3.png') }}" alt="Logo Riau" class="watermark-logo">
</div>

<!-- Back Button -->
@if(Route::has('pageweb.index'))
    <a href="{{ route('pageweb.index') }}" class="btn btn-sm btn-danger corner-button">Back</a>
@endif
<!-- Kontainer Skor -->
<div class="container mt-5">
    <div class="score-container">
        <!-- Pesan pemberitahuan -->
        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        <!-- Skor Listening -->
        @if(Auth::check())
            <div class="card text-center">
                <div class="card-body">
                    <div class="card shadow border-0 mb-4 py-4 px-3"
                         style="background: linear-gradient(135deg, #f8fbff, #e6f2ff);">
                    <h3 class="mb-4 text-center font-weight-bold" style="color: #003766;">Halo, {{ auth()->check() ? (auth()->user()->nama_lengkap ?? 'User') : 'User' }}</h3>

                    @if($scoreListening)
                        <p style="color: #0056b3; font-size: 18px;">Skor Anda saat ini:</p>
                        <h2 class="font-weight-bold text-primary" style="font-size: 48px; color: #007bff;">{{ $scoreListening->score }}</h2>
                        <p class="mt-4 text-center" style="color: #4e586e; font-size: 16px;">Apakah Anda ingin mencoba kembali untuk meningkatkan skor Anda?</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('pageweb.reading') }}" class="btn btn-primary mt-3"
                                   style="width: 175px; background: linear-gradient(135deg, #007bff, #0056b3); color: #fff; border: none; transition: transform 0.2s;">Mulai
                                    Coba Lagi</a>
                            </div>
                    @else
                        <p class="text-muted" style="font-size: 16px;">Belum ada skor yang tercatat. Silakan mulai mengerjakan kuis untuk mendapatkan skor pertama Anda.</p>
                        <a href="{{ route('pageweb.listening') }}" class="btn btn-primary mt-3">Mulai Kuis</a>
                    @endif
                    </div>
                </div>
            </div>
        @else
            <!-- Tombol Login -->
            <p class="text-center">Silakan login untuk melihat skor Anda.</p>
            <div class="text-center">
                <a href="{{ route('loginuser.index') }}" class="btn btn-primary">Login</a>
            </div>
        @endif
    </div>
</div>

<footer class="page-footer"
        style="background: linear-gradient(to right, rgb(179, 221, 240), transparent), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
    <p class="mb-0 font-riau-with-shadow-white">Collection of Riau Folktales</p>
</footer>

<!-- Scripts -->
<script src="{{ asset('web/assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
