<?php
include_once("../../conexion_bd/conexion.php");

$errores = "";

if (isset($_POST["submit"])) {

    $reu_cod = $_POST["reu_cod"];
    $tema = $_POST["tema"];
    $descripcion = $_POST["reu_descripcion"];
    $reu_fecha = $_POST["reu_fecha"];
    $hora_inicio = $_POST["hora_inicio"];
    $hora_termino = $_POST['hora_termino'];

    $estado = $_POST["id_estado"];
    $codigo_acta = $_POST["codigo_acta"];


    $sql = "update acta set  tema='$tema', fecha='$reu_fecha',hora_inicio ='$hora_inicio',hora_termino='$hora_termino',descripcion='$descripcion', id_estado=$estado  where codigo_acta=$codigo_acta";

    $conn->query($sql);
    echo ("Envio exitoso");
    echo ("Prueba");
    header("location:./exito.php?codigo_acta=$codigo_acta&reu_cod=$reu_cod");
}
