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

<body class="antialiased bg-gray-200" style="background-color: #080F28">


	<main>
		<section class=" max-w-3xl px-6 mx-auto sm:w-full text-white">
			<h1 class="text-3xl font-semibold">Listado de Reuniones</h1>
			<p>Estas viendo el listado de reuniones que estan registradas en el sistema. Para ver el detalle y registrar acta de cada apreta sobre alguna reunion para ver más.</p>

			<?php

			include_once('../../conexion_bd/conexion.php');


			$sql = "SELECT * FROM reunion";
			foreach ($conn->query($sql) as $reuniones) {  ?>


				<div class="py-6">
					<div class="flex flex-col max-w-3xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg md:flex-row">
						<div class="w-full h-64 bg-cover md:h-auto md:w-1/3" style="background-image: url('https://images.unsplash.com/photo-1606857521015-7f9fcf423740?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80')">
						</div>
						<div class="w-2/3 p-4">
							<h2 class="text-2xl font-bold text-gray-900"><?php echo $reuniones['reu_titulo']; ?></h2>
							<p class="text-gray-800"><span class="text-gray-600">Descripcion: <?php echo $reuniones['reu_tema'] ?></span></p>
							<div class="flex justify-end gap-x-2">
								<?php if ($reuniones["codigo_acta"] == 0) { ?>

									<a href="./crear-acta.php?reu_cod=<?php echo $reuniones['reu_cod'];
																		echo "&codigo_acta=";
																		echo $reuniones["codigo_acta"] ?>" class="inline-flex mt-6 font-semibold text-blue-600 hover:text-blue-400">

										<span>
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
											</svg>
										</span>
										Crear Acta</a>
								<?php
								} else { ?>
									<a href="./reunion.php?reu_cod=<?php echo $reuniones['reu_cod'];
																	echo "&codigo_acta=";
																	echo $reuniones["codigo_acta"] ?>" class="inline-flex mt-6 font-semibold text-blue-600 hover:text-blue-400">
										<span>
											<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
											</svg>
										</span>

										Editar Acta</a>


								<?php } ?>

								<a href="./informacion.php?reu_cod=<?php echo $reuniones['reu_cod'];
																	echo "&codigo_acta=";
																	echo $reuniones["codigo_acta"] ?>" class="inline-flex mt-6 font-semibold text-blue-600 hover:text-blue-400">
									<span>
										<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
										</svg>
									</span>
									Ver información</a>
							</div>
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
		</section>
	</main>

</body>

</html>