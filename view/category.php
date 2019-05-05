<?php require_once("../model/new_config.php"); ?>

<?php include( TEMPLATE_FRONT . "/header.php") ?>bite

 <div id="container" class="categoryContainer">
	 

<?php

if (isset($_GET['sub'])) {

	get_products_for_sub_category();
} else {

	get_products_for_category();
}

?>


</div>

<?php include(TEMPLATE_FRONT . "/footer.php") ?>