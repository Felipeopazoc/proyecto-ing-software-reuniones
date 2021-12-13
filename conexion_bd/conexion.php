<?php

try{

    //Credenciales para la conexion a phpmyadmin
    $host = "localhost";
    $dbname= "6soft2021";
    $username= "root";
    $password = "";
 
    $conn = new mysqli($host,$username,$password,$dbname);

}catch(Exception $e){
    echo "Error: ".$e->getMessage();
}

?>