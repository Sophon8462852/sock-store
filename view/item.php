<?php require_once("../model/new_config.php"); ?>
<?php require_once("../controller/cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

 <div id="container">
	
    <?php render_product(); ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/item.js"></script>
<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
