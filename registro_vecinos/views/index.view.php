<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Vecinos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/responsive.css">
</head>
<body >
    
    <div class="w-100" class="color-claro" style="background-color: #141A32; min-height:850px;">
        <div class="header">
            <div class="mensaje">
                <h1>Plataforma reuniones</h1>
            </div>
            <nav class="nav">
                <a class="btn btn-danger" href="../index.php">Iniciar sesión</a>
            </nav>
        </div>

        <h1 class="text-center text-white mt-4">Formulario de Registro</h1>
        <form class="form border" style="border-radius:10px"
            action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
           
            <div class="mb-3 mt-2 col-6">
                <label for="rut" class="form-label">Rut</label>
                <input type="text" class="form-control" placeholder="Formato(xx.xxx.xxx-x)" name="rut" required>
            </div>
            <div class="mb-3 mt-2 col-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" placeholder="Ingresar Nombre" name="nombre" required>
            </div>

            <div class="mb-3 mt-2 col-6">
                <label for="apellido_p" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" placeholder="Ingresar Apellido" name="apellido_paterno" required>
            </div>

            <div class="mb-3 mt-2 col-6">
                <label for="apellido_m" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" placeholder="Ingresar Apellido" name="apellido_materno" required>
            </div>
            <div class="mb-3 mt-2 col-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" placeholder="Ingresar Direccion" name="direccion" required>
            </div>

            <div class="mb-3 mt-2 col-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="number" class="form-control" placeholder="Ingresar Telefono" name="telefono" required>
            </div>

            <div class="mb-3 mt-2 col-6">
                <label for="email" class="form-label">Correo:</label>
                <input type="email" class="form-control" placeholder="Ingresar Correo" name="correo" required>
            </div>

            <div class="mb-3 mt-2 col-6">
                <label for="pwd" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" placeholder="Ingresar Contraseña" name="password" required>
            </div>
            <div class="mb-3 mt-2 col-12">
                <label for="pwd" class="form-label">Comunidad:</label>
                <select name="id_comunidad" class="form-select text-black"> 
                    <option value="0">Seleccione la Comunidad</option>
                    <?php 
                        include_once("./conexion_bd/conexion.php");
                        $sql = "SELECT * FROM COMUNIDAD";
                        $resultado = mysqli_query($conn,$sql);
                        while($comunidad = $resultado->fetch_row()){
                            echo "<option class='option' value='$comunidad[0]'>$comunidad[1]</option>";
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="submit" class="m-auto btn btn-primary w-100">Enviar Datos</button>
        </form>
    </div>

</body>

</html>