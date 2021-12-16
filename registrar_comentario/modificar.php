<?php
include_once("../conexion_bd/conexion.php");
if(isset($_POST["submit"])){//Preguntamos si se envió el formulario
    //capturamos la informacion desde el formulario
    $id =  $_POST["id_comentario"];
    $tema = $_POST["tema"];
    $comentario =  $_POST["comentario"];  
    //String sql para actualizar la tabla comentario
    $sql = "update comentario set tema='$tema', descripcion='$comentario' where cod_comentario=$id";
    //Ejecutamos la consulta
    $conn->query($sql);
    //redirigimos a nuestro index.php
    header("Location: index.php");

    /* 
    UPDATE nombre_tabla
    SET columna1 = valor1, columna2 = valor2
    WHERE columna3 = valor3
    
    */

}



?>