<?php Product::add_image() ?>

<h1 class="page-header">
  Add Picture To Product

</h1>


<div class="col-md-4">

    <h3 class="bg-success"><?php display_message(); ?></h3>
    
    <form action="" method="post" enctype="multipart/form-data">
    
        <div class="form-group">
            <label for="product-sku">Product ID</label>
            <input name="product_sku" type="text" class="form-control">
        </div>
        
     <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">
      
    </div>

        <div class="form-group">
            <input name="update" type="submit" class="btn btn-primary" value="Add Picture">
        </div>      


    </form>
</div>