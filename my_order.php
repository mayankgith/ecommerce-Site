<?php require("php/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Document</title>
</head>
<body>
		<?php 
   
    require("element/nav.php"); 

   ?>

   <h1 class="mt-5 text-center">My Orders</h1>

   <div class="container">
   	<div class="row">
   		<div class="col-md-3"></div>
   		<div class="col-md-6">

   			<h2 class="mt-3 mb-2">Pending Order</h2>


   			<?php 
   			
   			  $user_email = base64_decode($_COOKIE['_aut_ui_']);
              $get_data = $db->query("SELECT * FROM receive_order WHERE c_email='$user_email' AND order_status='pending'");

              while($data = $get_data->fetch_assoc())
              {
                $date = date_create($data['order_date']);
                $f_date = date_format($date,"d-F-Y");
              	echo "
              	<div class='d-flex align-items-center border mb-3 p-3'>
                      <div>
                       <img src='product_pic/".$data['p_pic']."' width='150'>
                      </div>
                      <div class='ps-4'>
                         <p class='fs-4 p-0 m-0'>".$data['p_name']."</p>
                         <p class='fs-6 p-0 m-0'>".$data['tp_amount']."</p>
                         <p class='fs-6 p-0 m-0'>Quantity : ".$data['p_qty']."</p>
                         <p class='fs-6 p-0 m-0'>Order Date : ".$f_date."</p>
                         <p class='fs-6 p-0 m-0'>Order Id : ".$data['id']."</p>
                      </div>
                </div>
              	";
              }
   			 ?>
   			 <hr>
   			 <h2 class="my-4">Complete Order</h2>


   			<?php 
   			
   			  $user_email = base64_decode($_COOKIE['_aut_ui_']);
              $get_data = $db->query("SELECT * FROM receive_order WHERE c_email='$user_email' AND order_status='complete'");

              while($data = $get_data->fetch_assoc())
              {
                $date = date_create($data['order_date']);
                $f_date = date_format($date,"d-F-Y");
              	echo "
              	<div class='d-flex align-items-center border mb-3 p-4'>
                      <div>
                       <img src='product_pic/".$data['p_pic']."' width='150'>
                      </div>
                      <div class='ps-4'>
                         <p class='fs-4 p-0 m-0'>".$data['p_name']."</p>
                         <p class='fs-6 p-0 m-0'>&#8377; ".$data['tp_amount']."</p>
                         <p class='fs-6 p-0 m-0'>Quantity : ".$data['p_qty']."</p>
                         <p class='fs-6 p-0 m-0'>Order Date : ".$f_date."</p>
                         <p class='fs-6 p-0 m-0'>Order Id : ".$data['id']."</p>
                      </div>
                </div>
              	";
              }
   			 ?>
   		</div>
   		<div class="col-md-3"></div>
   	</div>
   </div>
<?php 
   require("element/footer.php");
 ?>
</body>
</html>