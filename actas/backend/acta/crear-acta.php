<?php
include_once("../../../conexion_bd/conexion.php");

$errores = "";

if (isset($_POST["submit"])) {


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

    $sql = "insert into acta values(null,'$tema','$reu_fecha','$hora_inicio','$hora_termino','$descripcion', $estado)";



    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $sql_reunion = "update reunion set codigo_acta=$last_id where codigo_acta=$codigo_acta";
    } else {
        echo "Error al enviar el acta";
    }

    echo ("Envio exitoso");
    echo ("Prueba");
    header("location:../exito.php?codigo_acta=$codigo_acta&reu_cod=$reu_cod");
}
