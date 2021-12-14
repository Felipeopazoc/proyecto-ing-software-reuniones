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

    echo $reu_cod;
    echo $tema;
    echo $descripcion;
    echo $reu_fecha;
    echo $hora_inicio;
    echo $hora_termino;
    echo $estado;
    echo $codigo_acta;

    $sql = "INSERT INTO acta VALUES(NULL,'$tema','$reu_fecha','$hora_inicio','$hora_termino','$descripcion', $estado)";
    mysqli_query($conn, $sql);


    $id_acta_nueva = mysqli_insert_id($conn);
    $sql_update_reunion = "UPDATE reunion SET codigo_acta = $id_acta_nueva WHERE reu_cod = $reu_cod";
    mysqli_query($conn, $sql_update_reunion);
    echo ("Envio exitoso");
    echo ("Prueba");
    //header("location:./exito.php?codigo_acta=$codigo_acta&reu_cod=$reu_cod");
}
