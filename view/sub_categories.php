
<?php Subcategory::add(); ?>
<h1 class="page-header">
  Sub Categories

</h1>


<div class="col-md-4">

    <h3 class="bg-success"><?php display_message(); ?></h3>
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-eng-title">Title (english)</label>
            <input name="sub_category_eng_title" type="text" class="form-control">
        </div>
		
		<div class="form-group">
            <label for="category-swe-title">Title (swedish)</label>
            <input name="sub_category_swe_title" type="text" class="form-control">
        </div>
		
		
		    <div class="form-group">
         <label for="product-cat">Category</label>

        <select name="sup_category_id" id="" class="form-control">
            <option value="">Select Category</option>

             <?php show_categories_as_options(null); ?> 
           
		</select>
</div>
		
		

        <div class="form-group">
            <input name="add_sub_category" type="submit" class="btn btn-primary" value="Add Category">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
        </tr>
            </thead>


    <tbody>
       <?php show_sub_categories_in_admin(); ?>
    </tbody>

        </table>

</div>
