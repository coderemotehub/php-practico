<?php
require_once "../config.php";

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

 if($conn->connect_error){
     die("Connection failed: " . $conn->connect_error);
 } else {
    //  var_dump("Connected successfully");
 }

//  IDENTIFY METHOD
$method = $_SERVER['REQUEST_METHOD'];

var_dump($method);

switch($method){
    case 'GET':
        break;
    default: 
        break;
}

//  CRUD METHODS

// Cerrar la conexión
$conn->close();
?>
