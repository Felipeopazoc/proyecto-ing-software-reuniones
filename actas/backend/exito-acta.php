<?php
session_start();

?>
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

<body class="antialiased  min-h-screen" style="background-color: #080F28">

	<?php
	include_once('../../conexion_bd/conexion.php');
	include_once("../../paths.php");
	require_once(TEMPLATES_PATH . "/menu/header-tailwind.php");
	if ($_GET['codigo_acta']) {

		$codigo_acta = $_GET['codigo_acta'];
	}






	?>




	<main class="flex flex-col-reverse max-w-6xl mx-auto   sm:flex-row text-white">


		<section class="flex justify-center items-center text-left flex-col">
			<div>
				<span class="w-16 h-16 inline-flex bg-green-500 rounded-full items-center justify-center">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
				</span>
				<h1 class="text-3xl  font-semibold">Envio exitoso</h1>
				<p>Has modificado exitosamente el acta.</p>
				<?php if ($_SESSION['rol'] == 'directiva' || $_SESSION['rol'] == 'delegado' || $_SESSION['rol'] == 'presidente') { ?>
					<a href="<?php echo $BASE_URL;
								echo $DIRECTIVA_URL ?>buscador_actas.php" class="text-blue-600 font-semibold mt-6 inline-block hover:text-blue-400">Volver atrás</a>
				<?php } else {  ?>
					<a href="<?php echo $BASE_URL;
								echo $VECINO_URL ?>buscador_actas.php" class="text-blue-600 font-semibold mt-6 inline-block hover:text-blue-400">Volver atrás</a>


				<?php } ?>
			</div>
		</section>


	</main>






</body>

</html>