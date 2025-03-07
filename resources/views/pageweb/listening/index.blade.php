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
    <title>Listening Quiz - Kumpulan Cerita Rakyat Riau</title>

    <style>

        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .quiz-container label {
            display: block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .quiz-container label:hover {
            background-color: blue;
        }

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

        .quiz-container input[type="radio"]:checked + label,
        .quiz-container input[type="checkbox"]:checked + label {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .quiz-container input {
            display: none; /* Menyembunyikan input default */
        }

        .quiz-question-container {
            display: none;
        }

        .quiz-question-container.active {
            display: block;
        }

        .navigation-buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
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

        .audio-container {
            background-color: #e8f4fc;
            border-radius: 12px;
            border: 2px solid #aed3f3;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .play-audio-btn {
            background-color: #0566b6;
            color: #fff;
            border: none;
            font-size: 1.1rem;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 50px;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .play-audio-btn:hover {
            background-color: #045a9d;
            transform: translateY(-2px);
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
<h1 class="mt-4 text-center font-riau-with-shadow-white fw-bold" style="font-size: 60px; color: #081b47;">Listening</h1>
<div class="watermark">
    <img src="{{ asset('web/assets/images/bg/watermark3.png') }}" alt="Logo Riau" class="watermark-logo">
</div>

<!-- Quiz Wrapper -->
<div class="wrapper">
    <div class="page-wrapper">
        <div class="page-content text-center">
            <div class="container quiz-container">
                <form id="listening-quiz-form">
                    @php $questionNumber = 0; @endphp
                        <!-- Iterasi soal Listening -->
                    @forelse ($soal as $listeningData)
                        @foreach ($listeningData as $questionKey => $listening)
                            @php $questionNumber++; @endphp
                            <div class="quiz-question-container {{ $loop->first ? 'active' : '' }}"
                                 id="question-{{ $questionNumber }}">
                                <div class="card shadow border-0 mb-4">
                                    <!-- Audio -->
                                    <div class="audio-container text-center p-3">
                                        @if (isset($listening['suara']))
                                            <button type="button"
                                                    class="btn play-audio-btn"
                                                    data-text="{{ $listening['suara'] }}">
                                                🔊 Play Audio
                                            </button>
                                        @else
                                            <div class="text-danger mb-3 fw-semibold">Audio tidak tersedia.</div>
                                        @endif
                                    </div>

                                    <!-- Pertanyaan -->
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{ $questionNumber }}. {{ $listening['pertanyaan'] }}
                                        </h5>
                                        <!-- Pilihan Jawaban -->
                                        <div class="mt-3">
                                            @foreach ($listening['pilihan'] as $choiceKey => $choice)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                           name="jawaban[{{ $questionNumber }}]"
                                                           id="option-{{ $questionNumber }}-{{ $choiceKey }}"
                                                           value="{{ $choiceKey }}">
                                                    <label
                                                        class="form-check-label w-100 text-start btn btn-outline-primary mb-2"
                                                        for="option-{{ $questionNumber }}-{{ $choiceKey }}">
                                                        <strong>{{ strtoupper($choiceKey) }}.</strong> {{ $choice }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigasi -->
                                <div class="navigation-buttons">
                                    @if ($questionNumber > 1)
                                        <button type="button" class="btn btn-secondary prev-btn"
                                                data-current="{{ $questionNumber }}">Previous
                                        </button>
                                    @endif
                                    @if ($questionNumber < count($soal->collapse()))
                                        <button type="button" class="btn btn-primary next-btn"
                                                data-current="{{ $questionNumber }}">Next
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-success submit-btn">Submit</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <div class="alert alert-warning">Belum ada soal untuk listening.</div>
                    @endforelse
                </form>
            </div>
        </div>
    </div>
    <!-- Tombol Lihat Skor -->
    <a href="{{ route('scorelistening.index') }}" class="btn btn-sm btn-primary corner-button-left">Lihat Skor</a>

    <!-- Back Button -->
    @if(Route::has('pageweb.index'))
        <a href="{{ route('pageweb.index') }}" class="btn btn-sm btn-danger corner-button">Back</a>
    @endif

</div>

<footer class="page-footer"
        style="background: linear-gradient(to right, rgb(179, 221, 240), transparent), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
    <p class="mb-0 font-riau-with-shadow-white">Collection of Riau Folktales</p>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const playButtons = document.querySelectorAll(".play-audio-btn");

        playButtons.forEach(button => {
            button.addEventListener("click", function () {
                const text = this.dataset.text;
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'id-ID'; // Bahasa Indonesia
                utterance.rate = 1; // Kecepatan suara (1 = normal)
                speechSynthesis.speak(utterance);
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const prevButtons = document.querySelectorAll(".prev-btn");
        const nextButtons = document.querySelectorAll(".next-btn");
        const submitButtons = document.querySelectorAll(".submit-btn");
        const quizForm = document.getElementById("listening-quiz-form");

        if (!quizForm) {
            console.error("Form not found: Listening Quiz!");
            return;
        }

        prevButtons.forEach(button => {
            button.addEventListener("click", () => {
                const current = parseInt(button.dataset.current);
                document.getElementById(`question-${current}`).classList.remove("active");
                document.getElementById(`question-${current - 1}`).classList.add("active");
            });
        });

        nextButtons.forEach(button => {
            button.addEventListener("click", () => {
                const current = parseInt(button.dataset.current);
                document.getElementById(`question-${current}`).classList.remove("active");
                document.getElementById(`question-${current + 1}`).classList.add("active");
            });
        });

        quizForm.addEventListener("submit", (e) => {
            e.preventDefault();
            alert("Jawaban Anda telah disubmit.");
        });

        // Tambahkan variabel untuk menyimpan jawaban benar
        const correctAnswers = {
            @foreach ($soal as $listeningData)
                @foreach ($listeningData as $questionKey => $listening)
                    {{ $loop->parent->index * count($listeningData) + $loop->index + 1 }}: "{{ $listening['jawaban'] }}",
                @endforeach
            @endforeach
        };

        // Fungsi untuk menghitung skor
        function calculateScore(userAnswers) {
            let correct = 0;
            let total = Object.keys(correctAnswers).length;

            // Ubah format jawaban user dari "jawaban[1]" menjadi "1"
            const formattedAnswers = {};
            for (let key in userAnswers) {
                const questionNumber = key.match(/\d+/)[0];
                formattedAnswers[questionNumber] = userAnswers[key];
            }

            // Periksa jawaban
            for (let question in formattedAnswers) {
                if (formattedAnswers[question] === correctAnswers[question]) {
                    correct++;
                }
            }

            return (correct / total) * 100;
        }

        // Modifikasi event listener untuk tombol submit
        submitButtons.forEach(button => {
            button.addEventListener('click', () => {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan mengirimkan kuis ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, kirim!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData(quizForm);
                        const answers = Object.fromEntries(formData.entries());
                        const finalScore = calculateScore(answers);

                        // Kirim skor ke server
                        fetch('/score-listening/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                score: Math.round(finalScore)
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Tampilkan pesan sesuai response dari server
                            Swal.fire({
                                title: data.success ? 'Quiz Selesai!' : 'Informasi',
                                html: `
                                    <p>${data.message}</p>
                                    <p>Skor Anda: ${Math.round(finalScore)}</p>
                                `,
                                icon: data.success ? 'success' : 'info',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => window.location.href = '{{ route('scorelistening.index') }}');

                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan saat menyimpan skor',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.reload();
                            });
                        });
                    }
                });
            });
        });
    });
</script>
</body>
</html>
