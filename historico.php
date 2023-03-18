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
$Comando_t = "SELECT * from Registros";
$Comando_g = "SELECT nombre, psi FROM Registros ORDER BY psi DESC";
$Comando_gg = "SELECT nombre, psi, fecha, hora FROM Registros ORDER BY fecha AND hora ASC";
?>

<style>
    <?php include "style.css"?>
</style>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        <?php $Grafica = mysqli_query($conexion, $Comando_g);?>

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Fecha', 'PSI'],
            <?php
            if($Grafica->num_rows > 0){
                while($row = $Grafica->fetch_assoc()){
                    echo "['".$row['nombre']."', ".$row['psi']."],";
                }
            }
            ?>
            ]);

            var options = {
                title: 'Comparativa (% de PSI)',
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);

            var options = {
                title: 'Valvulas (PSI)',
                hAxis: {title: 'Grafico de Valvulas por un tiempo determinado',  titleTextStyle: {color: '#333'}},
                vAxis: {minValue: 0}
            };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);

        }
    </script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script>
   google.load("visualization", "1", {packages:["corechart"]});
   google.setOnLoadCallback(dibujarGrafico);

   <?php $Grafica = mysqli_query($conexion, $Comando_gg);?>

   function dibujarGrafico() {
    
     var data = google.visualization.arrayToDataTable([
       ['Fecha', 'PSI'],
       <?php
            if($Grafica->num_rows > 0){
                while($row = $Grafica->fetch_assoc()){
                    echo "['".$row['fecha']."', ".$row['psi']."],";
                }
            }
        ?>    
     ]);
     var options = {
       title: 'Grafica de PSI en un periodo de tiempo determinado'
     }
     
     new google.visualization.ColumnChart( 
     
       document.getElementById('Grafico')
     ).draw(data, options);
   }
 </script>

    <title>Historical</title>
</head>
<body>
    
    <header><h1><a href="index.php">Registro</a> | <a href="historico.php">Historial</a></h1></header>

    <table>
        <tr>
            <td class="black"><b>id</b></td>
            <td class="black"><b>Nombre</b></td>
            <td class="black"><b>PSI</b></td>
            <td class="black"><b>Fecha</b></td>
            <td class="black"><b>Hora</b></td>
        </tr>

        <?php
        
        $Resultado = mysqli_query($conexion, $Comando_t);

        while($Datos = mysqli_fetch_array($Resultado)) {
        
        ?>

        <tr>
            <td class="darkm"><?php echo $Datos['id']?></td>
            <td class="darkm"><?php echo $Datos['nombre']?></td>
            <td class="darkm"><?php echo $Datos['psi']?></td>
            <td class="darkm"><?php echo $Datos['fecha']?></td>
            <td class="darkm"><?php echo $Datos['hora']?></td>
        </tr>

        <?php
        }
        ?>
        
    </table><br><br>

    <h2>Gráficas</h2>

    <div class="centrado">
        <div id="piechart" style="width: 100%; height: 600px"></div>
        <div id="Grafico" style="width: 100%; height: 600px"></div>
    </div>

</body>

</html>