<?php

class Category
{
  public $id;
  public $eng_title;
  public $swe_title;
  public $image;
  public $order;
  public $sub_categories = array();

  public static function fetch() {
    global $db;
    $_SESSION['category_array'] = array();
    $sql = 'SELECT * FROM categories';
    foreach ($db->dbconn->query($sql) as $row) {
       
      $category = Category::instantiation($row);
      array_push($_SESSION['category_array'], serialize($category));
      
    }
  }

  public static function get_all() {
    $array = array();
    
    foreach ($_SESSION['category_array'] as $value) {
	        $cat = unserialize($value);
		array_push($array, $cat);
    }

    return $array;
  }

  public function get_subs(){
    $us_sub_array = array();

    foreach ($this->sub_categories as $s_sub) {
      array_push($us_sub_array, unserialize($s_sub));
    }

    return $us_sub_array;
  }


  public function get_title() {
  if($_SESSION['current_language'] == "swe") {
	return strtoupper($this->swe_title);
      } else {
	return strtoupper($this->eng_title);
      }  
  }


  public static function return_title_with_id($category_id) {
    
    foreach ($_SESSION['category_array'] as $value) {
	        $cat = unserialize($value);
		if($cat->id == $category_id) {
		  return $cat->eng_title;
		}
    }  
  }

  public static function get_from_id($id) {
    
    foreach ($_SESSION['category_array'] as $value) {
      $cat = unserialize($value);
      if($cat->id == $id) {
	return $cat;
      } 
    }
  }

  public static function update($id) {

    global $db;
  
    try {

      if(isset($_POST['update']) && isset($_SESSION['username'])) {

	$eng_title          	= $_POST['cat_eng_title'];
	$swe_title          	= $_POST['cat_swe_title'];
	$order 			= $_POST['cat_order'];

	$query = "UPDATE categories SET ";
	$query .= "eng_title            = '{$eng_title}'        , ";
	$query .= "swe_title            = '{$swe_title}'        , ";	
	$query .= "display_order            	= '{$order}'          ";
	$query .= "WHERE id=" . $id;

	$stmt = $db->query($query);
	$stmt->execute();

	set_message("Category has been updated");
	redirect("admin.php?categories");
	Category::fetch();

      }
  
    }
    catch(PDOException $e)
      {
	echo $e->getMessage();
	set_message("<br>" . $e->getMessage());
      }
 
  }





  

  public static function add() {
    
    global $db;
    
    try {
  
      if(isset($_POST['add_category']) && isset($_SESSION['username'])) {

	$cat_eng_title = $_POST['cat_eng_title'];
	$cat_swe_title = $_POST['cat_swe_title'];
	$cat_order = $_POST['cat_order'];

	if(empty($cat_eng_title) || $cat_eng_title == " " && $cat_swe_title || $cat_swe_title == " " && $cat_color) {

	  set_message("THIS CANNOT BE EMPTY");
	  display_message();
      

	} else {
      
	  $sql = "INSERT INTO categories(eng_title, swe_title, display_order) VALUES('{$cat_eng_title}', '{$cat_swe_title}', '{$cat_order}') ";

	  $db->dbconn->exec($sql);
      
	  Category::fetch();
	  redirect("admin.php?categories");
	  set_message("Category Created");
	}
      }

  
    } catch(PDOException $e) {
      echo $e->getMessage();
      set_message($sql . "<br>" . $e->getMessage());
  
    }

  }
  



  public static function delete($id) {
    global $db;
    try {
      $sql = "DELETE FROM categories WHERE id = " . $id;
      $db->dbconn->exec($sql);
      
      set_message("Category Deleted");
      redirect("admin.php?categories");
      
      Category::fetch();
      
    }
    catch(PDOException $e)
      {
	echo $e->getMessage();
	set_message($sql . "<br>" . $e->getMessage());
      } 
  }


  
  public static function find_query($sql) {

    global $db;
    $result_set = $db->dbconn->query($sql);
    $object_array = array();

    foreach ($result_set as $row) {
      $object_array[] = self::instantiation($row);
    }

    return $object_array;

  }


  private static function instantiation($found_category) {
    $object = new self;

    $object->id = $found_category['id'];
    $object->eng_title = $found_category['eng_title'];
    $object->swe_title = $found_category['swe_title'];
    $object->image = $found_category['image'];
    $object->order = $found_category['display_order'];
    $object->sub_categories = Subcategory::find_subs_to_category($found_category['id']);
    
    return $object;
  }
  
}




?>