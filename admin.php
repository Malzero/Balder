<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <title>Administración de PRCF</title>
</head>
<body>


<?php
    include_once("connection.php");
    session_start();

    if ($_SESSION['active']!== 1 or $_SESSION["rol"] !== '3')
    {
        die("Acceso sin autorización.");
    }







    $usuario = $_SESSION['user'];
    echo "<h1>Bienvenido $usuario</h1>";
    $error = '';
    $ok = '';
    if (isset($_SESSION['muestra']))
    {
        if($_SESSION['muestra'] === 1)
        {
            if(isset($_SESSION['error']))
                $error = $_SESSION['error'];
            if (isset($_SESSION['OK']))
                $ok = $_SESSION['OK'];
        }

    }


    echo "<p id='error'>$error</p>";
    echo "<p id='ok'>$ok</p>";

    echo "
            <div id='icons'>
                <button class='accordion'>Administrar Ramos</button>";


    echo "<div class='panel'>

    
    <button class='accordion2'>Crear Ramo</button>
    <div class='panel3'>
    
    <form name='form' method='post' action='crearRamo.php'>
    Nombre Ramo:<br>
    <input type='text' name='ramo' id='ramo' placeholder='Ramo-número'>
     <br>
    <input type='submit' name='submit' value='Ingresar' align='center'>
    </form>
    
    </div>
    
     <br>

      <button class='accordion2'>Eliminar Ramo</button>
      
      <div class='panel3'>";

    $query = 'SELECT `RAMO` FROM `ramos`';

   if ( $result = mysqli_query($conn, $query)) {

        if ($result->num_rows != 0) {

            echo "Seleccione el ramo que desee borrar: <br>";
            echo "<form name='form' method='post' action='eliminarRamo.php'><select name='ramo'>";
            $rows = array();
            while($row = $result->fetch_assoc()){
                $rows[] = $row;

                echo "<option name='ramo' id='ramo' value='" . $row['RAMO'] . "'>" . $row['RAMO'] . "</option>";
            }
            echo "";
            echo "</select><br><input type='submit' name='submit' value='Borrar selección' align='center'></form>";
        }
    }



    echo "
    </div>
    
    <br>
    
    <button class='accordion2'>Agregar ramo a curso</button>
      
      <div class='panel3'>";
        $query = 'SELECT `RAMO` FROM `ramos`';

        if ( $result = mysqli_query($conn, $query)) {

            if ($result->num_rows != 0) {

                echo "Seleccione el ramo que desee agregar: <br>";
                echo "<form name='form' method='post' action='agregarCurso.php'><select name='ramo'>";
                $rows = array();
                while ($row = $result->fetch_assoc()) {
                    $rows[] = $row;

                    echo "<option name='ramo' id='ramo' value='" . $row['RAMO'] . "'>" . $row['RAMO'] . "</option>";
                }
                echo "</select><br><br>";
                $query = 'SELECT `CURSO` FROM `cursos`';

                if ($result = mysqli_query($conn, $query)) {

                    if ($result->num_rows != 0) {

                        echo "Seleccione el curso destinado: <br>";
                        echo "<select name='curso'>";
                        $rows = array();
                        while ($row = $result->fetch_assoc()) {
                            $rows[] = $row;

                            echo "<option name='curso' id='curso' value='" . $row['CURSO'] . "'>" . $row['CURSO'] . "</option>";
                        }
                        echo "";
                        echo "</select><br><input type='submit' name='submit' value='Agregar ramo' align='center'><br></form>";
                    }
                }
            }
        }


    echo "</div>
    
    
    </div>
";


    echo "</div>";
    echo "</div>";

    $_SESSION['muestra'] = 0;
?>

<script type="text/javascript">

    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
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

<script type="text/javascript">

    var acc = document.getElementsByClassName("accordion2");
    var j;

    for (j = 0; j < acc.length; j++) {
        acc[j].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel3 = this.nextElementSibling;
            if (panel3.style.display === "block") {
                panel3.style.display = "none";
            } else {
                panel3.style.display = "block";
            }
        });
    }
</script>

</body>
</html>
