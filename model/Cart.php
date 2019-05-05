<?php
class Cart {
  public static function add($product_id) {

    $product = Product::get_with_id($product_id);
    $found_product = false;

    foreach ($_SESSION['products_in_cart'] as $serialised_product => $number_in_cart) {
      
      $product_in_cart = unserialize($serialised_product);

      if($product_in_cart->id == $product->id && $number_in_cart < $product->quantity) {
	$_SESSION['products_in_cart'][$serialised_product] += 1;
      } else {
	set_message("We only have " . $product->quantity . " " . $product->eng_title . " available");
      }
      
      redirect("../view/checkout.php");
      $found_product = true;
    }

    if($found_product == false) {
      $_SESSION['products_in_cart'][serialize($product)] = 1;
    }
	  
    $_SESSION['should_update'] = true;
  }

  public static function dump_cart() {
    var_dump($_SESSION['products_in_cart']);
  }

  public static function get_cart() {
    $array = array();
    foreach ($_SESSION['products_in_cart'] as $serialised_product => $quantity) {
      $product = unserialize($serialised_product);
      $array[$product] = $quantity;
    }
    return $array;
  }

  public static function remove($product_id) {

    $product = Product::get_with_id($product_id);

    foreach ($_SESSION['products_in_cart'] as $serialised_product => $number_in_cart) {
      
      $product_in_cart = unserialize($serialised_product);

      if($product_in_cart->id == $product->id && $number_in_cart >= 1) {
	$_SESSION['products_in_cart'][$serialised_product] -= 1;
      } 
      
       redirect("../view/checkout.php");
    }
	  
    $_SESSION['should_update'] = true;
    
  }

  public static function delete($product_id) {
    
    $product = Product::get_with_id($product_id);

    foreach ($_SESSION['products_in_cart'] as $serialised_product => $number_in_cart) {
      
      $product_in_cart = unserialize($serialised_product);

      if($product_in_cart->id == $product->id) {
	$_SESSION['products_in_cart'][$serialised_product] = 0;
      }
      	redirect("../view/checkout.php");
    }
	  
    $_SESSION['should_update'] = true;

  }
}

?>