<?php 
require("db.php");
$category = $_POST['category'];
$product_name = $_POST['product_name'];
$product_description = $_POST['product_description'];
$product_quantity = $_POST['product_quantity'];
$product_amount = $_POST['product_amount'];
$id = $_POST['id'];
$product_pic = $_FILES['product_pic'];

$old_product_pic =  $_POST['old_pic'];

$pro_pic_name = $product_pic['name']; 
$location = $product_pic['tmp_name'];

if($pro_pic_name === "")
{
	$update_product = $db->query("UPDATE product SET category='$category',product_name='$product_name',product_description='$product_description',product_quantity='$product_quantity',product_amount='$product_amount' WHERE id='$id'");

	 if($update_product)
	 {
	 	echo "success";
	 }
	 else{
	 	echo "failed";
	 }
}

else
{
    $delete = unlink("../../product_pic/".$old_product_pic);

    if($delete)
    {
        $check_file = file_exists("../../product_pic/".$pro_pic_name);
        if($check_file){
        	echo "file already exists";
        }
        else
        {
        	$upload_file = move_uploaded_file($location,"../../product_pic/".$pro_pic_name);
        	if($upload_file)
        	{
               $update_product = $db->query("UPDATE product SET category='$category',product_pic='$pro_pic_name',product_name='$product_name',product_description='$product_description',product_quantity='$product_quantity',product_amount='$product_amount' WHERE id='$id'");

	               if($update_product)
	                {
	 	               echo "success";
	                }
	                    else{
	 	                    echo "failed";
	           }     
        	}
        	else
        	{
        		echo "file not uploaded";
        	}
        }
    }
    else
    {
    	echo "old pic not deleted";
    }
}


?>
