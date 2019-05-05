<?php

function display_products_in_admin(){

  foreach(Product::get_all() as $product) {
  
    $category = Category::return_title_with_id($product->category);
$images  = $product->image;
$images_array = explode(",", $images);
$product_image = display_image($images_array[0]);

$product_html = <<<DELIMETER

        <tr>
            <td>{$product->id}</td>
            <td>
             <a href="admin.php?edit_product&id={$product->id}"><p>{$product->eng_title}</p></a>
            <div>
            <img width='100' src="../{$product_image}" alt="">
            </div>
            </td>
            <td>{$category}</td>
            <td>{$product->price}</td>
            <td>{$product->quantity}</td>
             <td><a class="btn btn-danger" href="delete_product.php?id={$product->id}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>

DELIMETER;

echo $product_html;
        }
}



function display_orders() {

  global $db;
  
  $sql = 'SELECT * FROM orders';
  foreach ($db->dbconn->query($sql) as $row) {

$orders = <<<DELIMETER

<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_amount']}</td>
    <td>{$row['order_products']}</td>
    <td>{$row['order_zip_code']}</td>
	<td>{$row['order_adress']}</td>
	<td>{$row['order_country']}</td>
    <td>{$row['order_city']}</td>
	<td>{$row['order_first_name']}</td>
	<td>{$row['order_last_name']}</td>
	<td>{$row['order_phone_number']}</td>
	<td>{$row['order_email']}</td>
	<td>{$row['order_klarna_id']}</td>
    <td><a class="btn btn-danger" href="delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>

DELIMETER;

echo $orders;
  }
}





function show_categories_in_admin() {
  
foreach (Category::get_all() as $category) {

  $category = <<<DELIMETER
    <tr>
    <td>{$category->id}</td>
			   <td><a href="admin.php?edit_category&id={$category->id}"><p>{$category->eng_title}</p></a></td>
    <td>{$category->order}</td>
    <td><a class="btn btn-danger" href="delete_category.php?id={$category->id}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>

DELIMETER;

echo $category;

    }
}






function show_sub_categories_in_admin() {
  foreach(Subcategory::get_all() as $sub) {
    $category = <<<DELIMETER
<tr>
    <td>{$sub->id}</td>
    <td><a href="admin.php?edit_sub_category&id={$sub->id}"><p>{$sub->eng_title}</p></a></td>
	
    <td><a class="btn btn-danger" href="delete_sub_category.php?id={$sub->id}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>

DELIMETER;
echo $category;
    }
}




function show_categories_as_options($cat_id) {
  foreach (Category::get_all() as $category) {
    $cat_title = strtoupper($category->eng_title);
    $categories_options = "<option value=" . $category->id . ">". $cat_title ."</option>";
    if(isset($cat_id)) {
      if($cat_id != $category->id) {
	echo $categories_options;
      }
    } else {
      echo $categories_options;
    }
  }
}


function show_sub_categories_as_options($cat_id) {
      
    foreach (Subcategory::get_all() as $sub) {
      $cat_title = strtoupper($sub->eng_title);
      $sup_title = Category::return_title_with_id($sub->sup_id);
      $categories_options = '<option value="' . $sub->id . '">' . $cat_title . ' ( ' . $sup_title . ')' .  '</option>';
      
      if(isset($cat_id)) {
	if($cat_id != $sub->id) {
	  echo $categories_options;
	}
      } else {
	echo $categories_options;
      }
    }
}


function display_users() {

  foreach (User::get_all() as $user) {
  
$user_html = <<<DELIMETER
<tr>
    <td>{$user->id}</td>
    <td>{$user->username}</td>
     <td>{$user->email}</td>
    <td><a class="btn btn-danger" href="delete_user.php?id={$user->id}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>

DELIMETER;

echo $user_html;

    }
}


?>