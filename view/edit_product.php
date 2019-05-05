<?php 


if(isset($_GET['id'])) {
  $product = Product::get_with_id($_GET['id']);
  Product::update($product->id);
}

 ?>




<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Edit Product
</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-eng-title">Product Title (english)</label>
        <input type="text" name="product_eng_title" class="form-control" value="<?php echo $product->eng_title; ?>">
       
    </div>
	
	<div class="form-group">
    <label for="product-swe-title">Product Title (swedish)</label>
        <input type="text" name="product_swe_title" class="form-control" value="<?php echo $product->swe_title; ?>">
       
    </div>


    <div class="form-group">
           <label for="product-eng-title">Product Description (english)</label>
      <textarea name="product_eng_description" id="" cols="30" rows="10" class="form-control"><?php echo $product->eng_description; ?></textarea>
    </div>
	
	
    <div class="form-group">
           <label for="product-swe-title">Product Description (swedish)</label>
      <textarea name="product_swe_description" id="" cols="30" rows="10" class="form-control"><?php echo $product->swe_description; ?></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product->price; ?>">
      </div>
    </div>
	
	
		  <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-color">Product Color</label>
        <input type="text" name="product_color" class="form-control" size="60" value="<?php echo $product->color; ?>">
      </div>
    </div>
	
	    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-size">Product Size</label>
        <input name="product_size" class="form-control" size="60" value="<?php echo $product->size; ?>">
      </div>
    </div>

</div>

<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>

    <div class="form-group">
         <label for="product-title">Product Category</label>

        <select name="product_category_id" id="" class="form-control">
              

  <option value="<?php echo $product->category; ?>"><?php echo Category::return_title_with_id($product->category); ?></option>

<?php show_categories_as_options($product->category); ?>
           
        </select>


</div>



   <div class="form-group">
         <label for="product-title">Product Sub Category</label>

        <select name="product_sub_category_id" id="" class="form-control">
              

  <option value="<?php echo $product->subcategory; ?>"><?php echo Subcategory::return_title_with_id($product->subcategory); ?></option>

<?php show_sub_categories_as_options($product->sub_category); ?>
           
        </select>


</div>


  

    <div class="form-group">
      <label for="product-title">Product Quantity</label>
        <input type="number" name="product_quantity" class="form-control" value="<?php echo $product->quantity; ?>">
    </div>
    
    <div class="form-group">
      <label for="product-sku">Product SKU</label>
        <input name="product_sku" class="form-control" value="<?php echo $product->sku; ?>">
    </div>



</aside>


    
</form>
