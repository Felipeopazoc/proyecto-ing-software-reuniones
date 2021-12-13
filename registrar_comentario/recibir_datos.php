<?php

include_once("../conexion_bd/conexion.php");

if(isset($_POST["submit"])){
    $cod_reunion = $_POST["cod_reunion"];
    $rut = $_POST["rut"];
    $tema = $_POST["tema"];
    $descripcion = $_POST["descripcion"];
    date_default_timezone_set("America/Santiago");
     $hora = date('H:i:s',time());
     $fecha = date("Y-m-d",time());

     $sql = "insert into comentario values (null,'$descripcion','$tema','$fecha','$hora','$rut',$cod_reunion)";
    $conn -> query($sql);

    header("Location: index.php");
}


?>