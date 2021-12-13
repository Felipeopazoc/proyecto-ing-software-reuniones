<?php
include_once("../conexion_bd/conexion.php");
if(isset($_POST["submit"])){
    $id =  $_POST["id_comentario"];
    $tema = $_POST["tema"];
    $comentario =  $_POST["comentario"];  

    echo $id;
    echo "</br>";
    echo $tema;
    echo "</br>";
    echo $comentario;

    
    $sql = "update comentario set tema='$tema', descripcion='$comentario' where cod_comentario=$id";

    $conn->query($sql);

    header("Location: index.php");

    /* 
    UPDATE nombre_tabla
    SET columna1 = valor1, columna2 = valor2
    WHERE columna3 = valor3
    
    */

}



?>