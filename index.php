<?php
$servername = "sql10.freesqldatabase.com";
$database = "sql10606413";
$username = "sql10606413";
$password = "lemxDYRTpz";
// Create connection
$conexion = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conexion) {
    die("Conexion fallida: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/nuevostate.js"></script>
    <title>Historical</title>
</head>
<body>
    
    <header><h1><a href="index.php">Registro</a> | <a href="historico.php">Historial</a></h1></header>

    <form action="" method="POST" class="datos" id="form">
        <br><br>
        <label for="name">Nombre del pozo: </label>
        <input type="text" name="nombre" id="nombre" required/>
        <label for="name">PSI: </label>
        <input type="number" name="psi" id="psi" required/><br><br><br>
        <input type="submit" name="btn" class="boton">

    </form>

    <?php

    if(isset($_POST['btn'])) {

        if(($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['psi']) && !empty($_POST['psi'])) {

            $Nombre = $_POST['nombre'];
            $PSI = $_POST['psi'];
            
            $Comando = "INSERT INTO `Registros`(`nombre`, `psi`, `fecha`, `hora`) VALUES ('$Nombre',$PSI,CURDATE(),CURTIME())";

            if (mysqli_query($conexion, $Comando)) {
                echo '<script language="javascript">alert("¡Registro completado con exito!");</script>';
                mysqli_close($conexion);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
            }

        } elseif (empty($_POST['nombre'])) {
            echo '<script language="javascript">alert("Por favor. Rellene todos los campos");</script>';
        }
    }

    ?>

</body>

</html>