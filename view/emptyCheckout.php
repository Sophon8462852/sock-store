<?php require_once("../model/new_config.php"); ?>
<?php require_once("../controller/cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

<div id="container">
<?php
	if($_SESSION['current_language'] == "eng") {
		echo "<div id='emptyCheckout'>Cart is empty</div>";
	} else {
		echo "<div id='emptyCheckout'>Kassan är tom</div>";
	}

?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php include(TEMPLATE_FRONT . DS ."footer.php") ?>