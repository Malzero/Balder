<?php
include_once ("connection.php");
session_start();
$ramo = $_POST['ramo'];
$curso = $_POST['curso'];
$query = "SELECT `RAMO` FROM `cursosramos` WHERE `RAMO` = '$ramo' ";
$_SESSION['muestra'] = 1;
$_SESSION['error'] = '';
$_SESSION['OK'] = '';
if ($ramo === '')
{
    $_SESSION['error'] = 'Error. La casilla no puede estar vacía.';
    header("Location: admin.php");
    die();
}
if ( $result = mysqli_query($conn, $query)) {

    if ($result->num_rows != 0) {
        $_SESSION['error'] = 'Error. Este ramo ya existe en el curso '.$curso;
        header("Location: admin.php");
        die();
    }
    else
    {
        $query = "INSERT INTO `prcf`.`cursosramos` (`CURSO`, `RAMO`) VALUES ('$curso', '$ramo') ";
        if ( $result = mysqli_query($conn, $query)) {
            $_SESSION['OK'] = $ramo.' agregado correctamente al curso '.$curso.'.';
            header("Location: admin.php");
            die();
        }
    }
}
else{
    $_SESSION['error'] = 'Error en la conección.';
    header("Location: admin.php");
    die();
}
