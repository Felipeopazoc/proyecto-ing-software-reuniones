<?php

    include_once('../conexion_bd/conexion.php');

    if(isset($_POST['submit'])){

        $titulo = $_POST['titulo'];
        $tema = $_POST['tema'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $lugar = $_POST['lugar'];
        $estado = $_POST['estado'];
        $acta = $_POST['acta'];

        $sql = "insert into reunion values (NULL,'$titulo', '$tema', '$fecha', '$hora', '$lugar', '$estado', '$acta')";
        $conn->query($sql);
        header('Location: index.php');
    }
?>