<?php 

  require("db.php");
  $cat_name =  $_POST['category_name'];

  $cat_url = strtolower($cat_name);
  $cat_url = str_replace(" ","-",$cat_url);

  $check_table = $db->query("SELECT * FROM category");

  if($check_table)
  {
     $data_store = $db->query("INSERT INTO category(category_name,category_url)VALUES('$cat_name','$cat_url')");

      if($data_store)
      {
        echo "success";
      }
      else
      {
        echo "data store failed";
      }
  }
  else
  {
     $create_table = $db->query("CREATE TABLE category(
          id INT(11) NOT NULL AUTO_INCREMENT,
          category_name VARCHAR(255),
          category_url VARCHAR(255),
          PRIMARY KEY(id)
    )");

     if($check_table)
     {
      $data_store = $db->query("INSERT INTO category(category_name,category_url)VALUES('$cat_name','$cat_url')");

      if($data_store)
      {
        echo "success";
      }
      else
      {
        echo "data store failed";
      }
     }
     else
     {
      echo "table not created";
     }
  }