<?php
require("db.php");
if(isset($_GET['payment_status']))
{
    if($_GET['payment_status'] != 'Credit')
    {
        die("Payment Failed");
    }
}
// Retrieve parameters from the URL
$pro_id = isset($_GET['p_id']) ? $_GET['p_id'] : null;
$product_qty = isset($_GET['p_qty2']) ? intval($_GET['p_qty2']) : 0; // Corrected key name
$p_mode = isset($_GET['p_mode']) ? $_GET['p_mode'] : null;

$payment_status = "";

if($p_mode == 'online')
{
    $payment_status = "complete";
}
else if($p_mode == 'cod')
{
    $payment_status = "pending";
}

if (!$pro_id || !$p_mode) {
    echo "Invalid parameters.";
    exit;
}
$order_date = date("Y-m-d");
// Fetch product details from the database
$pro_sql = $db->query("SELECT * FROM product WHERE id='$pro_id'");
$aa = $pro_sql->fetch_assoc();

// Check if product details exist
if ($aa) {
    // Product details exist, retrieve product name and amount
    $product_name = $aa['product_name'];
    $product_amount = floatval($aa['product_amount']);
    $p_pic = $aa['product_pic'];

    // Calculate total price amount
    $tp_amount = $product_qty * $product_amount;

    // Retrieve user details
    $user_email = base64_decode($_COOKIE['_aut_ui_']);
    $user_response = $db->query("SELECT * FROM register WHERE email='$user_email'");
    $user_aa = $user_response->fetch_assoc();
    $c_name = $user_aa['fullname'];
    $c_mobile = $user_aa['mobile'];
    $c_address = $user_aa['address'];

    // Check if the 'receive_order' table exists
    $check = $db->query("SHOW TABLES LIKE 'receive_order'");

    if ($check->num_rows > 0) {
        // Insert order details into the database
        $store = $db->query("INSERT INTO receive_order (order_date,p_name,p_pic, p_amount, tp_amount, p_qty, c_name, c_mobile, c_email, c_address, payment_mode,payment_status) 
                                 VALUES ('$order_date','$product_name','$p_pic' ,'$product_amount', '$tp_amount', '$product_qty', '$c_name', '$c_mobile', '$user_email', '$c_address', '$p_mode','$payment_status')");

        if ($store) {
             header("Location:../my_order.php");
        } else {
            echo "failed";
        }
    } else {
        // Create 'receive_order' table if it does not exist
        $create_table_query = "
            CREATE TABLE receive_order (
                id INT(11) NOT NULL AUTO_INCREMENT,
                order_date DATE,
                p_name VARCHAR(255),
                p_pic VARCHAR(255),
                p_amount DECIMAL(10, 2),
                tp_amount DECIMAL(10, 2),
                p_qty INT(11),
                c_name VARCHAR(255),
                c_mobile VARCHAR(255),
                c_email VARCHAR(255),
                c_address VARCHAR(255),
                payment_mode VARCHAR(255),
                payment_status VARCHAR(255),
                order_status VARCHAR(255),
                PRIMARY KEY(id)
            )
        ";
        $create_table_result = $db->query($create_table_query);

        if ($create_table_result) {
            // Insert order details into the newly created table
            $store = $db->query("INSERT INTO receive_order (order_date,p_name,p_pic, p_amount, tp_amount, p_qty, c_name, c_mobile, c_email, c_address, payment_mode,payment_status) 
                                 VALUES ('$order_date','$product_name','$p_pic' ,'$product_amount', '$tp_amount', '$product_qty', '$c_name', '$c_mobile', '$user_email', '$c_address', '$p_mode','$payment_status')");
            
            if ($store) {
                header("Location:../my_order.php");
            } else {
                echo "failed";
            }
        } else {
            echo "Failed to create 'receive_order' table.";
        }
    }
} else {
    echo "Product details not found.";
}
?>
