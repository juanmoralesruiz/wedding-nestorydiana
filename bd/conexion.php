<?php
$host = "localhost";
$user = "root";           // tu usuario MySQL
$pass = "";               // tu contraseña MySQL
$db   = "invitaciones";   // tu base de datos real

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>