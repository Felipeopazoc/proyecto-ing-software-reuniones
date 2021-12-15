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

<body>
    <div class="w-100 color-oscuro" style="">
    <nav class="navbar navbar-expand-sm navbar-dark color-claro p-3">
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
      <div class="contenedor-padre" style="min-height=780px;">
                 
                              
                <?php
                           
                    //Nos conectamos a la bd  
                    function verfecha($vfecha)
                    {
                    $fch=explode("-",$vfecha);
                    $tfecha=$fch[2]."-".$fch[1]."-".$fch[0];
                    return $tfecha;
                    }    
                    include_once("../conexion_bd/conexion.php");
                     $conn2 = new mysqli($host,$username,$password,$dbname);
                     $sql2 = "select * from reunion";
                     
                     $resultado2 = mysqli_query($conn2,$sql2);
                     $contador = 0;
                         while($reunion = $resultado2->fetch_row()){
                                
                                echo "<div class='contenedor-reuniones'>";
                                echo "<h2>$reunion[1]</h2>";
                                echo "<h3> Tema: $reunion[2]</h3>";
                                $fecha = $reunion[3];
                                $fecha = verfecha($fecha);
                                echo "<h4><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z' /><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 11a3 3 0 11-6 0 3 3 0 016 0z' /></svg>$reunion[5]</h4>";
                                echo "<h4 class='h4'><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' /></svg> $fecha</h4>";
                                echo "<h5><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' /></svg> $reunion[4]</h5>";
                                ?>

                                
                                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                                      <input class="disabled" name="rut" type="text" value="<?php echo  $_SESSION["rut"]; ?>">
                                      <input class="disabled" type="number" name="cod_reunion" value="<?php echo $reunion[0] ?>">
                                      <div class="contenedor-btn">
                                           <button class="btn btn-success " type="submit" name="submit">Confirmar Asistencia</button>
                                      </div>
                                    </form> 

                                    
                                <?php
                             
                                echo "</div>";
                                $contador++;
                         }
                        
                         mysqli_free_result($resultado2);
                         mysqli_close($conn2);
                         if(isset($_POST["submit"])){
                          $rut = $_POST["rut"];
                          $cod_reunion = $_POST["cod_reunion"];
                  
                          $sql1 = "select * from asiste where rut='$rut' and reu_cod = '$cod_reunion'";
                          $resultado = mysqli_query($conn,$sql1);
                          $filas = mysqli_num_rows($resultado);
                  
                          if($filas){
                              ?>
                                <div class="alert alert-danger text-center mt-3 w-50 m-auto">Ya se registró su asistencia</div>
                              <?php
                          }else{
                            
                              $sql = "insert into asiste values('$rut','$cod_reunion')";
                              $conn->query($sql);
                              ?>

                                <div class="alert alert-success mt-3 text-center w-50 m-auto">Asistencia registrada correctamente</div>
                              <?php
                              
                          }
                          
                         
                      }

                ?>

            </div>
    </div>

</body>

</html>