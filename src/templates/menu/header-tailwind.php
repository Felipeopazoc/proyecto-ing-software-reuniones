<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		#menu-toggle:checked+#menu {
			display: block;
		}
	</style>
</head>

<body>
	<?php
	include_once("../../paths.php");

	echo $_SESSION['rol'];
	if ($_SESSION['rol'] == "directiva") { ?>
		<header style="background:#141A32" class="lg:px-16 px-6 flex flex-wrap lg:flex-row-reverse items-center lg:py-6 py-6">
			<div class="flex-1 lg:flex-initial flex justify-between items-center">
				<a class="bg-red-500 px-4 py-2 rounded-md text-white" href="<?php echo "SAD" ?>"> Cerrar Sesión </a>
			</div>

			<label for="menu-toggle" class="pointer-cursor lg:hidden block">
				<svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
					<title>menu</title>
					<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
				</svg>
			</label>
			<input class="hidden" type="checkbox" id="menu-toggle" />

			<div class="hidden lg:flex-1 lg:flex lg:items-center lg:w-auto w-full text-white" id="menu">
				<nav>
					<ul class="lg:flex items-center justify-between text-base pt-4 lg:pt-0">
						<li>
							<a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="./index.php">Inicio</a>
						</li>
						<li>
							<a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="../reuniones/index.php">Agendar Reunion</a>
						</li>
						<li>
							<a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="#">Registrar Acta</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>


	<?php } else { ?>
		<header style="background:#141A32" class="lg:px-16 px-6 flex flex-wrap lg:flex-row-reverse items-center lg:py-6 py-6">
			<div class="flex-1 lg:flex-initial flex justify-between items-center">
				<a class="bg-red-500 px-4 py-2 rounded-md text-white" href="<?php echo $BASE_URL;
																			echo $LOGIN_URL;
																			?>cerrar.php"> Cerrar Sesión </a>
			</div>

			<label for="menu-toggle" class="pointer-cursor lg:hidden block">
				<svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
					<title>menu</title>
					<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
				</svg>
			</label>
			<input class="hidden" type="checkbox" id="menu-toggle" />

			<div class="hidden lg:flex-1 lg:flex lg:items-center lg:w-auto w-full text-white" id="menu">
				<nav>
					<ul class="lg:flex items-center justify-between text-base pt-4 lg:pt-0">
						<li>
							<a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="<?php echo $BASE_URL;
																															echo $VECINO_URL ?>index.php">Inicio</a>
						</li>
						<li>
							<a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="<?php echo $BASE_URL;
																															echo $REUNIONES_URL ?>index.php">Reuniones</a>
						</li>
						<li>
							<a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="<?php echo $BASE_URL;
																															echo $COMENTARIOS_URL ?>index.php">Comentar Reuniones</a>
						</li>
						<li>
							<a class="lg:p-4 py-3 px-0 block border-b-2 border-transparent hover:border-indigo-400" href="#">Comentar Reuniones</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>



	<?php
	} ?>
</body>

</html>