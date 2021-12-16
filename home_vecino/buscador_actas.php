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
    <div class="w-100 color-oscuro" style="height:100vh;">
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
                            <a class="link-comentar" href="../registrar_comentario/index.php">Comentar Reuniones</a>
                        </li>
                        <li class="nav-item">
                            <a class="links" href="../listado_reuniones/index.php">Actas</a>
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
                    <input class="form-control  h-25 " type="date" name="desde">
                    <label class="ms-2" for="fecha">Hasta: </label>
                    <input class="form-control h-25 " type="date" name="hasta">
                    <button type="submit" name="submit" class="ms-2 btn btn-primary">Buscar</button>
                </div>
            </form>
            <div style="min-height:400px;">
                <?php
               if(isset($_POST["submit"])){
                  $tema = $_POST["tema"];
                  $desde = $_POST["desde"];
                  $hasta = $_POST["hasta"];
                  
                  $sql = "SELECT * FROM ACTA WHERE TEMA LIKE '%$tema%' AND FECHA BETWEEN '$desde' AND '$hasta'";
                  $resultado = mysqli_query($conn,$sql);
                  $filas = mysqli_num_rows($resultado);
                  if($filas){
                     ?>
                     <p class="alert alert-success text-center w-50 m-auto mt-3">Se han encontrado resultados</p>
                     <?php
                     echo "<div class='caja'>";
                     echo "<h1 class='text-center  text-white'>Resultados de búsqueda</h1>";
                     $contador2=0;
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
            </div>
          
       

        </div>

    </div>

</body>

</html>