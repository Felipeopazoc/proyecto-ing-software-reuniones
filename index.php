
<link rel="stylesheet" href="login/css/style.css">
<link rel="stylesheet" href="login/css/responsive.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<?php
include_once("conexion_bd/conexion.php");
require("login/vista.login.php");
if(isset($_POST["submit"])){
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    //Sacamos los espacios a los strings
    $correo=trim($correo);
    $correo = filter_var($correo,FILTER_VALIDATE_EMAIL);
    $password = trim($password);

    $sql = "select * from vecino v, pertenece p, rol r where p.rut=v.rut and r.id_rol = p.id_rol and correo='$correo' and password='$password'";
    $resultado = mysqli_query($conn,$sql);

    $filas = mysqli_num_rows($resultado);

    if($filas){
        session_start();
        $rol = "";
        while($vecino = $resultado->fetch_row()){
            $_SESSION["rut"] = $vecino[0];
            $_SESSION["nombre"] = $vecino[1];
            $_SESSION["apellido_paterno"]=$vecino[2];
            $_SESSION["apellido_materno"] = $vecino[3];
            $_SESSION["rol"] =  $vecino[15];
            $rol = $vecino[15];
        }
       

        ?>
        <p  class="w-50 mt-3 text-center m-auto alert alert-success">Usuario encontrado correctamente!</p>
        
        <?php
         if(strcmp($rol,"vecino")==0){
            header("Refresh:3; url=home_vecino/index.php");
        }else if(strcmp($rol,"presidente"==0) || strcmp($rol,"secretario")==0 || strcmp($rol,"tesorero") || strcmp($rol,"delegado")){
            header("Refresh:3; url=home_directiva/index.php");
        }
        
    }else{
        ?>
        <p  class="w-50 mt-3 text-center m-auto alert alert-danger">Correo y/o contraseña inválidos</p>
        <?php
    }
    mysqli_free_result($resultado);
    mysqli_close($conn);
}

?>