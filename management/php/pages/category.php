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
			<h1>Add Category</h1>
		<hr>

		<form class="cat_frm">
			<div class="form-group">
				<label for="category_name" class="mb-2">Category Name</label>
				<input type="text" class="form-control mb-3" id="category_name" name="category_name">
			</div>

			<button type="submit" class="btn btn-primary cat_btn">Add Category</button>
		</form>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box p-4">
			<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Category Name</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php 
         $data = $db->query("SELECT * FROM category");
         while($aa = $data->fetch_assoc()){
         	echo "<tr>
                 <td>".$aa['id']."</td>
                 <td>".$aa['category_name'].".</td>
                 <td><i class='fas fa-edit cat_edit_btn' id='".$aa['id']."'></i></td>
                 <td><i class='fas fa-trash text-danger'></i></td>
         	</tr>";
         }
       ?>
  </tbody>
</table>
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
		$(".cat_frm").submit(function(e){
			e.preventDefault();
			$.ajax({
				type:"POST",
				url:"php/add_cat.php",
				data:new FormData(this),
				processData:false,
				contentType:false,
				beforeSend:function(){
                    $(".cat_btn").html("Please Wait...");
                    $(".cat_btn").attr("disabled","disabled");
				},
				success:function(response){
					    $(".cat_btn").html("Add Category");
                        $(".cat_btn").removeAttr("disabled");
                         alert(response);
				}
			})
		})
		$(".cat_edit_btn").each(function(){
			$(this).click(function(){
				var cat_id = $(this).attr("id");
				
				$.ajax({
					type:"POST",
					url:"php/get_cat.php",
					data:{
						cat_id:cat_id
					},
					success:function(response){
						var cat_data = JSON.parse(response);

						$("#edit_cat_name").val(cat_data.category_name);
						$("#edit_cat_id").val(cat_data.id);

						var myModal = new bootstrap.Modal(document.getElementById('cat_edit_modal'));
						myModal.show();
					}
				})
			})
		})

		$(".edit_cat_frm").submit(function(e){
			e.preventDefault();
			$.ajax({
				type:"POST",
				url:"php/edit_cat.php",
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(response){
					if(response.trim() == "success"){
						myModal.hide();

						$('[p_link="category"]').click();
					}
				}
			})
		})
	})
</script>