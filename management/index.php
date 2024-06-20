<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="../js/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<title>Admin Panel</title>
	<style>
		body{
			margin: 0;
			padding: 0;
		}
		.main_con{
			height: 100vh;
		}
		.left{
			width: 18%;
			height: 100vh;
			background-color: #010c49;
		}
		.right{
			width: 83%;
			height: 100vh;
			overflow-y: auto;
		}
		.left ul{
			padding: 0;
			margin: 0;
			list-style: none;
		}
		.left ul li{
			color: white;
			border-radius: 1px solid white;
		}
		.left ul li:hover{
			background-color: white;
			color: #010c49;
			cursor: pointer;
		}
		.msg{
			width: 100%;
			height: 100vh;
			background-color: rgba(0, 0, 0, 0.7);
			position: fixed;
			top: 0;
			left: 0;
			display: flex;
			justify-content: center;
			align-items: center;
			z-index: 1000000000;
		}

	</style>
</head>
<body>
	<div class="w-100 d-flex">
		<div class="left">
			<ul>
				<li class="px-4 py-3 menu" p_link="category">Category</li>
				<li class="px-4 py-3 menu" p_link="add_products">Add Product</li>
				<li class="px-4 py-3 menu" p_link="all_products">All Product</li>
				<li class="px-4 py-3 menu" p_link="orders">Orders</li>
			</ul>
		</div>
		<div class="right p-3">
			
		</div>
	</div>

	<div class="msg d-none">
		
	</div>

	<script>
		$(document).ready(function(){
			$(".menu").each(function(){
				$(this).click(function(){
					var page_link = $(this).attr("p_link");

					$.ajax({
						type:"POST",
						url:"php/pages/"+page_link+".php",
						beforeSend : function(){
							var div = document.createElement("DIV");
							$(div).addClass("alert alert-primary fs-1 text-center p-5");
							$(div).html("<i class='fas fa-spinner fa-spin display-1'></i><br>Loading...");
							$(".msg").html(div);
							$(".msg").removeClass("d-none");
						},
					success:function(response){
						$(".msg").addClass("d-none");
						$(".right").html(response);
					}
					})
				})
			})
		})
	</script>
</body>
</html>