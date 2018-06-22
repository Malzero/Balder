<?php
include_once ("connection.php");
session_start();
$usuario = $_POST['usuario'];
$contra = $_POST['contra'];
$tabla = "cuentas";
$query = "SELECT `USUARIO`,`PASS`, `ROL`  FROM `$tabla` WHERE `USUARIO` = '$usuario'";

if ( $result = mysqli_query($conn, $query)) {

    if ($result->num_rows != 0) {

        $fila = mysqli_fetch_row($result);

        if ( $fila[1] === $contra) {


           if ($fila[2] === '1') {
               $_SESSION['user'] = $fila[0];
               $_SESSION['active'] = 1;
               header("Location: areaProfesor.php");

           }


        }
        else{
            header("Location: portalSesionInvalida.html");
            die();
        }


    }
    else{
        header("Location: portalSesionInvalida.html");
        die();
    }

}else
    echo "ERROR. No se pudo procesar la query <br/>";

