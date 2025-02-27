@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Soal Listening</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="container">
                <h2>Soal Listening</h2>
                
                @if(count($soal) > 0)
                    <ul class="list-group">
                        @foreach($soal as $key => $item)
                            <li class="list-group-item">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <button class="btn btn-primary" onclick="speak('{{ $item['suara'] }}')">
                                            <i class="bi bi-play-circle"></i> Play
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <strong>Pertanyaan:</strong> {{ $item['pertanyaan'] }}
                                </div>

        
                                <div class="mb-3">
                                    <strong>Pilihan:</strong>
                                    <ul>
                                        <li>A: {{ $item['pilihan']['a'] }}</li>
                                        <li>B: {{ $item['pilihan']['b'] }}</li>
                                        <li>C: {{ $item['pilihan']['c'] }}</li>
                                        <li>D: {{ $item['pilihan']['d'] }}</li>
                                    </ul>
                                </div>
        
                                <div class="mb-3">
                                    <strong>Jawaban:</strong> {{ strtoupper($item['jawaban']) }}
                                </div>

                              

                                <script>
                                function speak(text) {
                                    var msg = new SpeechSynthesisUtterance();
                                    msg.text = text;
                                    msg.lang = 'en-US'; // Set the language to English
                                    window.speechSynthesis.speak(msg);
                                }
                                </script>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No soal found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
