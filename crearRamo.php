<?php
include_once ("connection.php");
session_start();
$ramo = $_POST['ramo'];
$query = "SELECT `RAMO` FROM `ramos` WHERE `RAMO` = '$ramo' ";
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
        $_SESSION['error'] = 'Error. Ramo existente';
        header("Location: admin.php");
        die();
    }
    else
    {
        $query = "INSERT INTO `prcf`.`ramos` (`RAMO`) VALUES ('$ramo') ";
        if ( $result = mysqli_query($conn, $query)) {
            $_SESSION['OK'] = 'Ramo agregado correctamente.';
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