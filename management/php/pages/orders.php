<?php 

  require("../db.php");

 ?>
<style>
  .box{
       box-shadow: 0px 0px 3px #ccc;
       border-radius: 10px;
  }
</style>

<div class="row mb-4">
  <div class="col-md-12">
    <div class="box p-4">
      <form class="d-flex o_data_frm">
         <select name="ods" class="form-control w-25 me-3">
           <option value="pending">Pending</option>
           <option value="complete">Complete</option>
         </select>

         <input type="date" name="o_date" class="form-control w-25 me-3">

         <button type="submit" class="btn btn-primary">Get Data</button>
      </form>
    </div>
  </div>
</div>

<div class="row">
<div class="col-md-12">
    <div class="box p-4">
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Order Id</th>
      <th scope="col">Product Pic</th>
      <th scope="col">Product Name</th>
      <th scope="col">Product quantity</th>
      <th scope="col">Product Amount</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Mobile No.</th>
      <th scope="col">Address</th>
      <th scope="col">Payment Status</th>
      <th scope="col">Order Status</th>
    </tr>
  </thead>
  <tbody>
      
  </tbody>
</table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('.o_data_frm').submit(function(e){
      e.preventDefault();
      $("tbody").html("");
      $.ajax({
        type:"POST",
        url:"php/get_order_data.php",
        data:new FormData(this),
        processData:false,
        contentType:false,
        success:function(response){
          var all_data = JSON.parse(response);
          var ps = "";
          var os = "";

          var i;
          for(i=0;i<all_data.length;i++)
          {

            if(all_data[i].payment_status == "pending")
            {
                ps = "<i class='fa-solid fa-triangle-exclamation text-warning fs-3 mb-2'></i><button class='update btn btn-success btn-sm px-2 py-1' oid='"+all_data[i].id+"' btn_type='payment_status'>Update</button>";
            }
            else
            {
                 ps = "<i class='fa-solid fa-circle-check text-success fs-3'></i>"
            }


            if(all_data[i].order_status == "pending")
            {
                os = "<i class='fa-solid fa-triangle-exclamation text-warning fs-3 mb-2'></i><button class='update btn btn-success btn-sm px-2 py-1' oid='"+all_data[i].id+"' btn_type='order_status'>Update</button>";
            }
            else
            {
                 os = "<i class='fa-solid fa-circle-check text-success fs-3'></i>"
            }


              $("tbody").append("<tr> <td>"+all_data[i].id+"</td> <td><img src='../product_pic/"+all_data[i].p_pic+"' width='100'></td> <td>"+all_data[i].p_name+"</td> <td>"+all_data[i].p_qty+"</td>  <td>"+all_data[i].p_amount+"</td>  <td>"+all_data[i].c_name+"</td>  <td>"+all_data[i].c_mobile+"</td> <td>"+all_data[i].c_address+"</td> <td align='center'>"+ps+"</td>  <td align='center'>"+os+"</td></tr>");
          }


          $(".update").each(function(){
            $(this).click(function(){
              var element = this.parentElement;
              var oid = $(this).attr("oid");
               var btn_type = $(this).attr("btn_type");
               
               $.ajax({
                type:"POST",
                url:"php/update_order.php",
                data:{
                  oid:oid,
                  btn_type:btn_type,
                },
                success:function(response){
                  if(response.trim() == "success")
                  {
                     $(element).html("<i class='fa-solid fa-circle-check text-success fs-3'></i>");
                  }
                }
               })
            })
          })


        }
      })
    })
  })
</script>