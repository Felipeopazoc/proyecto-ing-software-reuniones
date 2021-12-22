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
	<style>
		#menu-toggle:checked+#menu {
			display: block;
		}
	</style>

</head>

<body class="antialiased bg-gray-200 " style="background-color: #080F28   ;">

	<?php
	include_once('../../conexion_bd/conexion.php');



	if ($_GET['codigo_acta']) {

		$codigo_acta = $_GET['codigo_acta'];
	}







	$acta_registrada = "SELECT * FROM acta WHERE  codigo_acta=$codigo_acta";
	foreach ($conn->query($acta_registrada) as $acta) {
		$acta_tema = $acta['tema'];
		$acta_fecha = $acta['fecha'];
		$acta_hora_inicio = $acta['hora_inicio'];
		$acta_hora_termino = $acta['hora_termino'];
		$acta_descripcion = $acta['descripcion'];
		$acta_estado = $acta['id_estado'];
	}

	$consulta_estados = "select estados.nombre_estado from estados where id_estado=$acta_estado";
	$resultado_estados = mysqli_query($conn, $consulta_estados);





	?>


	<?php
	include_once("../../paths.php");
	require_once(TEMPLATES_PATH . "/menu/header-tailwind.php");
	?>



	<main class="flex flex-col-reverse items-center justify-center min-h-screen max-w-6xl mx-auto sm:flex-row">


		<section class="px-6 sm:w-full ">

			<div class="text-white max-w-2xl mx-auto">
				<nav>
					<a href="<?php if ($_SESSION['rol'] == 'vecino') {
									echo $BASE_URL;
									echo $VECINO_URL;
									echo 'buscador_actas.php';
								} else {
									echo $BASE_URL;
									echo $DIRECTIVA_URL;
									echo 'buscador_actas.php';
								} ?>" class="text-blue-500 font-semibold inline-flex text-2xl">
						<span>
							<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
							</svg>
						</span>
						Volver atrás</a>
				</nav>
				<h2 class="text-3xl font-semibold">Estas modificando el acta</h2>
				<p>Acá podrás modificar el acta completamente, modificar sus estado, fechas y sus descripciones.</p>
				<div>

					<div class="flex flex-col items-center justify-center">

					</div>
				</div>

			</div>

			<?php


			$consulta_estados = ("select * from estados");
			$estado_actual = ("select * from reunion inner join estados using (id_estado);");
			?>

			<div class="">
				<section id="formulario">
					<div>
						<form action="../backend/recibir-acta.php" method="POST">
							<div class="max-w-2xl mt-8 mb-10 bg-white shadow-2xl rounded-t-3xl mx-auto">
								<div class="grid grid-cols-12 px-4 py-4 md:px-8 md:py-8 md:gap-x-4">
									<div class="col-span-12 ">
										<h2 class="text-3xl font-semibold text-gray-800">
											Ingresa la información correspondiente
										</h2>
										<p>
											Ingresa los campos necesarios para poder guardar la
											información.
										</p>
									</div>
									<div class="hidden ">
										<label for="name" id="nameText" class="block text-sm font-semibold text-left text-gray-700 textToValidate">
											Codigo
										</label>
										<div class="relative flex flex-wrap items-stretch w-full mt-1 mb-4 ">
											<div class="flex -mr-px">
												<span class="flex items-center px-3 py-2 text-sm leading-normal whitespace-no-wrap bg-white border border-r-0 rounded rounded-r-none bg-grey-lighter border-grey-light text-grey-dark">
													<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
														<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zm-4 7a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
													</svg>
												</span>
											</div>
											<input value="<?php echo $codigo_acta ?>" type="number" id="codigo_acta" name="codigo_acta" class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500 focus:ring-2" />
										</div>
									</div>
									<div class="col-span-12 md:col-span-6 md:mt-4">
										<label for="ciudad" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="countryText">
											Estado
										</label>

										<div>
											<select id="estado" name="estado" class="block w-full mt-1 form-select">

												<?php

												foreach ($conn->query($consulta_estados) as $estado) {
													if ($estado['id_estado'] == $acta_estado) {
														echo "<option value='" . $estado['id_estado'] . "' selected>" . $estado['nombre_estado'] . "</option>";
													} else {
														echo "<option value='" . $estado['id_estado'] . "'>" . $estado['nombre_estado'] . "</option>";
													}



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
											<input required name="reu_fecha" id="fecha" type="date" value='<?php echo $acta_fecha ?>' class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500 focus:ring-2" />
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
											<input name="hora_inicio" value="<?php echo $acta_hora_inicio ?>" type="time" id="hora_inicio" class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500 focus:ring-2" />
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
											<input required name="hora_termino" id="hora_termino" type="time" value="<?php echo $acta_hora_termino ?>" class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500 focus:ring-2" />
										</div>
									</div>
									<div class="col-span-12 md:mt-4 md:col-span-12">
										<label for="paterno" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="lastnameText">
											Tema
										</label>
										<div class="relative flex flex-wrap items-stretch w-full mt-1 mb-4 ">


											<textarea id="tema" class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500" name="tema" id="tema_input" value="<?php echo $acta_tema ?>" cols="5" rows="1"><?php echo $acta_tema ?></textarea>
										</div>
									</div>
									<div class="col-span-12 md:mt-4 md:col-span-12">
										<label for="paterno" class="block text-sm font-semibold text-left text-gray-700 textToValidate" id="lastnameText">
											Descripción
										</label>
										<div class="relative flex flex-wrap items-stretch w-full mt-1 mb-4 ">


											<textarea class="relative flex-1 flex-grow flex-shrink w-px px-3 py-2 leading-normal border border-gray-200 rounded rounded-l-none inputsRegistroUsuario border-grey-lighter focus:ring-blue-500" id="mytextarea" name="reu_descripcion" id="descripcion" cols="5" value="<?php echo $acta_descripcion ?>" rows="5"><?php echo $acta_descripcion ?></textarea>
										</div>
									</div>
									<input class="hidden" name="reu_cod" value="<?php echo $codigo_reunion ?>" type="text">




								</div>
								<div class="hidden" id="modal-container">

									<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
										<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
											<div class="fixed inset-0 bg-gray-900 bg-opacity-80 transition-opacity" aria-hidden="true"></div>

											<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

											<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
												<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
													<div class="sm:flex sm:items-start">
														<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">

															<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
																<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
															</svg>
														</div>
														<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
															<h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Resumen de información</h3>
															<div class="mt-2">
																<p class="text-sm text-gray-500">Un resumen de la información que editaste. ¿Estás seguro de que quieres enviar la información?</p>
															</div>
															<div id="modal-summary" class="space-y-4">

															</div>

														</div>
													</div>
												</div>
												<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
													<button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-400 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" name="submit" type="submit" value="submit">Enviar</button>
													<button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="cancelar_boton">Cancelar</button>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class=" px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
									<button id="send" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
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




	<script>
		function $(id) {
			return document.getElementById(id);
		}

		const btn_send = $("send");
		const btn_cancel = $("cancelar_boton");
		btn_send.addEventListener("click", displaySummary);
		btn_cancel.addEventListener("click", checkModal);


		function checkModal(e) {
			e.preventDefault();
			const modal = $("modal-container");
			if (modal.classList.contains("hidden")) {
				modal.classList.remove("hidden");
			} else {
				modal.classList.add("hidden");
			}
		}

		function displaySummary(e) {
			e.preventDefault();
			checkModal(e);
			const form = {
				estado: $("estado").options[$("estado").selectedIndex].text,
				fecha: $("fecha").value,
				hora_inicio: $("hora_inicio").value,
				hora_termino: $("hora_termino").value,
				tema: $('tema').value,
			}

			const modal_summary = $('modal-summary');
			modal_summary.innerHTML = ` <div>
                <h1 class="text-gray-800 font-medium">Estado</h1>
                <p class="text-sm text-gray-500">${form.estado}</p>
              </div>
              <div>
                <h1 class="text-gray-800 font-medium">Fecha</h1>
                <p class="text-sm text-gray-500">${form.fecha}</p>
              </div>
			  <div>
                <h1 class="text-gray-800 font-medium">Hora Inicio</h1>
                <p class="text-sm text-gray-500">${form.hora_inicio}</p>
              </div>
			  <div>
                <h1 class="text-gray-800 font-medium">Hora Termino</h1>
                <p class="text-sm text-gray-500">${form.hora_termino}</p>
              </div>
			  <div>
                <h1 class="text-gray-800 font-medium">Tema</h1>
                <p class="text-sm text-gray-500">${form.tema}</p>
              </div>
			    <div>
                <h1 class="text-gray-800 font-medium">Descripcion</h1>
                <p class="text-sm text-gray-500">${tinyMCE.get('mytextarea').getContent()}</p>
              </div>
			   `;


		}
	</script>

</body>

</html>