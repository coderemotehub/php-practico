<?php
 $servname = "127.0.0.1:3306";
 $dbname = "product_manager";
 $user = "root";
 $password = "rootpass";

 $conn = new mysqli($servname, $user, $password, $dbname);

 if($conn->connect_error){
     die("Connection failed: " . $conn->connect_error);
     echo "<br>";
 } else {
     echo "Connected successfully";
     echo "<br>";
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

$createInvoices = "
    CREATE TABLE IF NOT EXISTS invoices (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        customer_nif VARCHAR(8), total_amount DECIMAL(10,2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );";

$createProductInvoice = "
    CREATE TABLE IF NOT EXISTS product_invoice (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        product_id INT(6) UNSIGNED, 
        invoice_id INT(6) UNSIGNED,
        quantity INT(6) UNSIGNED,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (product_id) REFERENCES products(id),
        FOREIGN KEY (invoice_id) REFERENCES invoices(id)
    );
";

// create categories table
if($conn->query($createCategories) == TRUE){
    echo "Created Table: Categories";
    echo "<br>";
} else {
    echo "ERROR: cannot create table: Categories";
    echo "<br>";
    echo $conn->error;
    echo "<br>";
}

// create products table
if($conn->query($createProducts) == TRUE){
    echo "Created Table: Products";
    echo "<br>";
} else {
    echo "ERROR: cannot create table: Products";
    echo "<br>";
    echo $conn->error;
    echo "<br>";
}

// create invocies table
if($conn->query($createInvoices) == TRUE){
    echo "Created Table: invoices";
    echo "<br>";
} else {
    echo "ERROR: cannot create table: invoices";
    echo "<br>";
    echo $conn->error;
    echo "<br>";
}

// create product_invoice table
if($conn->query($createProductInvoice) == TRUE){
    echo "Created Table: product_invoice";
    echo "<br>";
} else {
    echo "ERROR: cannot create table: product_invoice";
    echo "<br>";
    echo $conn->error;
    echo "<br>";
}

// Close connection
$conn->close();
?>
