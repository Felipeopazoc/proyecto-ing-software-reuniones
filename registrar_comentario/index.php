<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Comentarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<?php include_once("../conexion_bd/conexion.php"); ?>

<body>
    <div class="w-100 container-padre color-oscuro">
        <nav class="navbar navbar-expand-sm navbar-dark  bg p-3">
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
                            <a class="links" href="../listado_reuniones/index.php">Listado Reuniones</a>
                        </li>
                    </ul>
                </div>
                <div class="btn-sesion">
                    <a class="btn btn-danger mr-3" href="../login/backend/cerrar.php">Cerrar Sesión</a>
                </div>
            </div>
        </nav>
        <h1 class="h1 text-center text-white mt-2">Mis comentarios en las reuniones</h1>

        <div class="w-100 m-auto boxs">
            <?php
            
            function verfecha($vfecha){                 
                    $fch=explode("-",$vfecha);
                    $tfecha=$fch[2]."-".$fch[1]."-".$fch[0];
                    return $tfecha;
             }
                $sql = "select * from reunion ";
                $resultado = mysqli_query($conn,$sql);
                $rut = $_SESSION["rut"];
                $filas = mysqli_num_rows($resultado);
                $contador=0;
                if($filas){
                    while($reunion = $resultado->fetch_row()){
                        $fecha = $reunion[3];
                        $fecha = verfecha($fecha);
                        ?>
            <div class="box">
                <h1><?php echo $reunion[1];?></h1>
                <h1>Tema: <?php echo $reunion[2];?></h1>
                <h4><svg xmlns="http://www.w3.org/2000/svg" class="icono-calendar" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg> <?php echo $fecha;?></h4>
                <h4><svg xmlns="http://www.w3.org/2000/svg" class="icono-calendar" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg> <?php echo $reunion[4];?></h4>
                <h4 style="margin-left:0px;">Deja tu respuesta: </h4>
                <form action="recibir_datos.php" method="POST">
                    
                    <input type="text" class="disabled" name="rut" value='<?php echo $rut?>'>
                    <input type="number" class="disabled" name="cod_reunion" value=<?php echo $reunion[0]?>>
                    <div class="col-7">
                        <label>Tema: </label>
                        <input type="text" class="form-control" placeholder="Tema comentario: " name="tema">
                    </div>

                    <div class="col-10">
                        <label>Descripción: </label>
                        <textarea class="form-control" name="descripcion" placeholder="Comentario: "></textarea>
                    </div>

                    <div class="container-button">
                        <button class="btn btn-primary" type="submit" name="submit">Registrar comentario</button>
                    </div>

                </form>

                <?php 
                                $sql = "select * from comentario c where c.reu_cod = $reunion[0] and c.rut='$rut' ";
                                $resultado2 = mysqli_query($conn,$sql);
                              
                                while($comentario = $resultado2->fetch_row()){
                                     
                                ?>
                <div class="box-comentario mt-2 m-auto">
                    <h3>Tema: <?php echo $comentario[2] ?></h3>
                    <p>Descripción: <?php echo $comentario[1]?> </p>
                    <?php
                        $fecha = $reunion[3];
                        $fecha = verfecha($fecha);
                    ?>
                    <h4 class='h4'><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z' /></svg><?php echo $fecha;?></h4>
                    <h5><svg xmlns='http://www.w3.org/2000/svg' class='icon' fill='none' viewBox='0 0 24 24' stroke='currentColor'> <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' /></svg><?php echo $reunion[4] ?></h5>

                    <div class="container-button2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="<?php echo "#myModal".$contador?>">Modificar</button>
                       
                    </div>

                    <div class="modal" id="<?php echo "myModal".$contador ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Heading</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form action="modificar.php" class="text-black" method="post">
                                        <input class="text-black" type="hidden" name="id_comentario"
                                            value=<?php echo $comentario[0] ?>>
                                        <div class="contenedor-modal">
                                            <div class="col-8">
                                                <label class="form-label">Tema: </label>
                                                <input class="form-control" type="text" name="tema"
                                                    value='<?php echo $comentario[2]?>' required>
                                            </div>

                                            <div class="col-8">
                                                <label>Comentario: </label>
                                                <textarea class="form-control" name="comentario"
                                                    required><?php echo $comentario[1]?></textarea>
                                            </div>

                                            <div class="btn-actualizar">
                                                <button type="submit" class="btn btn-success" name="submit">Actualizar
                                                    información</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>

                <?php
                                    
                                    $contador++;
                                }
                            
                            ?>

            </div>
            <?php
                        
                        
                    }

                   
                }else{
                    ?>
            <p class="alert alert-danger">Sin comentarios</p>

            <?php

                }
               
            ?>

        </div>
    </div>

</body>

</html>