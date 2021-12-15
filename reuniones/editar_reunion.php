<?php

    include_once('../conexion_bd/conexion.php');

    if(isset($_POST['submit'])){

        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $tema = $_POST['tema'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $lugar = $_POST['lugar'];
        $estado = $_POST['estado'];
        $acta = $_POST['acta'];

        $sql = "UPDATE reunion SET reu_titulo='$titulo', reu_tema='$tema', reu_fecha='$fecha', hora='$hora', reu_lugar='$lugar', id_estado='$estado', codigo_acta='$acta' WHERE reu_cod='$id'";
        // $conn->query($sql);
        mysqli_query($conn, $sql);
        header('Location: index.php');
    }
?>