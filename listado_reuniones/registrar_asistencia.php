
<?php
    include_once("../conexion_bd/conexion.php");
    if(isset($_POST["submit"])){
        $rut = $_POST["rut"];
        $cod_reunion = $_POST["cod_reunion"];

        $sql1 = "select * from asiste where rut='$rut' and reu_cod = '$cod_reunion'";
        $resultado = mysqli_query($conn,$sql1);
        $filas = mysqli_num_rows($resultado);

        if($filas){
            ?>
             <p class="btn btn-danger m-auto">Ya se registró asistencia</p>
            <?php
        }else{
            echo $rut." ".$cod_reunion;
            $sql = "insert into asiste values('$rut','$cod_reunion')";
            $conn->query($sql);
            header("Location: index.php");
        }
        
       
    }


?>