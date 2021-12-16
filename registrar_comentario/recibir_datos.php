<?php

include_once("../conexion_bd/conexion.php");

if(isset($_POST["submit"])){//Consulto si se hizo envio del formulario
    //Capturamos información del formulario
    $cod_reunion = $_POST["cod_reunion"];
    $rut = $_POST["rut"];
    $tema = $_POST["tema"];
    $descripcion = $_POST["descripcion"];
    date_default_timezone_set("America/Santiago");
     $hora = date('H:i:s',time());
     $fecha = date("Y-m-d",time());
    //es null el primer atributo, ya que el registro es autoincrementable 
     $sql = "insert into comentario values (null,'$descripcion','$tema','$fecha','$hora','$rut',$cod_reunion)";
    $conn -> query($sql);

    header("Location: index.php");
}


?>