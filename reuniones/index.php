<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <!-- TODO: Scrip de tiny.cloud -->
    <script src="https://cdn.tiny.cloud/1/0o3tggxqv53qxakfk4n0y9kvf5wxxnt96f75nv6vhikvoiom/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: "#myEditor",
        plugins: 'lists',
        toolbar: 'bold italic | numlist bullist | alignleft aligncenter alignright alignjustify | forecolor backcolor emoticons',
        init_instance_callback : function(editor) {
        let editorH = editor.editorContainer.offsetHeight;
        $('#formTranslation_trad')
            .css({
                'position':'absolute',
                'height':editorH
            })
            .show();
        },
        setup: function (editor) {
            editor.on('change', function (e) {
                editor.save();
            });
        }
      });
    </script>
    <script type="text/javascript">
      tinymce.init({
        selector: ".myeditablediv",
        plugins: 'lists',
        toolbar: 'bold italic | numlist bullist | alignleft aligncenter alignright alignjustify | forecolor backcolor emoticons',
        init_instance_callback : function(editor) {
        let editorH = editor.editorContainer.offsetHeight;
        $('#formTranslation_trad')
            .css({
                'position':'absolute',
                'height':editorH
            })
            .show();
        },
        setup: function (editor) {
            editor.on('change', function (e) {
                editor.save();
            });
        }
      });
    </script>
    
    <!-- Modal -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Reuniones</title>
  </head>
  <body style="background-color: #080F28;">
        <!--Incluimos el fichero de la conexión a la BD-->
        <?php include_once ('../conexion_bd/conexion.php') ?>
        <!--------------------------------- TODO: CABECERA --------------------------------->
        <header>
        <nav class="nav navbar navbar-expand-sm navbar-dark color-claro bg p-3">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav " id="mynavbar">
            <ul class="navbar-nav me-auto estilos-textos ul">
              <li class="nav-item">
                <a class="links" href="../home_directiva/index.php">Inicio</a>
              </li>
              <li class="nav-item">
                <a class="links" href="#">Agendar Reunión</a>
              </li>
              <li class="nav-item">
                <a class="links" href="../home_directiva/buscador_actas.php">Registrar Acta</a>
              </li>
            </ul>
          </div>
          <div class="btn-sesion">
            <a class="btn btn-danger mr-3" href="../login/backend/cerrar.php">Cerrar Sesión</a>
          </div>
        </div>
      </nav>
        </header>
        <!--------------------------------- TODO: MAIN --------------------------------->
        <div class="container-md text-dark p-4  rounded" >
          <!-- Boton -->
            <div class="d-flex row justify-content-end pb-3">
              <div class=" d-flex contenedor-btn justify-content-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Agendar reunión</button>
              </div>
            </div>

         
          <!---------------- TODO: Listamos todas las reuniones ----------------->
            <?php 
                // Realizamos la consulta, y obtenemos los datos.
                $sql = "select * from reunion r, estados e where r.id_estado = e.id_estado order by reu_cod desc";
                $resultado = $conn->query($sql);
                while($row = $resultado->fetch_row()){
                  echo "<div style='background-color: #141A32; color:white;' class='container-md p-3 mb-3 rounded'>";
                    echo "<div class='d-flex justify-content-between'>";
                      echo "<h3>$row[1]</h3>";
                      // Enviamos la id de la reunión al modal.
                      echo "<button type='button' class='btn btn-warning btn-sm px-3' data-bs-toggle='modal' data-bs-target='#editarModal-$row[0]'>Editar</button>";
                    echo "</div>";
                    echo "<p><strong>Temas a tratar: </strong>$row[2]</p>";
                    echo "<p><strong>Ubicación: </strong>$row[5]</p>";
                    echo "<section class='d-flex flex-wrap align-items-center container-fluid'>";
                      echo "<div class='d-flex'>";
                        echo "<img class='mb-1' src='images/watch.svg' width='25px' height='25px'>";
                        $hora = date('H:i', strtotime($row[4]));
                        echo "<p class='text-secondary mx-1 mb-1 pe-2 border-end border-secondary'>$hora</p>";
                      echo "</div>";
                      echo "<div class='d-flex'>";
                        echo "<img class='mb-1' src='images/calendar.svg' width='25px' height='25px'>";
                        $fecha = date('d-m-Y',strtotime($row[3]));
                        echo "<p class='text-secondary mx-1 mb-1 pe-2 border-end border-secondary'>$fecha</p>";
                      echo "</div>";
                      echo "<div class='d-flex'>";
                        if ($row[8] == 4){
                          echo "<img class='mb-1' src='images/activo.png' width='28px' height='25px'>";
                          echo "<p class='text-secondary mx-1 mb-1 pe-2 border-end border-secondary'>$row[9]</p>";
                        }else{
                          echo "<img class='mb-1' src='images/inactivo.png' width='28px' height='25px'>";
                          echo "<p class='text-secondary mx-1 mb-1 pe-2 border-end border-secondary'>$row[9]</p>";
                        }
                      echo "</div>";
                      echo "<div class='d-flex'>";
                        echo "<a style='text-decoration:none' href='../actas/views/informacion-acta.php?codigo_acta=$row[7]' target='_blank' class='text-success mx-1 mb-1'>ver acta</a>";
                      echo "</div>";
                    echo "<section>";
                  echo "</div>";

                  // TODO: Modal de editor de reunión.
                  // Aquí pasaremos la id de la reunión por id del div.
                  echo "<div class='modal fade' id='editarModal-$row[0]' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                    echo "<div class='modal-dialog modal-xl' role='document'>";
                      echo "<div class='modal-content'>";
                        echo "<div class='modal-header flex-column'>";
                          echo "<h5 class='modal-title text-center' id='exampleModalLabel'>Modificar Reunión</h5>";
                          echo "<button type='button' class='btn-close px-3' data-bs-dismiss='modal'></button>";
                        echo "</div>";
                        echo "<div class='modal-body'>";
                        echo "<form action='editar_reunion.php' method='POST' id='formulario-edit'>";
                              echo "<input type='hidden' name='id' value='$row[0]'>";
                              echo "<div class='form-group col-4 w-100 py-2'>";
                                  echo "<label>Título</label>";
                                  echo "<input id='titulo' type='text' name='titulo' class='form-control' spellcheck='true' value='$row[1]'>";
                              echo "</div>";
                              echo "<div class='form-group col-4 w-100 py-2'>";
                                  echo "<label>Temas a tratar</label>";
                                  echo "<textarea class='myeditablediv' name='tema' id='editorText'>$row[2]</textarea>";
                              echo "</div>";
                              echo "<div class='form-group col-4 w-100 py-2'>";
                                  echo "<label>Lugar</label>";
                                  echo "<input id='lugar' type='text' name='lugar' class='form-control' value='$row[5]' required>";
                              echo "</div>";
                              echo "<div class='form-group col-4 w-100 py-2'>";
                                echo "<div class='form-group'>";
                                  echo "<div class='w-100 mx-0 input-group col-xl-12 align-self-center row justify-content-start'>";
                                    echo "<div style='width: 25%;' class='align-items-center align-self-center ps-0'>";
                                      echo "<label>Fecha</label>";
                                      $hoy = date("Y-m-d");
                                      echo "<input id='fecha' type='date' name='fecha' class='w-100 mb-2 form-control' min=".$hoy." value='$row[3]'>";
                                    echo "</div>";
                                    echo "<div style='width: 25%;' class='align-items-center align-self-center px-0'>";
                                      echo "<label>Hora</label>";
                                      echo "<input id='hora' type='time' name='hora' class='w-100 mb-2 form-control' value='$row[4]'>";
                                    echo "</div>";
                                    echo "<div style='width: 25%;' class='align-items-center align-self-center pe-0 mb-2'>";
                                      echo "<label>Estado</label>";
                                      echo "<select class='form-select' aria-label='Default select example' name='estado'>";
                                        echo "<option value='4'>por realizar</option>";
                                        echo "<option value='5' selected>realizada</option>";
                                      echo "</select>";
                                    echo "</div>";
                                    echo "<div style='width: 25%;' class='align-items-center align-self-center pe-0 mb-2'>";
                                        echo "<label>Acta</label>";
                                        echo "<select class='form-select' aria-label='Default select example' name='acta'>";
                                        echo "<option value='3' selected>Sin acta</option>";
                                          $res = $conn->query("select * from acta");
                                          while($row = $res->fetch_row()){
                                              if($row[0] != 3){
                                                echo "<option value='$row[0]'>$row[1]</option>";
                                              }
                                          }
                                        echo "</select>";
                                    echo "</div>";
                                  echo "</div>";
                                echo "</div>";
                              echo "</div>";
                              echo "<div class='contenedor-btn'>";
                                echo "<button name='submit' type='submit' class='btn btn-success mt-3 w-100'>Guardar cambios</button>";
                              echo "</div>";
                            echo "</form>";
                        echo "</div>";
                      echo "</div>";
                    echo "</div>";
                  echo "</div>";
              }
            ?>
        </div>

        <!-- TODO: Modal AGENDAR REUNIÓN -->
        <div class="modal" id="myModal">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header flex-column">
                <h5 class="modal-title">Agendar Reunión</h5>
                <button type="button" class="btn-close px-3" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="recibir_reunion.php" method="POST" id="formulario">
                  
                  <div class="form-group col-4 w-100 py-2">
                      <label>Título</label>
                      <input id="titulo" type="text" name="titulo" class="form-control" spellcheck="true" required minlength="4" maxlength="60" title="Debe contener al menos una letra mayúscula y minúscula, y al menos 4 o más caracteres" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}">
                  </div>
                  <div class="form-group col-4 w-100 py-2">
                      <label>Temas a tratar</label>
                      <textarea name="tema" id="myEditor" required></textarea>
                  </div>
                  <div class="form-group col-4 w-100 py-2">
                      <label>Lugar</label>
                      <input id="lugar" type="text" name="lugar" class="form-control" minlength="4" maxlength="30" required title="Debe contener al menos una letra mayúscula y minúscula, y al menos 4 o más caracteres" pattern="(?=.*[a-z])(?=.*[A-Z]).{4,}">
                  </div>
                  <div class="form-group col-4 w-100 py-2 mx-0">
                    <div class="form-group w-100 mx-0">
                      <div class="w-100 mx-0 input-group col-xl-12 align-self-center row justify-content-start">
                        <div style="width: 25%;" class="align-items-center align-self-center ps-0">
                          <label>Fecha</label>
                          <input id="fecha" type="date" name="fecha" class="w-100 mb-2 form-control" min=<?php $hoy=date("Y-m-d"); echo $hoy;?> required>
                        </div>
                        <div style="width: 25%;" class="align-items-center align-self-center px-0">
                          <label>Hora</label>
                          <input id="hora" type="time" name="hora" class="w-100 mb-2 form-control" required min="08:00" max="23:00">
                        </div>
                        <div style="width: 25%;" class="align-items-center align-self-center pe-0 mb-2">
                          <label>Estado</label>
                          <select class="form-select" aria-label="Default select example" name="estado">
                            <option value="4">por realizar</option>
                            <option value="5">realizada</option>
                          </select>
                        </div>
                        <div style="width: 25%;" class="align-items-center align-self-center pe-0 mb-2">
                            <label>Acta</label>
                            <select class="form-select" aria-label="Default select example" name="acta">
                            <option value='3' selected>Sin acta</option>
                            <?php
                              $res = $conn->query("select * from acta");
                              while($row = $res->fetch_row()){
                                  if($row[0] != 3){
                                    echo "<option value='$row[0]'>$row[1]</option>";
                                  }
                              }
                            ?>
                            </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="contenedor-btn">
                    <button name="submit" type="submit" class="btn btn-success mt-3 w-100">Agendar</button>
                  </div>
                </form>
            </div>
        </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>