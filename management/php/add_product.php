<?php 
require("db.php");

$category = $_POST['category'];
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_quantity = $_POST['product_quantity'];
$product_amount = $_POST['product_amount'];

$product_pic = $_FILES['product_pic'];

$pro_pic_name = $product_pic['name']; 
$location = $product_pic['tmp_name'];

// Check if the product table exists
$table_exists = $db->query("SHOW TABLES LIKE 'product'")->num_rows > 0;

if (!$table_exists) {
    // Create the product table if it doesn't exist
    $create_table_query = "CREATE TABLE product (
        id INT(11) NOT NULL AUTO_INCREMENT,
        category VARCHAR(100),
        product_pic VARCHAR(200),
        product_name VARCHAR(200),
        product_description TEXT,
        product_quantity VARCHAR(100),
        product_amount VARCHAR(100),
        PRIMARY KEY(id)
    )";

    if (!$db->query($create_table_query)) {
        echo "Failed to create product table";
        exit();
    }
}

// Check if the file already exists
if (file_exists("../../product_pic/".$pro_pic_name)) {
    echo "File already exists";
    exit();
}

// Move the uploaded file to the desired location
if (!move_uploaded_file($location, "../../product_pic/".$pro_pic_name)) {
    echo "Failed to upload file";
    exit();
}

// Insert the product data into the database
$insert_query = "INSERT INTO product (category, product_pic, product_name, product_description, product_quantity, product_amount) 
                 VALUES ('$category', '$pro_pic_name', '$product_name', '$product_description', '$product_quantity', '$product_amount')";

if ($db->query($insert_query)) {
    echo "success";
} else {
    echo "Failed to insert data into database";
}

$db->close();
?>
