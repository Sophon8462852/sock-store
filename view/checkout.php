<?php require_once("../model/new_config.php"); ?>
<?php require_once("../controller/cart.php"); ?>
<?php include( TEMPLATE_FRONT . "/header.php") ?>


<?php


?>
    <div id="container">


<div class="row" id="checkoutContainer">
      <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
      <h1>Checkout</h1>

    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>


          <?php 
			
			cart(); ?>



        </tbody>
    </table>

<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php 
echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";?></span></td>
</tr>

<tr class="order-total">
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->

		<div id="checkout"></div>
		

		
		<div id="divUnderCheckout">
		
       <?php //Klarna::load() ; ?>	
			
			<br>
 </div><!--Main Content-->


    </div>
    <!-- /.container -->
    
    <?php
       //isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total']
       global $klarna;
if($klarna->total_cost == 0) {
redirect("emptyCheckout.php");
}

//if( !isset($_SESSION['item_total'])) {
//			redirect("emptyCheckout.php");
			
//		} else {
//			if($_SESSION['item_total'] == "0"){
//			redirect("emptyCheckout.php");
//			}
//		}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php include(TEMPLATE_FRONT . "/footer.php") ?>
