<?php
require_once "../config.php";

$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

 if($conn->connect_error){
     die("Connection failed: " . $conn->connect_error);
 }

//  IDENTIFY METHOD
$method = $_SERVER['REQUEST_METHOD'];
$response = [];

switch($method){
    case 'GET':
        $id = $_GET['id'];
        if(isset($id)){
            // GET SINGLE CATEGORY
            $sql = "SELECT * FROM categories WHERE id = $id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $response = ["DATA" => $row, "METHOD" => "GET", "SUCCESS" => true];
        } else {
            // GET ALL CATEGORIES
            $sql = "SELECT * FROM categories";
            $result = $conn->query($sql);
            $rows = [];
            while($row = $result->fetch_assoc()){
                $rows[] = $row;
            }
            $response = ["DATA" => $rows, "METHOD" => "GET", "SUCCESS" => true];
        }
        echo(json_encode($response));
        break;
    case 'PUT':
        $result = ["METHOD" => "PUT", "SUCCESS" => true];
        echo(json_encode($result));
        break;
    case 'POST':
        $result = ["METHOD" => "POST", "SUCCESS" => true];
        echo(json_encode($result));
        break;
    case 'DELETE':
        $result = ["METHOD" => "DELETE", "SUCCESS" => true];
        echo(json_encode($result));
        break;
    default: 
        $result = ["METHOD" => $method, "SUCCESS" => false, "ERROR" => "Method not supported"];
        echo(json_encode($result));
        break;
}

//  CRUD METHODS

// Cerrar la conexión
$conn->close();
?>
