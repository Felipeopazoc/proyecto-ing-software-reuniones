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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
   
</head>

<body style="">
    <div class="w-100">
    <nav class="navbar navbar-expand-sm navbar-dark bg p-3">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav " id="mynavbar">
            <ul class="navbar-nav me-auto estilos-textos ul">
              <li class="nav-item">
                <a class="links" href="../home_vecino/index.php">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="links" href="../registrar_comentario/index.php">Comentar Reuniones</a>
              </li>
             
            </ul>
          </div>
          <div class="">
            <a class="btn btn-danger mr-3" href="../login/backend/cerrar.php">Cerrar Sesión</a>
          </div>
        </div>
      </nav>
        <div class="boxs">
            <?php 
                include_once("../conexion_bd/conexion.php");
                $sql = "select *from reunion r, estados e where r.id_estado = e.id_estado";
                $resultado = mysqli_query($conn,$sql);
                while ($reunion = $resultado->fetch_row()){
                    echo "<div class='box '>";
                    echo "<h1>$reunion[1]</h1>";
                    echo "<h3>Tema: $reunion[2]</h3>";
                    echo "<h4>Fecha: $reunion[3]</h4>";
                    echo "<h4>Hora: $reunion[4]</h4>";
                  
                    echo "<h4>Estado: <button class='btn btn-danger'>$reunion[7]</button> </h4>";
                    echo "<br>";
                    echo "</div>";

                }

            ?>

        </div>  
    </div>

</body>

</html>