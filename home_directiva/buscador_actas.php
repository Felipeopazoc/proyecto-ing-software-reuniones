<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actas</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="../tailwind/tailwind.output.css">
    <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/custom-forms@0.2.1/dist/custom-forms.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555555;
            background-color: #ffffff;
            background-image: none;
            border: 1px solid #cccccc;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
    </style>


</head>

<body class="color-oscuro ">
    <div class="">


        <?php include_once("../conexion_bd/conexion.php");
        include_once("../paths.php");
        require_once(TEMPLATES_PATH . "/menu/header-tailwind.php"); ?>

        <div class=" color-oscuro px-4 max-w-4xl mx-auto">
            <h1 class="text-center text-white text-4xl font-semibold">Buscador de actas</h1>
            <p class="text-white">Acá estan los resultados de las actas. Si tienes los permisos necesarios podrás crear un acta en la esquina inferior a la derecha.</p>
            <form class="m-auto mt-4" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <div class="grid grid-cols-12 gap-x-4 gap-y-2">
                    <div class="col-span-12 lg:col-span-4 ">
                        <label class="font-semibold text-white " for="tema">Tema: </label>
                        <input class="form-control " placeholder="Ingrese tema: " type="text" name="tema">
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <label class="font-semibold text-white " for="fecha">Desde: </label>
                        <input class="form-control" type="date" name="desde" max="<?php echo $hoy ?>" required>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <label class="font-semibold text-white " for="fecha">Hasta: </label>
                        <input class="form-control " type="date" name="hasta" value="<?php echo $hoy ?>" max="<?php echo $hoy ?>">

                    </div>
                </div>
                <button type="submit" name="submit" class=" btn btn-primary mt-4 bg-blue-500 px-4 py-2 text-white rounded-md">Buscar</button>
            </form>
            <div>
                <?php
                if (isset($_POST["submit"])) {
                    $tema = $_POST["tema"];
                    $desde = $_POST["desde"];
                    $hasta = $_POST["hasta"];

                    $sql = "select * from acta where tema like '%$tema%' and fecha between '$desde' and '$hasta'";
                    $resultado = mysqli_query($conn, $sql);
                    $filas = mysqli_num_rows($resultado);

                    if ($filas) {
                ?>

                        <p class="w-full text-white py-4 text-green-800 max-w-md mx-auto text-center alert alert-success rounded-md" style="background:#d1e7dd">Se han encontrado resultados</p>
                        <?php

                        echo "<h1 class='mt-2 text-center text-white'>Resultados de búsqueda</h1>";
                        $contador2 = 0;
                        while ($acta = $resultado->fetch_row()) {


                            if ($acta['0'] != 0) {
                        ?>

                                <div class="py-6">
                                    <div class="flex flex-col max-w-3xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg md:flex-row">
                                        <div class="w-full h-64 bg-cover md:h-auto md:w-1/3" style="background-image: url('https://images.unsplash.com/photo-1606857521015-7f9fcf423740?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=300&q=80')">
                                        </div>
                                        <div class="w-2/3 p-4 flex flex-col">
                                            <h2 class="text-2xl font-bold text-gray-900"><?php echo $acta['1']; ?></h2>
                                            <p class="text-gray-800"><span class="text-gray-600">Descripcion: <?php echo $acta['5'] ?></span></p>
                                            <div class="flex justify-between mt-3 item-center">
                                                <div>
                                                    <h2 class="inline-flex items-center text-gray-700">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </span>

                                                        <?php echo $acta['3'] ?> - <?php echo $acta['4'] ?>
                                                    </h2>
                                                </div>
                                                <div>
                                                    <h2 class="inline-flex items-center text-gray-700 ">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                        </span>
                                                        <?php echo $acta['2'] ?>

                                                    </h2>
                                                </div>


                                            </div>
                                            <div class="flex justify-between mt-3 item-center">
                                                <div>
                                                    <a href="../actas/views/informacion-acta.php?codigo_acta=<?php echo $acta['0'] ?>" class="inline-flex mt-6 font-semibold text-blue-600 hover:text-blue-400">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </span>
                                                        Ver información</a>
                                                </div>
                                                <?php if ($_SESSION['rol'] == 'directiva' || $_SESSION['rol'] == 'delegado') { ?>

                                                    <div>
                                                        <a href="../actas/views/editar-acta.php?codigo_acta=<?php echo $acta['0'] ?>" class="inline-flex mt-6 font-semibold text-blue-600 hover:text-blue-400">
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </span>
                                                            Editar acta</a>
                                                    </div>

                                                <?php } else if ($_SESSION['rol'] != 'directiva') {  ?>
                                                <?php }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                    } else {
                        ?>
                        <p class="w-full text-white py-4 bg-red-500 mx-auto max-w-md mx-auto text-center alert alert-success rounded-md">No se encontraron resultados</p>
                <?php
                    }
                    mysqli_free_result($resultado);
                    mysqli_close($conn);
                }

                ?>
            </div>
            <div class="fixed bottom-0 mb-6 right-0 mr-6">

                <a href="../actas/views/crear-acta-cero.php">
                    <button class="text-white px-4 w-auto h-16 bg-green-500 rounded-full hover:bg-green-600 active:shadow-lg mouse shadow transition ease-in duration-200 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 inline-block mr-1"" fill=" none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Crear acta</span>
                    </button>
                </a>
            </div>


        </div>


    </div>

</body>

</html>