<?php



class Product {

  public $id;
  public $sku;
  public $eng_title;
  public $swe_title;
  public $category;
  public $subcategory;
  public $price;
  public $quantity;
  public $eng_description;
  public $swe_description;
  public $size;
  public $color;
  public $image;



  public static function fetch() {
    global $db;
    $_SESSION['product_array'] = array();
    $sql = 'SELECT * FROM products';
    foreach ($db->dbconn->query($sql) as $row) {
       
      $product = Product::instantiation($row);
      array_push($_SESSION['product_array'], serialize($product));
      
    }
  }

  public static function get_for_category($cat_id) {
    $array = array();
    
    foreach ($_SESSION['product_array'] as $value) {
	        $prod = unserialize($value);
		if($prod->category == $cat_id) {
		  array_push($array, $prod);
		}
		
    }

    return $array;
  }



  public static function get_all() {
    $array = array();
    
    foreach ($_SESSION['product_array'] as $value) {
	        $prod = unserialize($value);
		array_push($array, $prod);
    }

    return $array;
  }

  
  public static function get_for_sub_category($sub_cat_id) {
    $array = array();
    
    foreach ($_SESSION['product_array'] as $value) {
	        $prod = unserialize($value);
		if($prod->subcategory == $sub_cat_id) {
		  array_push($array, $prod);
		}
		
    }

    return $array;
  }

  public static function get_with_id($id) {
    
    foreach ($_SESSION['product_array'] as $value) {
	        $prod = unserialize($value);
		if($prod->id == $id) {
		  return $prod;
		}
		
    }

    return false;
  }


  public function get_title() {
  if($_SESSION['current_language'] == "swe") {
	return strtoupper($this->swe_title);
      } else {
	return strtoupper($this->eng_title);
      }  
  }


    public function get_desc() {
      if($_SESSION['current_language'] == "swe") {
	return $this->swe_description;
      } else {
	return $this->eng_description;
      }  
    }


    public static function update($id) {
      
  global $db;

  try {
    if(isset($_POST['update']) && isset($_SESSION['username'])) {
  
      $sku         = $_POST['product_sku'];
      $eng_title          = $_POST['product_eng_title'];
      $swe_title          = $_POST['product_swe_title'];
      $category_id    	= $_POST['product_category_id'];
      $price          	= $_POST['product_price'];
      $eng_description    = $_POST['product_eng_description'];
      $swe_description    = $_POST['product_swe_description'];
      $quantity       	= $_POST['product_quantity'];
      $size 				= $_POST['product_size'];
      $color 				= $_POST['product_color'];
      $sub_cat				= $_POST['product_sub_category_id'];

      $query = "UPDATE products SET ";
      $query .= "sku          	= '{$sku}'        , ";
      $query .= "sub_cat          	= '{$sub_cat}'        , ";
      $query .= "eng_title            = '{$eng_title}'        , ";
      $query .= "swe_title            = '{$swe_title}'        , ";
      $query .= "category_id      	= '{$category_id}'  , ";
      $query .= "price            	= '{$price}'        , ";
      $query .= "eng_description      = '{$eng_description}'  , ";
      $query .= "swe_description      = '{$swe_description}'  , ";
      $query .= "quantity         	= '{$quantity}'     , ";
      $query .= "color	        = '{$color}'     , ";
      $query .= "size	            	= '{$size}'          ";	
      $query .= "WHERE id=" . $id;
      
      $stmt = $db->query($query);
      $stmt->execute();

      set_message("Product has been updated");
      redirect("admin.php?products");
      Product::fetch();

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
	if(isset($_POST['publish']) && isset($_SESSION['username'])) {

	  $sku 		      = $_POST['product_eng_title'];
	  $sub_cat	      = $_POST['product_sub_category_id'];
	  $eng_title          = $_POST['product_eng_title'];
	  $swe_title          = $_POST['product_swe_title'];
	  $category_id        = $_POST['product_category_id'];
	  $price              = $_POST['product_price'];
	  $eng_description    = $_POST['product_eng_description'];
	  $swe_description    = $_POST['product_swe_description'];
	  $quantity           = $_POST['product_quantity'];
	  $color 	      = $_POST['product_color'];
	  $image              = $_FILES['file']['name'];
	  $image_temp_location        = $_FILES['file']['tmp_name'];
	  $size 	      = $_POST['product_size'];

	  move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $image);

	  $sql = "INSERT INTO products(sku, sub_cat, eng_title, swe_title, category_id, price, eng_description, swe_description, quantity, image, color, size) VALUES('{$sku}', '{$sub_cat}', '{$eng_title}', '{$swe_title}', '{$category_id}', '{$price}', '{$eng_description}', '{$swe_description}', '{$quantity}', '{$image}' , '{$color}' , '{$size}')";
	
	  $db->dbconn->exec($sql);
	  set_message("New Product with id {$last_id} was Added");
	  redirect("admin.php?products");
	  
	  Product::fetch();

	}

      } catch(PDOException $e) {
	echo $e->getMessage();
	set_message($sql . "<br>" . $e->getMessage());
	
      }
      
    }

    public static function add_image() {

      global $db;

      try {
    
	if(isset($_POST['update']) && isset($_SESSION['username'])) {
       
	  $new_image          		= $_FILES['file']['name'];
	  $image_temp_location    		= $_FILES['file']['tmp_name'];
	  $product = Product::get_with_id($_POST['product_sku']);
      
	  $query = "UPDATE products SET image = '{$product->image},{$new_image}' WHERE id = {$product->id}";
	
	  $stmt = $db->query($query);
	  $stmt->execute();
	
	  $images  = $product->image;
	  $images_array = explode(",", $images);
	  move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $new_image);
	  set_message("Image uploaded");
	}

      }
      catch(PDOException $e)
	{
	  echo $e->getMessage();
	  set_message("<br>" . $e->getMessage());
	}
    }


    public static function delete($id) {

      global $db;

      try {
	$sql = "DELETE FROM products WHERE id = " . $id;
	$db->dbconn->exec($sql);
	
	set_message("Product Deleted");
	redirect("admin.php?products");
    
	Product::fetch();
    
      }
      catch(PDOException $e)
	{
	  echo $e->getMessage();
	  set_message($sql . "<br>" . $e->getMessage());
	}
      
    }


    
  private static function instantiation($found_product) {
    $object = new self;

    $object->id = $found_product['id'];
    $object->sku = $found_product['sku'];
    $object->eng_title = $found_product['eng_title'];
    $object->swe_title = $found_product['swe_title'];
    $object->image = $found_product['image'];
    $object->category = $found_product['category_id'];
    $object->subcategory = $found_product['sub_cat'];
    $object->price = $found_product['price'];
    $object->quantity = $found_product['quantity'];
    $object->eng_description = $found_product['eng_description'];
    $object->swe_description = $found_product['swe_description'];
    $object->size = $found_product['size'];
    $object->color = $found_product['color'];
    
    return $object;
  }

   
  
}