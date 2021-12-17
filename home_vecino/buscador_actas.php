<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="../tailwind.css">
    <link rel="stylesheet" href="../tailwind.output.css">
</head>

<body>
    <?php $hoy = date("Y-m-d");?>
    <div class="w-100 color-oscuro" style="height:100vh;">
        <nav class="navbar navbar-expand-sm navbar-dark bg p-3 color-claro">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav " id="mynavbar">
                    <ul class="navbar-nav me-auto estilos-textos ul">
                        <li class="nav-item">
                            <a class="links" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="links" href="../listado_reuniones/index.php">Reuniones</a>
                        </li>
                        <li class="nav-item">
                            <a class="link-comentar" href="../registrar_comentario/index.php">Comentar Reuniones</a>
                        </li>
                        <li class="nav-item">
                            <a class="links" href="#">Actas</a>
                        </li>
                    </ul>
                </div>
                <div class="contenedor-btn">
                    <a class="btn btn-danger mr-3" href="../login/backend/cerrar.php">Cerrar Sesión</a>
                </div>
            </div>
        </nav>
        <?php include_once("../conexion_bd/conexion.php")?>
        <div class="w-100 color-oscuro" style="min-height:400px">
            <h1 class="text-white text-center">Buscador de actas</h1>
            <form class=" w-100 m-auto" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <div class="contenedor-form" >
                    <label class="ms-1 w-25" for="tema">Tema: </label>
                    <input class="form-control h-25 " placeholder="Ingrese tema: " type="text" name="tema">
                    <label class="ms-2" for="fecha">Desde: </label>
                    <input class="form-control  h-25 " type="date" name="desde"  max="<?php echo $hoy?>" required>
                    <label class="ms-2" for="fecha">Hasta: </label>
                    <input class="form-control h-25 " type="date" name="hasta" value="<?php echo $hoy?>" max="<?php echo $hoy?>">
                    <button type="submit" name="submit" class="ms-2 btn btn-primary">Buscar</button>
                </div>
            </form>
            <div style="min-height:400px;">
                <?php
               if(isset($_POST["submit"])){
                  $tema = $_POST["tema"];
                  $desde = $_POST["desde"];
                  $hasta = $_POST["hasta"];
               
                  $sql = "select * from acta where tema like '%$tema%' or fecha between '$desde' and '$hasta' order by fecha desc";
                  $resultado = mysqli_query($conn,$sql);
                  $filas = mysqli_num_rows($resultado);
                  if($filas){
                     ?>
                     <p class="alert alert-success text-center w-50 m-auto mt-3">Se han encontrado resultados</p>
                     <?php
                     echo "<div class='caja'>";
                     echo "<h1 class='text-center  text-white'>Resultados de búsqueda</h1>";
                   
                     while($acta = $resultado->fetch_row()){
                
                        echo "<div class='contenedor-reuniones m-auto mt-3 text-white'>";
                        
                        echo "<h1 class='text-white h1'>Tema: $acta[1]</h1>";
                        echo "<h1 class='text-white h2'>Fecha realizada: $acta[2]</h1>";
                        echo "<h1 class='text-white h2'>Hora inicio: $acta[3]</h1>";
                        echo "<h1 class='text-white h2'>Hora final: $acta[4]</h1>";
                        echo "<p class='text-white'>Descripción:  $acta[5]</p>";
                        echo "</div>";
                     }
                     echo "</div>";
                  }else{
                  ?>
                     <p class="alert alert-danger text-center w-50 m-auto mt-3">No se encontraron resultados</p>
                      <?php
                  }
                  mysqli_free_result($resultado);
                  mysqli_close($conn);
               }

               ?>
                <div class="w-75 bg-primary m-auto mt-4">
                    <?php
                        $sql = "select * from acta";
                        $resultado = mysqli_query($conn,$sql);
                        $filas = mysqli_num_rows($resultado);

                        if($filas){
                            while($acta = $resultado->fetch_row()){
                                if($acta[0]!=3){                                
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
                                                        Ver informaciÃ³n</a>
                                                </div>
                                                <?php if ($_SESSION['rol'] == 'directiva') { ?>

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
                        }

                    ?>
                </div>
            </div>
            
       

        </div>

    </div>

</body>

</html>