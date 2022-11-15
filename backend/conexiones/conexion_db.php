<?php
//*Conectar con el servidor
//parametros de conexion
$servername = "localhost";
//$username = "id18264669_operador";
$username="root";
$password = "SADS@db1988s";
//$db = "id18264669_sadsdb";
$db = "sads_db";

// hacer coneccion
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>