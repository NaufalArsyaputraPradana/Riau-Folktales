<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('web') }}/assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('web') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="{{ asset('web') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="{{ asset('web') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('web') }}/assets/css/pace.min.css" rel="stylesheet" />
	<script src="{{ asset('web') }}/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('web') }}/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ asset('web') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{ asset('web') }}/assets/css/app.css" rel="stylesheet">
	<link href="{{ asset('web') }}/assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('web') }}/assets/css/dark-theme.css" />
	<link rel="stylesheet" href="{{ asset('web') }}/assets/css/semi-dark.css" />
	<link rel="stylesheet" href="{{ asset('web') }}/assets/css/header-colors.css" />
	<title>Quiz - Kumpulan Cerita Rakyat Riau</title>
	<style>
		.uniform-button {
			width: 250px; /* Atur lebar tombol */
		}
	</style>
</head>

<body style="background: linear-gradient(to right, rgb(179, 221, 240), rgba(179, 221, 240, 0.811)), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
	<h1 class="mt-4 text-center font-riau-with-shadow-white fw-bold" style="font-size: 60px; color: #081b47;">Quiz</h1>
	<div class="watermark">
		<img src="{{ asset('web') }}/assets/images/bg/watermark3.png" alt="Logo Riau" class="watermark-logo">
	</div>
	<!--wrapper-->
	<div class="wrapper">
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content" style="text-align: center;">
                
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
				class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->

		<footer class="page-footer"
		style="background: linear-gradient(to right, rgb(179, 221, 240), transparent), url('https://png.pngtree.com/png-vector/20220921/ourmid/pngtree-batik-jambi-angso-duo-melayu-png-image_6209068.png');">
		<p class="mb-0 font-riau-with-shadow-white">Collection of Riau Folktales</p>
	</footer>
	</div>
	<!--end wrapper-->
	@include('sweetalert::alert')
	<!-- Bootstrap JS -->
	<script src="{{ asset('web') }}/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="{{ asset('web') }}/assets/js/jquery.min.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="{{ asset('web') }}/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="{{ asset('web') }}/assets/js/widgets.js"></script>
	<!--app JS-->
	<script src="{{ asset('web') }}/assets/js/app.js"></script>
</body>

</html>