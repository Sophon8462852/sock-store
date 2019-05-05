<?php ob_start(); ?>
<?php require_once("../model/new_config.php"); ?>

<?php include(TEMPLATE_BACK . "/header.php"); ?>

<?php 

if(!isset($_SESSION['username'])) {
  redirect("home.php");
}
 ?>

        <div id="adminContainer">
            <div class="container-fluid">

              <?php 

                if($_SERVER['REQUEST_URI'] == "/admin/" || $_SERVER['REQUEST_URI'] == "/admin.php")  {
                    include("products.php");
                }

                if(isset($_GET['orders'])){
                    include("orders.php");
                }

                if(isset($_GET['categories'])){
                    include("categories.php");
                }

                 if(isset($_GET['products'])){
                    include("products.php");
                }


                 if(isset($_GET['add_product'])){
                    include("add_product.php");
                }


                 if(isset($_GET['edit_product'])){
                    include("edit_product.php");
                }

if(isset($_GET['edit_category'])){
                    include("edit_category.php");
                }


if(isset($_GET['edit_sub_category'])){
                    include("edit_sub_category.php");
                }


                if(isset($_GET['users'])){
                    include("users.php");
                }


                if(isset($_GET['add_user'])){
                    include("add_user.php");
                }


                 if(isset($_GET['edit_user'])){
                    include("edit_user.php");
                }


                  if(isset($_GET['reports'])){
                    include("reports.php");
                }

                 if(isset($_GET['slides'])){
                    include("slides.php");
                }


                 if(isset($_GET['delete_order_id'])){
                    include("delete_order.php");
                }

                 if(isset($_GET['delete_product_id'])){
                    include("delete_product.php");
                }

                 if(isset($_GET['delete_category_id'])){
                    include("delete_category.php");
                }


                 if(isset($_GET['delete_report_id'])){
                    include("delete_report.php");
                }

                 if(isset($_GET['delete_user_id'])){
                    include("delete_user.php");
                }


                 if(isset($_GET['delete_slide_id'])){
                    include("delete_slide.php");
                }

if(isset($_GET['sub_categories'])){
  include("sub_categories.php"); 
}



                if(isset($_GET['add_picture_to_product'])){
                    include("add_picture_to_product.php");
                }
                 ?>
            
            </div>
        </div>

<?php include(TEMPLATE_BACK . "/footer.php"); ?>