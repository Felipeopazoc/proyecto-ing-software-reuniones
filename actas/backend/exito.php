<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

	<style>
		body {
			font-family: 'Inter', sans-serif;
		}
	</style>

</head>

<body class="antialiased  bg-gray-200">

	<?php
	include_once('../../conexion_bd/conexion.php');

	if ($_GET['codigo_acta']) {

		$codigo_acta = $_GET['codigo_acta'];
	}

	if ($_GET['reu_cod']) {

		$reu_cod = $_GET['reu_cod'];
	}






	?>




	<main class="flex flex-col-reverse max-w-6xl mx-auto h-screen  sm:flex-row">


		<section>
			<h1 class="text-3xl font-gray-900 font-semibold">Envio exitoso</h1>
			<a href="../../home_vecino/buscador_actas.php" class="text-blue-600 font-semibold mt-6 inline-block hover:text-blue-400">Volver atrás</a>
		</section>


	</main>






</body>

</html>