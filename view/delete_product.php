<?php require_once("../model/new_config.php");

if(isset($_SESSION['username']) && isset($_GET['id'])) {
  Product::delete($_GET['id']);
}



 ?>