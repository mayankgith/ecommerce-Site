<?php
require("db.php");

$fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? md5($_POST['password']) : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';

$cd = date('Y-m-d');

// Check if the "register" table exists
$check_table = $db->query("SHOW TABLES LIKE 'register'");

if ($check_table->num_rows > 0) {
    // If the table exists, proceed
    $check_user = $db->query("SELECT * FROM register WHERE email='$email'");
    if ($check_user->num_rows != 0) {
        echo "user already exists";
    } else {
        $store = $db->query("INSERT INTO register(fullname, mobile, email,address,password, date) VALUES ('$fullname', '$mobile', '$email','$address','$password', '$cd')");
        if ($store) {
            echo "success";
        } else {
            echo "failed";
        }
    }
} else {
    // If the table does not exist, create it
    $create_table = $db->query("CREATE TABLE register(
         id INT(11) NOT NULL AUTO_INCREMENT,
         fullname VARCHAR(255),
         mobile VARCHAR(100),
         email VARCHAR(200),
         address MEDIUMTEXT,
         password VARCHAR(255),
         date DATE,
         PRIMARY KEY(id)
     )");
    if ($create_table) {
        $store = $db->query("INSERT INTO register(fullname, mobile, email,address, password, date) VALUES ('$fullname', '$mobile', '$email','$address','$password', '$cd')");
        if ($store) {
            echo "success";
        } else {
            echo "failed";
        }
    } else {
        echo "table not created";
    }
}
?>
