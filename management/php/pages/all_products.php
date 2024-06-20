<?php 

  require("../db.php");

 ?>
<style>
  .box{
       box-shadow: 0px 0px 3px #ccc;
       border-radius: 10px;
  }
</style>
<div class="col-md-12">
    <div class="box p-4">
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Product Pic</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product quantity</th>
      <th scope="col">Product Amount</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php 
         $data = $db->query("SELECT * FROM product");
         while($aa = $data->fetch_assoc()){
          echo "<tr>
                 <td>".$aa['id']."</td>
                 <td><img src='../product_pic/".$aa['product_pic']."' width='100'></td>
                 <td>".$aa['product_name']."</td>
                 <td>".$aa['product_quantity']."</td>
                 <td>".$aa['product_amount']."</td>
                 <td><i class='fas fa-edit pro_edit_btn' id='".$aa['id']."'></i></td>
                 <td><i class='fas fa-trash text-danger'></i></td>
          </tr>";
         }
       ?>
  </tbody>
</table>
    </div>
  </div>
     <div class="modal fade" tabindex="-1" id="pro_edit_modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
              
              <form class="edit_product_frm">
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
           <input type="text" class="form-control mb-3" name="product_name" id="product_name">

           <label class="mb-2">Product Description</label>
           <textarea name="product_description" cols="30" rows="10" class="form-control mb-3" id="product_description"></textarea>
     
           <label  class="mb-2">Product Quantity</label>
           <input type="number" class="form-control mb-3" name="product_quantity" id="product_quantity">

           <label class="mb-3">Product Amount</label>
           <input type="number" class="form-control mb-3" name="product_amount" id="product_amount">

           <input type="hidden" name="id" id="pro_id">

           <input type="hidden" name="old_pic" id="old_pic">

           <button type="submit" class="btn btn-primary pro_add_btn">Update Product</button>
       </form>
      </div>

    </div>
  </div>
</div>
  <script>
      $(document).ready(function(){
        var myModal = new bootstrap.Modal(document.getElementById('pro_edit_modal'));

        $(".pro_edit_btn").each(function(){
          $(this).click(function(){
            var id = $(this).attr("id");
            $.ajax({
              type:"POST",
              url:"php/product_data.php",
              data : {
                id:id
              },
              success:function(response){
                var pro_data = JSON.parse(response);
                $("#category").val(pro_data.category);
                $("#product_name").val(pro_data.product_name);
                $("#product_description").val(pro_data.product_description);
                $("#product_quantity").val(pro_data.product_quantity);
                $("#product_amount").val(pro_data.product_amount);
                $("#pro_id").val(pro_data.id);
                $("#old_pic").val(pro_data.product_pic);



                myModal.show();
              }
            })
          })
        })

        $(".edit_product_frm").submit(function(e){
          e.preventDefault();
          $.ajax({
            type:"POST",
            url:"php/edit_product.php",
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(response){
              if(response.trim() === "success")
                  {

                      myModal.hide();
                        var div = document.createElement("DIV");
                        $(div).addClass("alert alert-primary fs-1 text-center p-5");
                        $(div).html("<i class='fa-solid fa-circle-check display-1'></i><br>Product Update Successfull...");
                        $(".msg").html(div);
                        $(".msg").removeClass("d-none");

                        setTimeout(function(){
                          $(".msg").addClass("d-none");
                          $('[p_link="all_products"]').click();
                        },2500);
                  }
            }
          })
        })
      })
  </script>