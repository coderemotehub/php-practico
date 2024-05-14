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
        if(isset($_GET['id'])){
            $id = $_GET['id'];
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
        // obtengo el valor de los parametros id y category_name
        $id = $_GET['id'];
        $name = $_GET['category_name'];
        // construyo el query SQL con los valores que he obtenido de mi URL.
        $sql = "UPDATE categories SET category_name = '$name' WHERE id = $id";
        // ejecturo el query y lo almaceno en una variable
        $queryResult = $conn->query($sql);
        // si el query se ejecuta correctamente
        if ($queryResult ===  TRUE) {
            // pregunto si el numero de filas afectadas/actualizadas es mayor 0
            if($conn->affected_rows == 1){
                // si es mayor a cero
                // construyo un query para obtener la fila actualizada
                $updatedRecordQuery = "SELECT * FROM categories WHERE id = $id";
                // ejecturo el query y lo almaceno en una varaible
                $updatedRecord = $conn->query($updatedRecordQuery); 
                // contruyo un array asociativo con la informacion.
                $response = ["METHOD" => "PUT", "SUCCESS" => true, "DATA" => $updatedRecord->fetch_assoc()];
            } else {
                // si no actualiza ninguna fila, es porque no encontro la categoria
                $response = ["METHOD" => "PUT", "SUCCESS" => false, "ERROR" => "Category not found"];
            }
        } else {
            // si el query no se ejecuta correctamente regreso un error.
            $response = ["METHOD" => "PUT", "SUCCESS" => false, "ERROR" => $conn->error];
        }
        echo json_encode($response);
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
