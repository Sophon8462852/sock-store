<?php
require_once("../model/new_config.php");
?>


<?php 

  if(isset($_GET['add'])) {
    Cart::add($_GET['add']);
  }


  if(isset($_GET['remove'])) {
    Cart::remove($_GET['remove']);
  }


 if(isset($_GET['delete'])) { 
   Cart::delete($_GET['delete']);
 }


function cart() {
  global $db;
  global $klarna;

  $klarna->order_json = " ";
  $klarna->html_snippet = " ";
  
  $_SESSION['order_products'] = "";

  $total = 0;
  $item_quantity = 0;
  $item_name = 1;
  $item_number = 1;
  $amount = 1;
  $quantity = 1;

  //  foreach ($_SESSION as $name => $value) {
  foreach($_SESSION['products_in_cart'] as $serialised_product => $product_quantity) {
    $product = unserialize($serialised_product);
    $product_price = $product->price;
    if($product_quantity > 0 ) {
      
	  $sub = $product->price * $product_quantity;
	  $item_quantity += $product_quantity;
	  $product_image = display_image($product->image);
	  $product_title = $product->get_title();
	  
$product = <<<DELIMETER

<tr>
  <td>{$product_title}<br>
  <img width='100' src='../$product_image'>
  </td>
  <td>SEK{$product->price}</td>
  <td>{$product_quantity}</td>
  <td>&#36;{$sub}</td>
  <td><a class='btn btn-warning' href="../controller/cart.php?remove={$product->id}"><span class='glyphicon glyphicon-minus'></span></a>   <a class='btn btn-success' href="../controller/cart.php?add={$product->id}"><span class='glyphicon glyphicon-plus'></span></a>
<a class='btn btn-danger' href="../controller/cart.php?delete={$product->id}"><span class='glyphicon glyphicon-remove'></span></a></td>
  </tr>
<input type="hidden" name="product_title[]" value="{$product_title}">
<input type="hidden" name="product_id[]" value="{$product->id}">
<input type="hidden" name="product_price[]" value="{$product->price}">
<input type="hidden" name="product_quantity[]" value="$product_quantity">

DELIMETER;

echo $product;

$item_name++;
$item_number++;
$amount++;
$quantity++;

//    $_SESSION['item_total'] = $total += $sub;
$klarna->total_cost = $total += $sub;
$_SESSION['item_quantity'] = $item_quantity;	
$_SESSION['order_products'] .= $product_title . "(". $product_quantity .")";
	
//$_SESSION['klarnaOrderArray']	
$klarna->order_json .= '{
     "type": "physical",
     "reference": "19-402-SWE",
     "name": "'. $product_title.'",
     "quantity": '. $product_quantity .',
     "quantity_unit": "pcs",
     "unit_price": '. ($product_price * 100).',
     "tax_rate": 0,
     "total_amount": '. ($sub * 100) .',
     "total_discount_amount": 0,
     "total_tax_amount": 0,
     "image_url": "http://merchant.com/logo.png"
   },';
    
      }
    }
	$klarna->order_json = rtrim($klarna->order_json, ",");
	
	if(isset($_SESSION['should_update']) && isset($klarna->id)) {
		
	  $klarna->update_json();
	  unset($_SESSION['should_update']);
	} else {	
	  $klarna->session_start(); 
	}
}

function process_transaction() {

    if(isset($_GET['tx'])) {

        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];
        $total = 0;
        $item_quantity = 0;

        foreach ($_SESSION as $name => $value) {

            if($value > 0 ) {

                if(substr($name, 0, 8 ) == "product_") {

                    $length = strlen($name - 8);
                    $id = substr($name, 8 , $length);


                    $send_order = query("INSERT INTO orders (order_amount, order_transaction, order_currency, order_status ) VALUES('{$amount}', '{$transaction}','{$currency}','{$status}')");
                    $last_id =last_id();
                    confirm($send_order);



                    $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
                    confirm($query);

                    while($row = fetch_array($query)) {
                        $product_price = $row['product_price'];
                        $product_title = $row['product_title'];
                        $sub = $row['product_price']*$value;
                        $item_quantity +=$value;


                        $insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
                        confirm($insert_report);
                    }
                    $total += $sub;
                    echo $item_quantity;
                }

            }

        }

        session_destroy();
    } else {


        redirect("index.php");

    }

}
 ?>