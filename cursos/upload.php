<?php
session_start();
$target_dir = $_SESSION['dir'];
$target_file = $target_dir . '/' . basename($_FILES["fileToUpload"]["name"]);
echo $target_file;
echo $target_dir;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
// Check if file already exists
if (file_exists($target_file)) {
    echo "Ya existe este archivo, pruebe con otro nombre.";
    $uploadOk = 0;
}
// Check file size


// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Su archivo no fue cargado.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "El archivo " . basename($_FILES["fileToUpload"]["name"]) . " fue cargado exitosamente.";
    } else {
        echo "Hubo in error intentando cargar su archivo. Intente nuevamente.";
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
die();
