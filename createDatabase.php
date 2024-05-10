
<?php 
    $servname = "127.0.0.1:3306";
    $dbname = "practico";
    $user = "root";
    $password = "rootpass";

    $conn = new mysqli($servname, $user, $password, $dbname);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected successfully";
    }

    $sql = "CREATE TABLE productos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        desc TEXT NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        unitCount INT NOT NULL,
        isAvailable BOOLEAN NOT NULL,
        inStock INT NOT NULL
    );";



    $conn->close();
?>