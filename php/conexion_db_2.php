<?php
//*Conectar con el servidor
//parametros de conexion
//$servername = "localhost";
$servername = "localhost";
$username = "id19355992_admin_sads";
//$username="root";
//$password = "SADS@db1988s";
$password = "Cautinlupa@8";
$db = "id19355992_sads_db";
//$db = "sads_db";

// hacer coneccion
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>