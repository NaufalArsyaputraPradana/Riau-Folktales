<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cerita->nama_cerita }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('web') }}/assets/css/app.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .book-container {
            position: relative;
            width: 500px;
            height: 650px;
            perspective: 1000px;
        }

        .book {
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 1s;
            position: relative;
        }

        .book.open {
            transform: rotateY(-180deg);
        }

        .book .cover,
        .book .page {
            position: absolute;
            width: 100%;
            height: 100%;
                background: url('{{ asset('public/cerita/' . $cerita->image) }}');
            background-size: cover;
            background-blend-mode: multiply;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 5px;
            backface-visibility: hidden;
        }

        .book .cover {
            z-index: 2;
            font-size: 24px;

        }

        .book .page {
            background: white;
            transform: rotateY(180deg);
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            font-size: 16px;
            text-align: justify;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        .page-content {
            flex-grow: 1;
            margin-bottom: 20px;
        }

        .pagination-controls {
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .page-number {
            align-self: center;
        }

        .d-none {
            display: none !important;
        }

        .corner-button {
            position: fixed;
            right: 20px;
            top: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body style="background: linear-gradient(to right, rgb(179, 221, 240), rgba(179, 221, 240, 0.811)), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
	<div class="watermark">
		<img src="{{ asset('web') }}/assets/images/bg/watermark3.png" alt="Logo Riau" class="watermark-logo">
	</div>
	<div class="book-container">
        <div class="book" id="book">
            <div class="cover d-flex flex-column align-items-center justify-content-center text-white fw-bold font-riau-with-shadow-dark">
              <span>{{ $cerita->nama_cerita }}</span>
              <p class="mt-2 text-white" style="font-size: 14px;">{{ $cerita->deskripsi }}</p>
            </div>
            <div class="page">
                <div class="page-content" id="pageContent"></div>
                <div class="pagination-controls">
                    <button class="btn btn-sm btn-danger" id="prevBtn" disabled>Previous</button>
                    <span class="page-number" id="pageNumber">Page 1</span>
                    <button class="btn btn-sm btn-success" id="nextBtn">Next</button>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('pageweb.list') }}" class="btn btn-sm btn-danger corner-button">Back</a>

    <script>
        const content = `{{ $cerita->cerita }}`;

        const wordsPerPage = 130;
        let currentPage = 1;

        // Split content into words and then into pages
        const words = content.split(' ');
        const totalPages = Math.ceil(words.length / wordsPerPage);

        function displayPage(pageNum) {
            const start = (pageNum - 1) * wordsPerPage;
            const end = start + wordsPerPage;
            const pageWords = words.slice(start, end);
            document.getElementById('pageContent').textContent = pageWords.join(' ');
            document.getElementById('pageNumber').textContent = `Page ${pageNum} of ${totalPages}`;

            // Update button states
            document.getElementById('prevBtn').disabled = pageNum === 1;
            
            // Handle next button visibility
            const nextBtn = document.getElementById('nextBtn');
            
            if (pageNum === totalPages) {
                nextBtn.classList.add('d-none');
            } else {
                nextBtn.classList.remove('d-none');
            }
        }

        // Event listeners
        document.getElementById('book').addEventListener('click', function(e) {
            if (e.target.classList.contains('cover') || e.target.classList.contains('book')) {
                this.classList.toggle('open');
            }
        });

        document.getElementById('prevBtn').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                displayPage(currentPage);
            }
        });

        document.getElementById('nextBtn').addEventListener('click', function() {
            if (currentPage < totalPages) {
                currentPage++;
                displayPage(currentPage);
            }
        });

        // Initial display
        displayPage(1);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>