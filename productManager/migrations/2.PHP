<?php
    require_once "../config.php";

    $conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
        echo "<br>";
    } else {
        echo "Connected successfully";
        echo "<br>";
    }

    function importCsvData($fileName, $tableName, $columns) {
        global $conn;
    
        // Open the CSV file
        if (($handle = fopen($fileName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $values = implode("','", array_map("escapeData", $data)); // 1,Electronics -> [1,Electronics]
                $sql = "INSERT INTO $tableName ($columns) VALUES ('$values');";
                echo "<br>". $sql . "<br>";
                if (!$conn->query($sql)) {
                    echo "Error importing data into $tableName: " . $conn->error . "<br>";
                }
            }
            fclose($handle);
            echo "Imported data into $tableName successfully.<br>";
        } else {
            echo "Failed to open $fileName.<br>";
        }
    }

    function escapeData($data) {
        global $conn;
        return $conn->real_escape_string(trim($data));
    }

    // Specify file names and corresponding table and column names
    $csvFiles = [
        ["fileName" => "./CSV/categories.csv", "tableName" => "categories", "columns" => "id, category_name"],
        ["fileName" => "./CSV/products.csv", "tableName" => "products", "columns" => "id, product_name, product_desc, product_price, category_id"],
        ["fileName" => "./CSV/invoices.csv", "tableName" => "invoices", "columns" => "id, customer_nif, total_amount"],
        ["fileName" => "./CSV/product_invoice.csv", "tableName" => "product_invoice", "columns" => "id, product_id, invoice_id, quantity"]
    ];

    // Import each CSV file into the corresponding table
    foreach ($csvFiles as $file) {
        importCsvData($file["fileName"], $file["tableName"], $file["columns"]);
    }

    // Close connection
    $conn->close();
?>
