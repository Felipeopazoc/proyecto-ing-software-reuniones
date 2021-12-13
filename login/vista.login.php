<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/style.css">
    <link href='https://unpkg.com/css.gg/icons/all.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/responsive.css">
</head>


<body style="background-color:#141A32;">

    <div class="text-white w-100" style="">
            <form class="form m-auto mt-5" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>">
                <h1 class="text-center display-6 mb-4 text-white ">Ingrese su información </h1>
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Correo</label>
                    <div style="display:flex; align-items:center; justify-content:center;">
                        <i class="gg-lock"> </i>
                        <input style="margin-left:10px;" type="email" class="form-control" id="correo" required
                            autocomplete="off" placeholder="Por favor ingresar correo" name="correo">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Contraseña</label>
                    <div style="display:flex; align-items:center; justify-content:center;">
                        <i class="gg-keyhole"></i>
                        <input style="margin-left:10px;" type="password" class="form-control" id="password" required
                            autocomplete="off" placeholder="Por favor ingresar contraseña" name="password">
                    </div>
                </div>
                <button type="submit" name="submit" id="button" class="btn btn-primary w-100">Ingresar</button>
                <a class="btn btn-success w-100 mt-2" href="registro_vecinos/index.php">Registrarse</a>
            </form>

    </div>
</body>

</html>
<style>
    @media(max-width:425px){
        .form{
            width: 100%;
        }
    }
</style>