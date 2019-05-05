<?php
require_once("../model/new_config.php");
if(isset($_GET['id']) && ($_GET['username']) {
    global $db;
    try {
      $sql = "DELETE FROM orders WHERE order_id = " . $_GET['id'];
      $db->dbconn->exec($sql);
  
      set_message("Order Deleted");
      redirect("admin.php?orders");
      
    }
    catch(PDOException $e)
      {
	echo $e->getMessage();
	set_message($sql . "<br>" . $e->getMessage());
      }
  }
 ?>