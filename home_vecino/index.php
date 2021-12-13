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
</head>

<body>
    <div class="w-100">
        <nav class="navbar navbar-expand-sm navbar-dark bg p-3 color-claro">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav " id="mynavbar">
                    <ul class="navbar-nav me-auto estilos-textos ul">
                        <li class="nav-item">
                            <a class="links" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="links" href="../listado_reuniones/index.php">Reuniones</a>
                        </li>
                        <li class="nav-item">
                            <a class="links" href="../registrar_comentario/index.php">Comentar Reuniones</a>
                        </li>
                        <li class="nav-item">
                            <a class="links" href="buscador_actas.php">Actas</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-sesion">
                    <a class="btn btn-danger mr-3" href="../login/backend/cerrar.php">Cerrar Sesión</a>
                </div>
            </div>
        </nav>
        <?php include_once("../conexion_bd/conexion.php")?>
        <div class="w-100 color-oscuro" style="min-height:500px">
            <h1 class="text-white text-center">Buscador de Reuniones</h1>
            <form class="form" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <div class="contenedor-form">
                    
                    <label class="w-25" for="tema">Tema: </label>
                    <input class="form-control h-25" placeholder="Ingrese tema: " type="text" name="tema">
                    <label class="" for="fecha">Desde: </label>
                    <input class="form-control  h-25 " type="date" name="desde">
                    <label class="" for="fecha">Hasta: </label>
                    <input class="form-control h-25 " type="date" name="hasta">
                    <button type="submit" name="submit" class="ms-2 submit btn btn-primary">Buscar</button>
                </div>
            </form>
            <div style="min-height 300px;">
                <?php
                function verfecha($vfecha)
                {
                $fch=explode("-",$vfecha);
                $tfecha=$fch[2]."-".$fch[1]."-".$fch[0];
                return $tfecha;
                }

               if(isset($_POST["submit"])){
                  $tema = $_POST["tema"];
                  $desde = $_POST["desde"];
                  $hasta = $_POST["hasta"];
                  
                  $sql = "select * from reunion where reu_tema like '%$tema%' and reu_fecha between '$desde' and '$hasta'";
                  $resultado = mysqli_query($conn,$sql);
                  $filas = mysqli_num_rows($resultado);
                  if($filas){
                     ?>
                     <p class="alert alert-success text-center w-50 mt-3 m-auto">Se han encontrado resultados</p>
                     <?php
                     echo "<div class='w-75 m-auto'>";
                     echo "<h1 class='text-center mt-2 text-white'>Resultados de búsqueda</h1>";
                     $contador2=0;
                     while($reunion = $resultado->fetch_row()){
                        $sql4 = "select * from comentario c, vecino v where c.reu_cod=$reunion[0] and v.rut = C.RUT ";
                        echo "<div class='contenedor-reuniones text-white'>";
                        echo "<h1 class='text-white'>$reunion[1]</h1>";
                        echo "<h1 class='text-white'>Tema: $reunion[2]</h1>";
                        $fecha = $reunion[3];
                        $fecha = verfecha($fecha);
                        echo "<h4><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z' /><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 11a3 3 0 11-6 0 3 3 0 016 0z' /></svg>$reunion[5]</h4>";
                        echo "<h4 class='h4'><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' /></svg> $reunion[3]</h4>";
                        echo "<h5><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' /></svg> $reunion[4] </h5>";
                        echo "<div class='contenedor-btn'>";
                        echo "<button data-bs-toggle='collapse' class='mt-3 btn btn-primary' data-bs-target='#demo$contador2'>Desplegar Comentarios</button>";
                        echo "</div>";
                        $resultado4 = mysqli_query($conn,$sql4);
                        while($comentario = $resultado4->fetch_row()){
                            echo "<div id='demo$contador2' class='collapse cajita-comentarios'>";
                            echo "<h3>Tema: $comentario[2]</h3>";
                            echo "<p> Descripción: $comentario[1]</p>";
                            echo "<h4>Por $comentario[8] $comentario[9]</h4>";
                            echo "<h5><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' /></svg>$comentario[3] </h5>";
                            echo "<h5>$comentario[4]</h5>";
                            echo "</div>";
                        }
                        echo "</div>";
                        $contador2++;
                     }
                     echo "</div>";
                  }else{
                  ?>
                     <p class="alerta mt-3 alert alert-danger text-center w-50 m-auto">No se encontraron resultados</p>
                      <?php
                  }
                  mysqli_free_result($resultado);
                  mysqli_close($conn);
               }

               ?>
            </div>
            <div class="contenedor-padre">
                <?php
                    //Nos conectamos a la bd      
                     $conn2 = new mysqli($host,$username,$password,$dbname);
                     $sql2 = "select * from reunion";
                     
                     $resultado2 = mysqli_query($conn2,$sql2);
                     $contador = 0;
                         while($reunion = $resultado2->fetch_row()){
                                $sql3 = "select * from comentario c, vecino v where c.reu_cod=$reunion[0] and v.rut = c.rut ";
                                echo "<div class='contenedor-reuniones'>";
                                echo "<h2>$reunion[1]</h2>";
                                echo "<h3>Tema: $reunion[2]</h3>";
                                $fecha = $reunion[3];
                                $fecha = verfecha($fecha);
                                echo "<h4><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z' /><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 11a3 3 0 11-6 0 3 3 0 016 0z' /></svg>$reunion[5]</h4>";
                                echo "<h4 class='h4'><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' /></svg> $fecha</h4>";
                                echo "<h5><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' /></svg> $reunion[4]</h5>";
                                echo "<div class='contenedor-btn'>";
                                echo "<button data-bs-toggle='collapse' class='mt-3 btn btn-primary' data-bs-target='#demo$contador'>Desplegar Comentarios</button>";
                                echo "</div>";
                                $resultado3 = mysqli_query($conn2,$sql3);
                                while($comentario = $resultado3->fetch_row()){
                                    echo "<div id='demo$contador' class='collapse cajita-comentarios'>";
                                    echo "<h3>Tema: $comentario[2]</h3>";
                                    echo "<p> Descripción: $comentario[1]</p>";
                                    echo "<h4>Por $comentario[8] $comentario[9]</h4>";
                                    $fecha = $comentario[3];
                                    $fecha = verfecha($fecha);
                                    echo "<h5><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' /></svg>$fecha </h5>";
                                    echo "<h5><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' /></svg> $comentario[4]</h5>";
                                    echo "</div>";
                                }
                                echo "</div>";
                                $contador++;
                         }
                         mysqli_free_result($resultado2);
                         mysqli_close($conn2);

                ?>
            </div>
       

        </div>

    </div>

</body>

</html>