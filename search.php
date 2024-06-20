<?php require("php/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Document</title>
</head>
<body>
		<?php 
   
    require("element/nav.php"); 

   ?>

   <div class="container">

   <?php 
     $query = $_GET['search'];

     $product_sql = $db->query("SELECT * FROM product WHERE product_name LIKE '%$query%' ORDER BY id DESC");
        echo '<div class="row">
             <h1 class="my-5 text-center">Search Result</h1>
        ';
           	  while($pro_data = $product_sql->fetch_assoc())
           	  {
           	  	 // echo $pro_data['product_name'].'<br>';

           	  	echo '
                   <div class="col-md-3">
                   <a href="http://localhost/stpshop/product-details/'.$pro_data['id'].'">
                       <div class="card rounded-0">
                       <img src="http://localhost/stpshop/product_pic/'.$pro_data['product_pic'].'" class="w-100">  
                            <div class="card-body rounded-0" mb-4 style="background-color:#e5e5e5;">
                            
                 <label class="fs-6 text-dark">'.$pro_data['product_name'].'</label><br>
                 
                 
                 <label class="fs-5 text-dark">&#8377; '.$pro_data['product_amount'].'</label> 

                                          
                            </div>
                       </div>
                       </a>
                   </div>
           	  	';
           	  }
           	  echo '</div>';
           
    ?>
    </div>

    <?php 
   require("element/footer.php");
 ?>
 
</body>
</html>