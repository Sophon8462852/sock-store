<?php Product::add(); ?>
<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Add Product
</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-eng-title">Product Title (english) </label>
        <input type="text" name="product_eng_title" class="form-control">
    </div>
	
	<div class="form-group">
    <label for="product-swe-title">Product Title (swedish) </label>
        <input type="text" name="product_swe_title" class="form-control">
    </div>


    <div class="form-group">
           <label for="product-eng-desc">Product Description (english)</label>
      <textarea name="product_eng_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>
	
	
    <div class="form-group">
           <label for="product-swe-desc">Product Description (swedish) </label>
      <textarea name="product_swe_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60">
      </div>
    </div>
	
	  <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-color">Product Color</label>
        <input type="text" name="product_color" class="form-control" size="120">
      </div>
    </div>
	
	    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-size">Product Size</label>
        <input type="text" name="product_size" class="form-control" size="120">
      </div>
    </div>
	
	


</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-cat">Product Category</label>

        <select name="product_category_id" id="" class="form-control">
            <option value="">Select Category</option>

            <?php show_categories_as_options("Category"); ?>
           
		</select>
</div>
	
	
	
	    <div class="form-group">
         <label for="product-cat">Product Sub Category</label>

        <select name="product_sub_category_id" id="" class="form-control">
            <option value="">Select Sub Category</option>

            <?php 
	
			 show_sub_categories_as_options(null); 
			
			?>
           
		</select>
</div>





    <!-- Product Brands-->


    <div class="form-group">
      <label for="product-title">Product Quantity</label>
        <input type="number" name="product_quantity" class="form-control">
    </div>
	
	   <div class="form-group">
      <label for="product-sku">Product SKU</label>
        <input type="text" name="product_sku" class="form-control">
    </div>


<!-- Product Tags -->


   <!--  <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div>
 -->
    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>
