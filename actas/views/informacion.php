<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Inter', sans-serif;
		}
	</style>
	<script src="https://cdn.tiny.cloud/1/evnwldq37rlj5vhe3frmtduoc11z7mzsial8xsw69r3dbe3u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: '#mytextarea'
		});
	</script>

</head>

<body class="antialiased bg-gray-200" style="background-color: #080F28   ;">

	<?php


	if ($_GET['reu_cod']) {

		$codigo_reunion = $_GET['reu_cod'];
	}

	if ($_GET['codigo_acta']) {

		$codigo_acta = $_GET['codigo_acta'];
	}


	?>




	<main class="flex flex-col h-screen max-w-4xl px-6 mx-auto">


		<section class="text-white sm:w-full">
			<div>
				<h2 class="text-3xl font-semibold">Estas viendo detalles de la reunión</h2>
				<p>Acá encontrarás detalles sobre la reunión realizada, cómo el hecho de poder modificar</p>
				<div>

					<div class="flex flex-col items-center justify-center">

					</div>
				</div>

			</div>

			<?php
			include_once('../../conexion_bd/conexion.php');
			$consulta_estados = "SELECT estados.nombre_estado FROM estados WHERE id_estado=1";
			$resultado_estados = mysqli_query($conn, $consulta_estados);

			$sql = "SELECT * FROM reunion WHERE  reu_cod=$codigo_reunion";

			foreach ($conn->query($sql) as $reuniones) {  ?>


				<!-- component -->
				<div class="py-6">
					<div class="flex flex-col max-w-3xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg md:flex-row">
						<div class="w-full h-64 bg-cover md:h-auto md:w-1/3" style="background-image: url('https://images.unsplash.com/photo-1606857521015-7f9fcf423740?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80')">
						</div>
						<div class="w-2/3 p-4">
							<h2 class="text-2xl font-bold text-gray-900"><?php echo $reuniones['reu_titulo']; ?></h2>
							<p class="text-gray-800"><span class="text-gray-600">Descripcion: <?php echo $reuniones['reu_tema'] ?></span></p>
							<div class="flex justify-between mt-3 item-center">
								<h2 class="inline-flex items-center text-gray-700">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
										</svg>
									</span>
									<?php echo $reuniones['hora'] ?>
								</h2>
								<h2 class="inline-flex items-center text-gray-700 ">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
										</svg>

									</span>
									<?php echo $reuniones['reu_fecha'] ?>
								</h2>


							</div>
						</div>
					</div>
				</div>





			<?php } ?>


			</div>
		</section>

		<section class="text-white">
			<h1 class="text-3xl font-semibold text-white">Historial de actas</h1>
			<?php
			$codigo_acta = $_GET['codigo_acta'];

			$acta_registrada = "SELECT * FROM acta WHERE  codigo_acta=$codigo_acta";


			if ($codigo_acta == 0) {
				echo "<h1 class='text-xl font-semibold text-white'>No hay actas registradas</h1>";
			} else {
				foreach ($conn->query($acta_registrada) as $acta) {  ?>



					<div class="max-w-3xl px-4 py-4 mx-auto bg-gray-800 rounded-md">
						<div class="">
							<div>
								<p class="text-sm text-gray-200">Tema</p>
								<h2 class="text-3xl font-semibold"> <?php echo $acta['tema']; ?>
								</h2>
							</div>



							<div class="mt-4">
								<p class="text-sm text-gray-200 ">Descripcion</p>
								<?php echo $acta['descripcion']; ?>

							</div>
							<div class="mt-4">
								<p class="text-sm text-gray-200 ">Estado Acta</p>

								<?php

								$acta_estado = $acta['id_estado'];

								$consultar_acta_estado = "SELECT estados.nombre_estado FROM estados WHERE id_estado=$acta_estado";
								$resultado_acta_estado = mysqli_query($conn, $consultar_acta_estado);

								while ($row = mysqli_fetch_array($resultado_acta_estado, MYSQLI_ASSOC)) {
									echo $row['nombre_estado'];
								}
								?>
							</div>
						</div>
						<div class="mt-2 space-x-4">
							<div class="inline-flex items-center text-sm gap-x-2">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
								</svg>
								Publicado el
								<?php echo $acta['fecha']; ?>
							</div>
							<div class="inline-flex items-center text-sm gap-x-2">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
								</svg>
								Inicio:
								<?php echo $acta['hora_inicio']; ?>
							</div>
							<div class="inline-flex items-center text-sm gap-x-2">
								<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
								</svg>
								Termino:
								<?php echo $acta['hora_termino']; ?>
							</div>
						</div>
					</div>



			<?php }
			} ?>
		</section>


	</main>






</body>

</html>