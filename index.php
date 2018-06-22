<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="styles.css">

	<title>Plataformas de Recursos Compartidos FODEC</title>
</head>
<body>

<?php
include_once ("connection.php");
session_start();



if($_SESSION['active'] ===1)
{
    $tabla = "cuentascursos";
    $usuario = $_SESSION['user'];
    $query = "SELECT `RAMO` FROM `cursosramos` WHERE `CURSO` IN (SELECT `CURSO` FROM `cuentascursos` WHERE `USUARIOS` = '$usuario') ";

    if ( $result = mysqli_query($conn, $query)) {

        if ($result->num_rows != 0) {

            $rows = array();
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
        }
    }
    echo "<h1>Bienvenido  $usuario</h1> ";

    echo "<div id ='frame''>";

    echo "<div id='menu'>";
    $i = 0;
    while ($i < $result->num_rows){

        echo "
        <div id='icons'>
			<button class=\"accordion\">";print $rows[$i]['RAMO']; echo "</button>";
            $ramo = $rows[$i]['RAMO'];
			$queryb = "SELECT `MATERIA` FROM `ramosmaterias` WHERE `RAMO` = '$ramo'";

            if ( $resultb = mysqli_query($conn, $queryb)) {

              if ($resultb->num_rows != 0) {

                $rowsb = array();
                while($rowb = $resultb->fetch_assoc()){
                  $rowsb[] = $rowb;
                }
              }
            }
            $j = 0;
            echo "<div class='panel'>";
            while ($j < $resultb->num_rows) {

                //echo $j;
                //echo $resultb->num_rows;
                $materia = $rowsb[$j]['MATERIA'];
                echo $ramo.'/'.$materia;
                echo "<br><button id='boton' class='panel2'>";
                print $rowsb[$j]['MATERIA'];
                echo "</button><br>";
                $j++;
            }
            echo "</div>";



        echo "</div>";

        $i++;
    }
    echo "</div>";
    echo "</div>";


}else
    echo "ERROR. No se pudo procesar la query <br/>";
//die();


?>

	<script type="text/javascript">
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
        document.getElementById("boton").onclick = showNavigator();
        function showNavigator(path)
        {
            var ruta = "cursos/navigator.php?path=";
            var carpeta = ruta.concat(path);
            var target = document.getElementById("frame");
            var newFramve = document.createElement("iframe");
            newFramve.setAttribute("src", "https://www.google.com/");
            target.insertBefore(newFramve,target.firstChild);

        }
	</script>
</body>

</html>