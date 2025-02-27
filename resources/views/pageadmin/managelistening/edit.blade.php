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
                            <li class="breadcrumb-item active" aria-current="page">Edit Listening</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-7 mx-auto">
                    <hr />
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-5">
                            <div class="card-title d-flex align-items-center">
                                <div><i class="bx bx-file-export me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Edit Listening</h5>
                            </div>
                            <hr>
                            <form action="{{ route('listening.update', $listening->id) }}" method="POST" class="row g-3"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                               
                                <div class="col-md-12">
                                    <label for="soal" class="form-label">Soal</label>
                                    <div id="soal-container">
                                        @foreach ($listening->soal as $index => $soal)
                                            <div class="soal-item border rounded p-3 mb-3" data-index="{{ $index }}">
                                                <div class="mb-2">
                                                    
                                                    <span class="text-danger">Text dibawah akan mengeluarkan suara *</span>
                                                    <textarea name="soal[{{ $index }}][suara]" class="form-control"
                                                    required>{{ $soal['suara'] }}</textarea>                                                    <span class="text-muted">Soal</span>
                                                    <textarea name="soal[{{ $index }}][pertanyaan]" class="form-control"
                                                        required>{{ $soal['pertanyaan'] }}</textarea>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Pilihan</label>
                                                    <input type="text" name="soal[{{ $index }}][pilihan][a]"
                                                        class="form-control mb-1" value="{{ $soal['pilihan']['a'] }}"
                                                        placeholder="Pilihan A" required>
                                                    <input type="text" name="soal[{{ $index }}][pilihan][b]"
                                                        class="form-control mb-1" value="{{ $soal['pilihan']['b'] }}"
                                                        placeholder="Pilihan B" required>
                                                    <input type="text" name="soal[{{ $index }}][pilihan][c]"
                                                        class="form-control mb-1" value="{{ $soal['pilihan']['c'] }}"
                                                        placeholder="Pilihan C" required>
                                                    <input type="text" name="soal[{{ $index }}][pilihan][d]"
                                                        class="form-control" value="{{ $soal['pilihan']['d'] }}"
                                                        placeholder="Pilihan D" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Jawaban Benar</label>
                                                    <select name="soal[{{ $index }}][jawaban]"
                                                        class="form-control" required>
                                                        <option value="a"
                                                            {{ $soal['jawaban'] == 'a' ? 'selected' : '' }}>A</option>
                                                        <option value="b"
                                                            {{ $soal['jawaban'] == 'b' ? 'selected' : '' }}>B</option>
                                                        <option value="c"
                                                            {{ $soal['jawaban'] == 'c' ? 'selected' : '' }}>C</option>
                                                        <option value="d"
                                                            {{ $soal['jawaban'] == 'd' ? 'selected' : '' }}>D</option>
                                                    </select>
                                                </div>
                                                <button type="button" class="btn btn-danger remove-soal">Hapus
                                                    Soal</button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-success mt-2" id="add-soal">Tambah
                                        Soal</button>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let soalIndex = {{ count($listening->soal) }};
        document.getElementById('add-soal').addEventListener('click', function() {
            const soalContainer = document.getElementById('soal-container');
            const soalHtml = `
            <div class="soal-item border rounded p-3 mb-3" data-index="${soalIndex}">
                <div class="mb-2">
                    <span class="text-danger">Text dibawah akan mengeluarkan suara *</span>
                    <textarea name="soal[${soalIndex}][suara]" class="form-control mb-2"></textarea>
                    <span class="text-muted">Soal</span>
                    <textarea name="soal[${soalIndex}][pertanyaan]" class="form-control" required></textarea>
                </div>
                <div class="mb-2">
                    <label class="form-label">Pilihan</label>
                    <input type="text" name="soal[${soalIndex}][pilihan][a]" class="form-control mb-1" placeholder="Pilihan A" required>
                    <input type="text" name="soal[${soalIndex}][pilihan][b]" class="form-control mb-1" placeholder="Pilihan B" required>
                    <input type="text" name="soal[${soalIndex}][pilihan][c]" class="form-control mb-1" placeholder="Pilihan C" required>
                    <input type="text" name="soal[${soalIndex}][pilihan][d]" class="form-control" placeholder="Pilihan D" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Jawaban Benar</label>
                    <select name="soal[${soalIndex}][jawaban]" class="form-control" required>
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
                <button type="button" class="btn btn-danger remove-soal">Hapus Soal</button>
            </div>`;
            soalContainer.insertAdjacentHTML('beforeend', soalHtml);
            soalIndex++;
        });

        document.getElementById('soal-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-soal')) {
                e.target.closest('.soal-item').remove();
            }
        });
    </script>
@endsection
