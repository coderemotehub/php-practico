<?php
require_once "../config.php";

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

 if($conn->connect_error){
     die("Connection failed: " . $conn->connect_error);
 } else {
     echo "Connected successfully";
 }

// Cerrar la conexión
$conn->close();
?>
