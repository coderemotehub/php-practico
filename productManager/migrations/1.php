<?php
 $servname = "127.0.0.1:3306";
 $dbname = "product_manager";
 $user = "root";
 $password = "rootpass";

 $conn = new mysqli($servname, $user, $password, $dbname);

 if($conn->connect_error){
     die("Connection failed: " . $conn->connect_error);
 } else {
     echo "Connected successfully";
 }

// Cerrar la conexión
$conn->close();
?>
