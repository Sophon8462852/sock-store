<?php

function display_all_categories() {
   foreach (Category::get_all() as $category) {
      $cat_image = display_image($category->image);
      $cat_title = $category->get_title();
      
		$cat_css_id = strtolower($category->eng_title);
		
		if(strtolower($category->eng_title) != "help"){
		
$categories_links = <<<DELIMETER
				<a href="category.php?id={$category->id}">
				<div id="{$cat_css_id}Category" class="categoryDisplay">
  <img imageSource="../{$cat_image}" src="" class="categoryImage">
					<div class="categoryTitle">{$cat_title}</div>
				</div>
				</a>			
						
								
DELIMETER;
	

		echo $categories_links;
	
    }
       
  }
 }




function get_categories_for_non_collapse() {  
  $categories = array();

	echo "<ul>";
	
	foreach(Category::get_all() as $category) {
	  $cat_title = $category->get_title();
	  $catTitleLinkString = strtolower($category->eng_title);
			
$categories_links = <<<DELIMETER
								
				<a id="{$catTitleLinkString}Link" href="category.php?id={$category->id}"><li class="link">{$cat_title}</li></a>												
DELIMETER;

array_push($categories, $categories_links);
	}
	
	for ($x = 0; $x <= count($categories); $x++) {
		if ( isset($categories[$x])) {
    echo $categories[$x];
			if($x == 1) {
				echo "</ul><a href='home.php'><div id='brand'><img src='../uploads/brandPic.jpeg' style='width: 25vw; max-width: 100px;'></div></a><ul>";
			}
		}
} 
	echo "</ul>";
}





function get_categories_for_collapse() {
	$categories = array();
	echo "<ul>";
	foreach(Category::get_all() as $category) {
	  $cat_title = $category->get_title();

$categories_links = <<<DELIMETER
								
				<a href="category.php?id={$category->id}"><li class="link">{$cat_title}</li></a><br>				
						
								
DELIMETER;

		$categories[$category->order] = $categories_links;
			
	}
	
		for ($x = 0; $x <= count($categories); $x++) {
		if ( isset($categories[$x])) {
    echo $categories[$x];
		}
} 
	echo "</ul>";
}




function render_sub_categories() {


  echo "<ul>";

  foreach(Category::get_all() as $category) {
    $subContainerTitleLower = strtolower($category->eng_title);
    echo "<div id='{$subContainerTitleLower}Container' class='subContainer'>";
    foreach($category->get_subs() as $sub) {
      $subContainerTitleUpper = strtoupper($sub->eng_title);
			
			echo "<a href='category.php?id=" . $category->id . "&sub=" . $sub->id . "'><div class='subCatgoryLink'>{$subContainerTitleUpper}</div></a><br>";
			
    }
    echo "</div>";
  }
  echo "</ul>";	
}


function get_products_for_category() {


  foreach(Product::get_for_category($_GET['id']) as $product) {
    $images  = $product->image;
    $images_array = explode(",", $images);

    $product_image = display_image($images_array[0]);
    $product_title = $product->get_title();
    
    
$product_html = <<<DELIMETER

            <div class="displayProduct">
			<a href="item.php?id={$product->id}">
						<img src="../{$product_image}" alt="">
			</a>
                    <div class="caption">
					<a href="item.php?id={$product->id}">
                        <div class="productTitle">{$product_title}</div></a>
                  		
                    </div>
            </div>
								      
DELIMETER;

echo $product_html;

  }
	

		
}



function get_products_for_sub_category() {
	

  foreach(Product::get_for_sub_category($_GET['sub']) as $product) {
    $images  = $product->image;
    $images_array = explode(",", $images);

    $product_image = display_image($images_array[0]);
    $product_title = $product->get_title();
    
    
$product_html = <<<DELIMETER

            <div class="displayProduct">
			<a href="item.php?id={$product->id}">
						<img src="../{$product_image}" alt="">
			</a>
                    <div class="caption">
					<a href="item.php?id={$product->id}">
                        <div class="productTitle">{$product_title}</div></a>
                  		
                    </div>
            </div>
								      
DELIMETER;

echo $product_html;

  }
	

}

