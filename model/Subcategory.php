<?php

class Subcategory extends Category
{

  public $sup_id;
  
  public static function fetch() {
    global $db;
    $_SESSION['sub_category_array'] = array();
    $sql = 'SELECT * FROM sub_categories';
    foreach ($db->dbconn->query($sql) as $row) {
       
      $category = Subcategory::sub_instantiation($row);
      array_push($_SESSION['sub_category_array'], serialize($category));
      
    }
  }

  public static function find_subs_to_category($id) {
    
    global $db;
    $sub_array = array();
    $sql3 = 'SELECT * FROM sub_categories WHERE sup_category_id = ' . $id;
    foreach ($db->dbconn->query($sql3) as $row3) {
      $category3 = Subcategory::sub_instantiation($row3);
      array_push($sub_array, serialize($category3));
    }
    
    return $sub_array;
  }


  public static function return_title_with_id($category_id) {
    
    foreach ($_SESSION['sub_category_array'] as $value) {
	        $cat = unserialize($value);
		if($cat->id == $category_id) {
		  return $cat->eng_title;
		}
    } 
  }


  public static function get_from_id($id) {
    
    foreach ($_SESSION['sub_category_array'] as $value) {
      $cat = unserialize($value);
      if($cat->id == $id) {
	return $cat;
      } 
    }
  }

  

  public static function get_all() {
     $array = array();
    
    foreach ($_SESSION['sub_category_array'] as $value) {
	        $cat = unserialize($value);
		array_push($array, $cat);
    }

    return $array;
  }

  public static function add() {
    global $db;
    
    try {
      if(isset($_POST['add_sub_category']) && isset($_SESSION['username'])) {

	$eng_title	 	= $_POST['sub_category_eng_title'];
	$swe_title 	= $_POST['sub_category_swe_title'];
	$id 			= $_POST['sup_category_id'];

	if(empty($eng_title) || $eng_title == " " && empty($swe_title) || $swe_title == " " && empty($id) || $id == " ") {
	  echo "<p class='bg-danger'>THIS CANNOT BE EMPTY</p>";
	} else {
	  
	  $sql = "INSERT INTO sub_categories(sub_category_eng_title, sub_category_swe_title, sup_category_id) VALUES('{$eng_title}', '{$swe_title}', '{$id}') ";
	  
	  
	  $db->dbconn->exec($sql);
	  set_message("Sub Category Created");
	  redirect("admin.php?sub_categories");
	  Subcategory::fetch();
	  
	}      
	
      }
    } catch(PDOException $e) {
      echo $e->getMessage();
      set_message($sql . "<br>" . $e->getMessage());
      
    }

  }



  public static function update($cat_id) {

    global $db;

    try {
    
      if(isset($_POST['update']) && isset($_SESSION['username'])) {
	
	$eng_title          	= $_POST['cat_eng_title'];
	$swe_title          	= $_POST['cat_swe_title'];
	$id          		= $_POST['sup_category_id'];
	
	
	$query = "UPDATE sub_categories SET ";
	$query .= "sub_category_eng_title            = '{$eng_title}'        , ";
	$query .= "sub_category_swe_title            = '{$swe_title}'        , ";	
	$query .= "sup_category_id            	= '{$id}'          ";
	$query .= "WHERE sub_category_id=" . $cat_id;
	
	
	$stmt = $db->query($query);
	$stmt->execute();
	
	Subcategory::fetch();

	set_message("Sub Category has been updated");
	redirect("admin.php?sub_categories");
	
	
      }
      
    } catch(PDOException $e)
	{
	  echo $e->getMessage();
	  set_message("<br>" . $e->getMessage());
	}
 
    
  }

  public static function delete($id) {
      global $db;
      try {
	$sql = "DELETE FROM sub_categories WHERE sub_category_id = " . $id;
	$db->dbconn->exec($sql);
	
	set_message("Subcategory Deleted");
	redirect("admin.php?sub_categories");
	
	Subcategory::fetch();
	
      }
      catch(PDOException $e)
	{
	  echo $e->getMessage();
	  set_message($sql . "<br>" . $e->getMessage());
	}
  }

  
  public static function sub_instantiation($found_category) {
    $object = new self;
    
    $object->id = $found_category['sub_category_id'];
    $object->eng_title = $found_category['sub_category_eng_title'];
    $object->swe_title = $found_category['sub_category_swe_title'];
    $object->sup_id = $found_category['sup_category_id'];
    
    return $object;
    
  }
}