<nav class="navbar navbar-expand-lg navbar-light bg-light shadow sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand ms-3" href="#">
      <img src="http://localhost/stpshop/images/logo.png" height="50px" width="50px" alt="stp_shop">

      <?php 
         require("php/db.php");
         
         if(!empty($_COOKIE['_aut_ui_']))
         {
               $user_email = base64_decode($_COOKIE['_aut_ui_']);
               $get_data = $db->query("SELECT fullname FROM register WHERE email='$user_email'");
               $aa = $get_data->fetch_assoc();
               echo "| ".$aa['fullname'];
         }
       ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-4">
          <a class="nav-link active" aria-current="page" href="http://localhost/stpshop/">Home</a>
        </li>

        <?php 

           $cat_data_sql = $db->query("SELECT * FROM category");
           while($cat_data = $cat_data_sql->fetch_assoc())
           {
           	  echo '
                <li class="nav-item me-4">
                <a class="nav-link" href="http://localhost/stpshop/category/'.$cat_data['category_url'].'">'.$cat_data['category_name'].'</a>
                </li> 
           	  ';
           }

         ?>

          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

            <?php 
               if(empty($_COOKIE['_aut_ui_']))
               {
                 echo '
                  <li><a class="dropdown-item" href="login.php">Login</a></li>
                  <li><a class="dropdown-item" href="register.php">Register</a></li>   
                  ';
               }
               else
               {
                  echo '
                  <li><a class="dropdown-item" href="my_order.php">My Orders</a></li>
                  <li><a class="dropdown-item" href="signout.php">Sign Out</a></li>   
                  ';
               }
           ?>
            


          </ul>
        </li>

        <li class="nav-item me-4">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item me-4">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
      <form class="d-flex search_frm">
        <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<script>
    var s_frm = document.getElementsByClassName("search_frm")[0];
    s_frm.onsubmit = function(e){
      e.preventDefault();
      var s_query = document.getElementsByClassName("search")[0].value;
      location.href = "http://localhost/stpshop/search/"+s_query;
    }
</script>
