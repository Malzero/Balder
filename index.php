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
    $i = 0;
    while ($i < $result->num_rows){

        echo "
        <div id=\"icons\">
			<button class=\"accordion\">";print $rows[$i]['RAMO']; echo "</button>
			<div class=\"panel\">
				<a></a>
			</div>
			<br>
        
        ";
        $i++;
    }

}else
    echo "ERROR. No se pudo procesar la query <br/>";
die();


?>
		
		<div id="taskbar">		
		</div>
		
		<div id="icons">
			<h1>Plataforma de Recursos Compartidos FODEC</h1>

			<button class="accordion">Quimica</button>
			<div class="panel">
				<a>Química 1*medio</a>
			</div>
			<br>
			<button class="accordion">Fisica</button>
			<div class="panel">
				<a>Física 1*medio</a>
			</div>

		</div>




	</div>

	<script>
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
	</script>
</body>

</html>