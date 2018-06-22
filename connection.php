<?php

$serverName = "localhost";
$username = 'root';
$password = '';
$db = 'prcf';
$conn = new mysqli($serverName, $username, $password, $db) or die("No se puede conectar");

if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);