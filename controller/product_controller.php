<?php

function render_product() {

  $product = Product::get_with_id($_GET['id']);
  
  $images  = $product->image;
  $images_array = explode(",", $images);

  $product_image = display_image($images_array[0]);

  $product_title = $product->get_title();
  $product_price = "{$product->price}SEK";
//div of all images
$all_images = "<div id='allImagesContainer'>";
//go through all images
for($x = 0; $x < count($images_array); $x++) {
  $small_image_src = display_image($images_array[$x]);
  $all_images .= "<div class='smallItemImage'><img src='../{$small_image_src}'></div>";
}
	
$all_images .= "</div>";
$product_html = <<<DELIMETER

  <div id="imageContainer">
  <img id='mainImage' src="../{$product_image}" alt="">
  <div id="nonCollapseInfo" class="infoContainer">
  <div class="productItemTitle">{$product_title}</div>
						    <div class="productItemPrice">{$product_price}</div>							
												      <form action="">
												      <div class="buyButton">
												      <a id="cartLink" href="../controller/cart.php?add={$product->id}">BUY NOW</a>
												      </div>
												      </form>
												      {$all_images}

</div>			
    </div>
			
    <div id="collapseInfo">
    <div class="productItemTitle">{$product_title}</div>
						      <div class="productItemPrice">{$product_price}</div>
						
				
													<form action="">
													<div class="buyButton">
													<a href="../controller/cart.php?add={$product->id}">BUY NOW</a>
													</div>
													</form>
													</div>
			
			
			
													</div>
													<div class="descDivTitle">DESCRIPTION</div>
													<div class="descDiv">{$product->get_desc()}</div>
			
																								    <div class="descDivTitle">SIZE</div>
																								    <div class="descDiv">{$product->size}</div>
			
																								    <div class="descDivTitle">STOCK</div>
            <div class="descDiv">{$product->quantity}</div>
			
			<div class="descDivTitle">COLOR</div>
            <div class="descDiv">{$product->color}</div>

DELIMETER;
echo $product_html;
}