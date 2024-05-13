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


//  creating tables

$createCategories = "
CREATE TABLE IF NOT EXISTS categories ( 
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, category_name VARCHAR(128),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";

$createProducts = "
CREATE TABLE IF NOT EXISTS products ( 
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(128),
    product_desc VARCHAR(256), product_price DECIMAL(10,2), category_id INT(6) UNSIGNED,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);";

// Close connection
$conn->close();
?>
