<?php 

  require("../db.php");

 ?>
<style>
	.box{
       box-shadow: 0px 0px 3px #ccc;
       border-radius: 10px;
	}
</style>


<div class="row">
	<div class="col-md-6">
		<div class="box p-4">
			<h1>Add Product</h1>
		<hr>
       <form class="add_product_frm">
       	<label class="mb-2">Select Category</label>
       	<select name="category" id="category" class="form-control mb-3">
       		<option value="none">Select Category</option>
       		<?php 
         $data = $db->query("SELECT * FROM category");
         while($aa = $data->fetch_assoc()){
         	echo "<option value='".$aa['category_url']."'>".$aa['category_name']."</option>";
         }
       ?>
       	</select>

           <label  class="mb-2">Upload Product Pic</label>
           <input type="file" class="form-control mb-3" name="product_pic" accept="image/*">

           <label  class="mb-2">Product Name</label>
           <input type="text" class="form-control mb-3" name="product_name">

           <label class="mb-2">Product Description</label>
           <textarea name="product_description" cols="30" rows="10" class="form-control mb-3"></textarea>
     
           <label  class="mb-2">Product Quantity</label>
           <input type="number" class="form-control mb-3" name="product_quantity">

           <label class="mb-3">Product Amount</label>
           <input type="number" class="form-control mb-3" name="product_amount">

           <button type="submit" class="btn btn-primary pro_add_btn">Add Product</button>
       </form>
		</div>
	</div>
	
</div>

<div class="modal fade" tabindex="-1" id="cat_edit_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
              <form class="edit_cat_frm">
			<div class="form-group">
				<label for="category_name" class="mb-2">Category Name</label>
				<input type="text" class="form-control mb-3" id="edit_cat_name" name="edit_cat_name">
			</div>

			<input type="hidden" id="edit_cat_id" name="edit_cat_id">

			<button type="submit" class="btn btn-primary update_cat_btn">Update Category</button>
		</form>
      </div>

    </div>
  </div>
</div>

<script>
	  $(document).ready(function(){
	  	$(".add_product_frm").submit(function(e){
           e.preventDefault();

           $.ajax({
           	type:"POST",
           	url:"php/add_product.php",
           	data: new FormData(this),
           	contentType:false,
           	processData:false,
           	beforeSend:function(){
                  $(".pro_add_btn").html("Please Wait...");
                  $(".pro_add_btn").attr("disabled","disabled");
           	},
           	success:function(response){
           		    $(".pro_add_btn").html("Add Product");
                  $(".pro_add_btn").remove("disabled");
           		    if(response.trim() === "success")
           		    {
                        var div = document.createElement("DIV");
							          $(div).addClass("alert alert-primary fs-1 text-center p-5");
							          $(div).html("<i class='fa-solid fa-circle-check display-1'></i><br>Product Add Successfull...");
							          $(".msg").html(div);
							          $(".msg").removeClass("d-none");

							          setTimeout(function(){
							          	$(".msg").addClass("d-none");
							          	$(".add_product_frm").trigger('reset');
							          },2500);
           		    }
           		    else
           		    {

           		    }
           	}
           })
	  	});
	  })
</script>