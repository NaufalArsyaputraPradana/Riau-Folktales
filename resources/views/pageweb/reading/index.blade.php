<!doctype html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('web/assets/images/favicon-32x32.png') }}" type="image/png"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS Styles -->
    <link href="{{ asset('web/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/css/app.css') }}" rel="stylesheet">
    <title>Reading Quiz - Kumpulan Cerita Rakyat Riau</title>

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

<h1 class="mt-4 text-center font-riau-with-shadow-white fw-bold" style="font-size: 60px; color: #081b47;">Reading</h1>
<div class="watermark">
    <img src="{{ asset('web/assets/images/bg/watermark3.png') }}" alt="Logo Riau" class="watermark-logo">
</div>

<!-- Tombol Lihat Skor -->
<a href="{{ route('scorereading.index') }}" class="btn btn-sm btn-primary corner-button-left">Lihat Skor</a>
<!-- Back Button -->
@if(Route::has('pageweb.index'))
    <a href="{{ route('pageweb.index') }}" class="btn btn-sm btn-danger corner-button">Back</a>
@endif
<!-- Quiz Wrapper -->
<div class="wrapper">
<div class="page-wrapper">
    <div class="page-content text-center">
    <div class="container quiz-container">
        <form id="reading-quiz-form" action="{{ route('scorereading.update') }}" method="POST" class="mt-3">
            @csrf
            <div class="card shadow border-0 mb-4">
                <p style="font-size: 18px; font-weight: 500;">Ucapkan kata yang muncul di bawah ini:</p>
                <div class="audio-container text-center p-3">
                    <div id="displayText">- Kata Muncul Disini -</div>
                </div>
                <!-- Buttons -->
                <div>
                    <button type="button" class="btn btn-primary me-2" onclick="startRecognition()">Mulai</button>
                    <button type="button" class="btn btn-danger me-2" onclick="stopRecognition()">Berhenti</button>
                </div>
            </div>
            <!-- Recognition Result -->
            <p id="result">Hasil akan muncul di sini...</p>
        </form>
    </div>
    </div>
</div>
</div>

<footer class="page-footer"
        style="background: linear-gradient(to right, rgb(179, 221, 240), transparent), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
    <p class="mb-0 font-riau-with-shadow-white">Collection of Riau Folktales</p>
</footer>

<!-- Scripts -->
<script src="{{ asset('web/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let currentIndex = 0;
    let texts = [];
    let score = 0;

    fetch('/api/soal')
        .then(response => response.json())
        .then(data => {
            texts = data;
            getRandomText();
        })
        .catch(error => console.error('Error fetching texts:', error));

    let targetText = '';
    let spokenWords = [];
    let recognition;

    function getRandomText() {
        targetText = texts[currentIndex];
        spokenWords = [];
        updateDisplay();
        if (recognition) {
            recognition.stop();
            recognition = null;
        }
    }

    function updateDisplay() {
        const words = targetText.split(' ');
        let displayHTML = words.map((word, index) =>
            `<span class="${index < spokenWords.length ? 'correct' : ''}">${word}</span>`
        ).join(' ');
        document.getElementById('displayText').innerHTML = displayHTML;
    }

    function startRecognition() {
        if (!recognition) {
            recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
            recognition.lang = 'id-ID';

            recognition.onresult = function (event) {
                const spokenText = event.results[0][0].transcript.trim();
                document.getElementById('result').innerText = 'Anda mengatakan: ' + spokenText;

                const words = targetText.split(' ');
                const spokenArray = spokenText.split(' ');

                let correctCount = 0;
                for (let i = 0; i < words.length; i++) {
                    if (spokenArray[i] && spokenArray[i].toLowerCase() === words[i].toLowerCase()) {
                        correctCount++;
                    } else {
                        break;
                    }
                }

                spokenWords = words.slice(0, correctCount);
                updateDisplay();

                if (spokenWords.length === words.length) {
                    score++;
                    Swal.fire({
                        icon: 'success',
                        title: 'Bagus!',
                        text: 'Pengucapan Anda benar!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => nextQuestion());
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pengucapan Anda kurang tepat!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => nextQuestion());
                }
            };

            recognition.onerror = function (event) {
                alert('Error: ' + event.error);
            };
        }

        recognition.start();
    }

    function stopRecognition() {
        if (recognition) {
            recognition.stop();
        }
    }

    function showFinalResult() {
        const finalScore = (score / texts.length) * 100;

        fetch('/score-reading/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({score: finalScore})
        })
            .then(response => response.json())
            .catch(error => console.error('Error:', error));

        Swal.fire({
            icon: 'success',
            title: 'Selamat!',
            html: `<p>Anda telah menyelesaikan semua soal!</p><p>Skor Anda: ${finalScore}</p>`,
            showConfirmButton: true,
        }).then(() => window.location.href = '{{ route('scorereading.index') }}');
    }

    function nextQuestion() {
        if (currentIndex < texts.length - 1) {
            currentIndex++;
            getRandomText();
        } else {
            showFinalResult();
        }

        if (recognition) {
            recognition.stop();
            recognition = null;
        }
    }
</script>
</body>
</html>
