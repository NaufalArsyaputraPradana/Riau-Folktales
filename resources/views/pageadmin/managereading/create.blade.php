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
                            <li class="breadcrumb-item active" aria-current="page">Manage Listening</li>
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
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i></div>
                                <h5 class="mb-0 text-primary">Tambah Manage Reading</h5>
                            </div>
                            <hr>
                            <form action="{{ route('reading.store') }}" method="POST" class="row g-3">
                                @csrf
                                

                                <div class="col-12">
                                    <label class="form-label">Soal</label>
                                    <div id="soal-container">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="soal[]" required>
                                            <button type="button" class="btn btn-danger remove-soal">Hapus</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success mt-2" id="add-soal">Tambah Soal</button>
                                </div>
                               
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary px-5">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('add-soal').addEventListener('click', function () {
                let container = document.getElementById('soal-container');
                let newField = document.createElement('div');
                newField.classList.add('input-group', 'mb-2');
                newField.innerHTML = `
                    <input type="text" class="form-control" name="soal[]" required>
                    <button type="button" class="btn btn-danger remove-soal">Hapus</button>
                `;
                container.appendChild(newField);
            });

            document.getElementById('soal-container').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-soal')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
@endsection
