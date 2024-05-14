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
        // almaceno el valor del body de mi request en una variable
        $data = json_decode(file_get_contents('php://input'), true);
        // obtener el valor del category_name
        $name = $data['category_name'];
        // construyo mi query SQL para crear la nueva categoria
        $sql = "INSERT INTO categories (category_name) VALUES ('$name')";
        // ejecuto el query y almaceno el resultado en una variable
        $createResult = $conn->query($sql);
        if($createResult === TRUE){
            // se creo exitosamente
            // obtengo el ID del nuevo registro (recien creado)
            $newRecordId = $conn->insert_id;
            // construyo un query para obtener el nuevo registro y regresarlo en mi respuesta. 
            $getRecordQuery = "SELECT * FROM categories where id = $newRecordId";
            // ejectuo el query y almaceno el resultado en una variable.
            $newRecord = $conn->query($getRecordQuery);
            // construyo mi respuesta
            $response = ["METHOD" => "POST", "SUCCESS" => true, "DATA" => $newRecord->fetch_assoc()];
        } else {
            // no se creo existosamente
            $response = ["METHOD" => "POST", "SUCCESS" => false, "ERROR" => $conn->error];
        }
        echo(json_encode($response));
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
