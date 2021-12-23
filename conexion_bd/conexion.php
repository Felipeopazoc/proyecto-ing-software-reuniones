<?php

try{

    //Credenciales para la conexion a phpmyadmin
    $host = "mysql.face.ubiobio.cl";
    $dbname= "6soft2021";
    $username= "g6soft";
    $password = "g6isw2021";
 
    $conn = new mysqli($host,$username,$password,$dbname);

}catch(Exception $e){
    echo "Error: ".$e->getMessage();
}

?>
