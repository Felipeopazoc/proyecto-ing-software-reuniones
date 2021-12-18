<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Crear Acta - Grupo 10</title>
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

<body class="antialiased bg-gray-200 " style="background-color: #080F28;">

	<?php
	include_once('../../conexion_bd/conexion.php');



	?>






	<main class="flex flex-col-reverse min-h-screen max-w-6xl mx-auto sm:flex-row">


		<section class="px-6 sm:w-full ">
			<nav>
				<a href="../../home_vecino/buscador_actas.php" class="font-semibold text-blue-500">Volver atrás</a>
			</nav>
			<div class="text-white">
				<h2 class="text-3xl font-semibold">Estas CREANDO el acta</h2>
				<p>Acá podrás ingresar datos al acta completamente, modificar sus estado, fechas y sus descripciones.</p>
				<div>

					<div class="flex flex-col items-center justify-center">

					</div>
				</div>

			</div>

			<?php


			$consulta_estados = ("select * from estados");
			$consulta_reuniones = ("select * from reunion");
			$estado_actual = ("select * from reunion inner join estados using (id_estado);");
			?>

			<div class="">
				<section id="formulario">
					<div>
						<form action="../backend/acta/crear-acta.php" method="POST">
							<div class="max-w-2xl mt-8 mb-10 bg-white shadow-2xl rounded-t-3xl">
								<div class="grid grid-cols-12 px-4 py-4 md:px-8 md:py-8 md:gap-x-4">
									<div class="col-span-12">
										<h2 class="text-3xl font-semibold text-gray-800">
											Ingresa la información correspondiente
										</h2>
										<p>
											Ingresa los campos necesarios para poder guardar la
											información.
										</p>
									</div>


									<div class="col-span-12 md:col-span-6 md:mt-4">
										<label for="ciudad" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="countryText">
											Estado
										</label>

										<div>
											<select name="id_estado" class="block w-full mt-1 form-select">
												<option value selected disabled></option>
												<?php

												foreach ($conn->query($consulta_estados) as $estado) {

													echo "<option value='" . $estado['id_estado'] . "'>" . $estado['nombre_estado'] . "</option>";




												?>




												<?php } ?>
											</select>
										</div>

									</div>

									<div class="col-span-12 md:col-span-6 md:mt-4">
										<label for="rut" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="rutText">
											Fecha
										</label>
										<div class="relative flex flex-wrap items-stretch w-full mt-1 mb-4 ">
											<div class="flex -mr-px">
												<span class="flex items-center px-3 py-2 text-sm leading-normal whitespace-no-wrap bg-white border border-r-0 rounded rounded-r-none bg-grey-lighter border-grey-light text-grey-dark">
													<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
													</svg>
												</span>
											</div>
											<input required name="reu_fecha" type="date" class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500 focus:ring-2" />
										</div>
									</div>
									<div class="col-span-12 md:col-span-6 md:mt-4">
										<label for="country" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="countryText">
											Hora Inicio
										</label>
										<div class="relative flex flex-wrap items-stretch w-full mt-1 mb-4 ">
											<div class="flex -mr-px">
												<span class="flex items-center px-3 py-2 text-sm leading-normal whitespace-no-wrap bg-white border border-r-0 rounded rounded-r-none bg-grey-lighter border-grey-light text-grey-dark">
													<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
													</svg>
												</span>
											</div>
											<input name="hora_inicio" type="time" class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500 focus:ring-2" />
										</div>
									</div>
									<div class="col-span-12 md:col-span-6 md:mt-4">
										<label for="country" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="countryText">
											Hora Término
										</label>
										<div class="relative flex flex-wrap items-stretch w-full mt-1 mb-4 ">
											<div class="flex -mr-px">
												<span class="flex items-center px-3 py-2 text-sm leading-normal whitespace-no-wrap bg-white border border-r-0 rounded rounded-r-none bg-grey-lighter border-grey-light text-grey-dark">
													<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
													</svg>
												</span>
											</div>
											<input required name="hora_termino" type="time" class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500 focus:ring-2" />
										</div>
									</div>
									<div class="col-span-12 md:mt-4 md:col-span-12">
										<label for="paterno" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="lastnameText">
											Tema
										</label>
										<div class="relative flex flex-wrap items-stretch w-full mt-1 mb-4 ">


											<textarea class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500" name="tema" id="tema_input" cols="5" rows="1"></textarea>
										</div>
									</div>
									<div class="col-span-12 md:mt-4 md:col-span-12">
										<label for="paterno" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="lastnameText">
											Descripción
										</label>
										<div class="relative flex flex-wrap items-stretch w-full mt-1 mb-4 ">


											<textarea class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500" id="mytextarea" name="reu_descripcion" id="" cols="5" rows="5"></textarea>
										</div>
									</div>
									<input class="hidden" name="reu_cod" value="<?php echo $codigo_reunion ?>" type="text">




								</div>
								<div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
									<button type="submit" name="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
										Enviar
									</button>

								</div>
							</div>
						</form>
					</div>
				</section>
			</div>
			</div>
		</section>

	</main>






</body>

</html>