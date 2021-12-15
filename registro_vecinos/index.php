<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/responsive.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

$errores = "";
include_once("../conexion_bd/conexion.php");
require 'views/index.view.php';

if(isset($_POST["submit"])){
    $rut = $_POST["rut"];
    $nombre = $_POST["nombre"];
    $apellido_p = $_POST["apellido_paterno"];
    $apellido_m = $_POST["apellido_materno"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $rut = trim($rut);
    $nombre = trim($nombre);
    $apellido_p = trim($apellido_p);
    $apellido_m = trim($apellido_m);
    $direccion = trim($direccion);
    $correo = trim($correo);
    $password = trim($password);
    $id_comunidad = $_POST["id_comunidad"];
    $sql3="";
    if($id_comunidad==0){
        $sql = "insert into vecino values('$rut','$nombre','$apellido_p','$apellido_m','$direccion','$telefono','$correo','$password',1)";
        $conn -> query($sql);
        ?>
            <p class="w-50 m-auto mt-3 mb-3 text-center alert alert-success">Usuario registrado correctamente</p>
        <?php
 
        
    }else{
        $sql2 = "insert into vecino values('$rut','$nombre','$apellido_p','$apellido_m','$direccion','$telefono','$correo','$password',1)";
    
        $conn -> query($sql2);
        $fechaActual = date("y-m-d",time());
        $sql3 = "insert into pertenece values($id_comunidad,1,'$rut',$fechaActual','$fechaActual')";
        $conn-> query($sql3);
        
        ?>
            <p class="w-50 m-auto mt-3 mb-3 text-center alert alert-success">Usuario registrado correctamente</p>
        <?php
       
    }
    
    ?>
    

    <?php
    
} 
    ?>
   
    




