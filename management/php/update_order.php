<?php 

require("db.php");

$oid = $_POST['oid'];
$btn_type = $_POST['btn_type'];

$update = $db->query("UPDATE receive_order SET $btn_type='complete' WHERE id='$oid'");

if($update)
{
	echo "success";
}
else
{
	echo "failed";
}

 ?>