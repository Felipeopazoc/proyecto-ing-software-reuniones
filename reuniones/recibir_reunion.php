<?php

    include_once('../conexion_bd/conexion.php');

    if(isset($_POST['submit'])){

        $titulo = $_POST['titulo'];
        $tema = $_POST['tema'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $lugar = $_POST['lugar'];
        $estado = $_POST['estado'];

        $sql = "insert into reunion values (null,'$titulo', '$tema', '$fecha', '$hora', '$lugar', $estado,3)";
        $conn->query($sql);
        $result="<div class='alert alert-success'>Thank You! I will be in touch</div>";
        header('Location: index.php');
    }
?>