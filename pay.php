<?php 

require("php/db.php");

$pro_id = $_GET['p_id'];
$pro_sql = $db->query("SELECT * FROM product WHERE id='$pro_id'");
$aa = $pro_sql->fetch_assoc();


$product_name = $aa['product_name'];
$product_amount = $aa['product_amount'];
$product_qty = $_GET['p_qty2'];

$tp_amount = $product_qty*$product_amount;

$user_email = base64_decode($_COOKIE['_aut_ui_']);
$user_response = $db->query("SELECT * FROM register WHERE email='$user_email'");
$user_aa = $user_response->fetch_assoc();


$c_name = $user_aa['fullname'];
$c_mobile = $user_aa['mobile'];
$c_address = $user_aa['address'];


$p_mode = $_GET['p_mode'];

require('src/Instamojo.php');

$api = new Instamojo\Instamojo('test_b08feca3b77561daf31c5565058', 'test_9492afbe377d7875b3f7bebb188', 'https://test.instamojo.com/api/1.1/');

try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $product_name,
        "amount" =>  $tp_amount,
        "buyer_name" => $c_name,
        "send_email" => true,
        "email" => $user_email,
        "phone" => $c_mobile,
        "redirect_url" => "http://localhost/stpshop/php/recive_order.php?p_id=".$pro_id."&p_qty2=".$product_qty."&p_mode=".$p_mode
        ));
     $main_url = $response['longurl'];
     header('Location:'.$main_url);
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}

 ?>