<?php
require_once("../model/new_config.php");
if(isset($_GET['id'] && isset($_SESSION['username']))) {
  Subcategory::delete($_GET['id']);
}
 ?>