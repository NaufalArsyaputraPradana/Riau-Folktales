@extends('template-admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-xl-7 mx-auto">
                <hr />
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Edit Manage Reading</h5>
                        </div>
                        <hr>
                        <form action="{{ route('reading.update', $reading->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                          
                            <div class="mb-3">
                                <label class="form-label">Soal</label>
                                <div id="soal-container">
                                    @foreach ($reading->soal as $index => $soal)
                                        <div class="input-group mb-2">
                                            <input type="text" name="soal[]" class="form-control" value="{{ $soal }}" required>
                                            <button type="button" class="btn btn-danger remove-soal {{ $index == 0 ? 'd-none' : '' }}">Hapus</button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-success" id="add-soal">Tambah Soal</button>
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("add-soal").addEventListener("click", function() {
        let container = document.getElementById("soal-container");
        let newField = document.createElement("div");
        newField.classList.add("input-group", "mb-2");
        newField.innerHTML = `
            <input type="text" name="soal[]" class="form-control" placeholder="Masukkan soal" required>
            <button type="button" class="btn btn-danger remove-soal">Hapus</button>
        `;
        container.appendChild(newField);
        updateRemoveButtons();
    });

    document.getElementById("soal-container").addEventListener("click", function(e) {
        if (e.target.classList.contains("remove-soal")) {
            e.target.parentElement.remove();
            updateRemoveButtons();
        }
    });

    function updateRemoveButtons() {
        let buttons = document.querySelectorAll(".remove-soal");
        buttons.forEach((btn, index) => {
            btn.classList.toggle("d-none", index === 0);
        });
    }

    updateRemoveButtons();
});
</script>
@endsection
