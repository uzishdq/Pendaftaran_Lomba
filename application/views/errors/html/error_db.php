<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
	<meta name="generator" content="Hugo 0.84.0">
	<title>404-error</title>

	<link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/jumbotron/">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!-- Bootstrap core CSS -->
	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>

</head>

<body>

	<main>
		<div class="container py-4">
			<header class="pb-3 mb-4 border-bottom text-center">
				<h1>Database Error</h1>
			</header>

			<div class="p-5 mb-4 text-white text-center bg-dark rounded-3">
				<div class="container-fluid py-5 d-flex align-items-center justify-content-center flex-column">
					<h1 class="display-5 fw-bold mb-5">Maaf, Atas Kesalah yang terjadi</h1>
					<p class="col-md-8 fs-4 mb-5">Silahkan Hubungi Developer anda.</p>
					<a class="btn btn-primary btn-lg" href="<?= base_url() . 'welcome' ?>">
						Kembali
					</a>

				</div>
			</div>


			<footer class="pt-3 mt-4 text-muted border-top">
				<p>&copy; Copyright 2023. Designed &amp; Developed by Me</p>
			</footer>
		</div>
	</main>



</body>

</html>