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

   <?php 
     $pro_id = $_GET['p_id'];
     $pro_sql = $db->query("SELECT * FROM product WHERE id='$pro_id'");
     $aa = $pro_sql->fetch_assoc();
     $user_email = base64_decode($_COOKIE['_aut_ui_']);
     $user_response = $db->query("SELECT * FROM register WHERE email='$user_email'");
     $user_aa = $user_response->fetch_assoc();
     
    ?>
    <h1 class="mt-5 text-center">Order Details</h1>
    <div class="container">
    	<div class="row">
    		   <div class="col-md-3"></div>
           <div class="col-md-6 border p-3 mt-3">
                <div class="d-flex">
                  <div>
                    <img src="http://localhost/stpshop/product_pic/<?php echo $aa['product_pic']?>" width="150">
                  </div>
                  <div class="d-flex flex-column justify-content-center ps-4">
                     <h4><?php echo $aa['product_name']?></h4>
                     <h5>&#8377; <?php echo $aa['product_amount']?></h5>
                  </div>
                </div>
                <hr>
                <h4>Customer Details</h4>
                <table class="table table-bordered">
                  <tr>
                    <th>Name</th>
                    <td><?php echo $user_aa['fullname'] ?></td>
                  </tr>

                  <tr>
                    <th>Phone No.</th>
                    <td><?php echo $user_aa['mobile'] ?></td>
                  </tr>

                  <tr>
                    <th>Email Id</th>
                    <td><?php echo $user_email; ?></td>
                  </tr>

                  <tr>
                    <th>Address</th>
                    <td><?php echo $user_aa['address'] ?></td>
                  </tr>
                </table>

                <form class="order_frm">
                  <label class="mb-2">Product Quantity</label>
                  <input type="number" class="form-control product_qty mb-3" value="1">
                  
                  <label class="mb-2">Payment Mode</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_mode" id="flexRadioDefault1" value="online">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Online
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_mode" id="flexRadioDefault2" value="cod">
                    <label class="form-check-label" for="flexRadioDefault2">
                      Cash On Delivery
                    </label>
                  </div>
                  <hr>

                  <button type="submit" class="btn btn-primary">Place Order</button>
                </form>
           </div>
           <div class="col-md-3"></div>
    	</div>
    </div>

    <script>
      $(document).ready(function(){
          $(".order_frm").submit(function(e){
               e.preventDefault();
               var payment_mode = $("[name='payment_mode']:checked").val();
                   if(payment_mode)
                   {
                           if(payment_mode == "online")
                           {
                               window.location.href = "http://localhost/stpshop/pay.php?p_id=<?php echo $pro_id;?>&p_qty2=" + $(".product_qty").val() + "&p_mode=" + payment_mode;
                           }
                           else if(payment_mode == "cod")
                           {
                            window.location.href = "http://localhost/stpshop/php/recive_order.php?p_id=<?php echo $pro_id;?>&p_qty2=" + $(".product_qty").val() + "&p_mode=" + payment_mode;
                           }
                   }
                   else
                   {
                         alert("please select payment mode");
                   }
          })
      })
    </script>

    <?php 
   require("element/footer.php");
 ?>
 
</body>
</html>