<?php
include_once("../../conexion_bd/conexion.php");

$errores = "";

if (isset($_POST["submit"])) {

    $tema = $_POST["tema"];
    $descripcion = $_POST["reu_descripcion"];
    $reu_fecha = $_POST["reu_fecha"];
    $hora_inicio = $_POST["hora_inicio"];
    $hora_termino = $_POST['hora_termino'];

    $estado = $_POST["estado"];
    $codigo_acta = $_POST["codigo_acta"];
    echo "
        tema: $tema <br>
        descripcion: $descripcion <br>
        fecha: $reu_fecha <br>
        hora_inicio: $hora_inicio <br>
        hora_termino: $hora_termino <br>
        estado: $estado <br>
        codigo_acta: $codigo_acta <br>
        ";

    // $query = "update acta set tema = '$tema' , fecha = '$reu_fecha' , hora_inicio = '$hora_inicio' , hora_termino = '$hora_termino' , estado = '$estado' , descripcion = '$descripcion' where codigo_acta = '$codigo_acta'";
    // mysqli_query($conn, $query);
    // header("location:./exito-acta.php?codigo_acta=$codigo_acta");
    //$sql3 = $sql1 . $sql2;
    //echo $sql3;
    // $sql = "update acta set tema='$tema', fecha='$reu_fecha', hora_inicio ='$hora_inicio', hora_termino='$hora_termino', descripcion='$descrid_estado=$estado  where codigo_acta=$codigo_acta";

    // if ($conn->query($sql) === TRUE) {
    //     echo ("Envio exitoso");
    //     echo ("Prueba");
    //     header("location:./exito-acta.php?codigo_acta=$codigo_acta");
    // } else {
    //     echo $tema;
    //     echo $descripcion;
    //     echo $reu_fecha;
    //     echo $hora_inicio;
    //     echo $hora_termino;
    //     echo $estado;
    //     echo $codigo_acta;
    //     echo "Error al enviar el acta";
    // }
}
