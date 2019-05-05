
<?php 

if(isset($_GET['id'])) {
  $cat = Subcategory::get_from_id($_GET['id']);
  Subcategory::update($cat->id);
}

 ?>




<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Edit Category
</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">

  
<div class="col-md-8">

<div class="form-group">
    <label for="cat-eng-title">Category Title (english)</label>
        <input type="text" name="cat_eng_title" class="form-control" value="<?php echo $cat->eng_title; ?>">
       
    </div>
	
	<div class="form-group">
    <label for="cat-swe-title">Category Title (swedish)</label>
        <input type="text" name="cat_swe_title" class="form-control" value="<?php echo $cat->swe_title; ?>">
       
    </div>
	
	<div class="form-group">
         <label for="product-cat">Category</label>

        <select name="sup_category_id" id="" class="form-control">
  <option value="<?php echo $cat->sup_id; ?>"><?php echo strtoupper(Category::return_title_with_id($cat->sup_id)); ?></option>

  <?php show_categories_as_options($cat->sup_id); ?> 
           
		</select>
</div>
	

</div>
<aside id="admin_sidebar" class="col-md-4">
     
     <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>


</aside><!--SIDEBAR-->
    
</form>
