<?php
//*Conectar con el servidor
//parametros de conexion
//$servername = "localhost";
$servername = "localhost";
$username = "u142007641_admin_test";
//$username="root";
//$password = "SADS@db1988s";
$password = "Adminsads14";
$db = "u142007641_sads_db";
//$db = "sads_db";

// hacer coneccion
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    
    die("Connection failed: " . $conn->connect_error);
    echo "conexion fallida";
}
?>