<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Área Profesores</title>
</head>
<body>

<?php
include_once ("connection.php");
session_start();

if($_SESSION['active'] === 1)
{
    $profesor = $_SESSION['user'];
    $link = "cursos/index.php";

    echo "<h1>Bienvenido $profesor</h1>";

    echo "<a href=".$link.">Subir Archivo</a>";

}
else{
    header("Location: portalSesionInvalida.html");
    die();
}

?>




</body>
</html>