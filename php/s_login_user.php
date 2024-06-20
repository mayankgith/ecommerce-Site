<?php 

require("db.php");

$email = $_POST['email'];
$password = md5($_POST['password']);

$check_email = $db->query("SELECT email FROM register WHERE email='$email'");

if($check_email->num_rows != 0)
{
      $check = $db->query("SELECT email,password FROM register WHERE email='$email' AND password='$password'");

      if($check->num_rows != 0)
      {
      	   $c_email = base64_encode($email);
      	   $c_time = time()+(60*60*24*365);
      	   setcookie("_aut_ui_",$c_email,$c_time,'/');
           echo "success";
      }
      else
      {
      	echo "wrong password";
      }
}
else
{
   echo "you are not a registered user";
}

 ?>