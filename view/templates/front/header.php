<?php require_once("../init.php"); ?>
<!DOCTYPE HTML>
<html>

<head>
    <link href="css/home.css" rel="stylesheet">
	<link href="css/item.css" rel="stylesheet">
	<link href="css/checkout.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Haichin</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.8.10/themes/smoothness/jquery-ui.css" type="text/css">
    </head>
    
    <body>

<div id="navBar">
	<div id="nonCollapseNavBar">
   <?php get_categories_for_non_collapse();
		
		
		if($_SESSION['current_language'] == "swe") {
			echo "<a class='languageLink' href='home.php?lang=eng'>English</a>";
  		} else {
			echo "<a class='languageLink' href='home.php?lang=swe'>Swedish</a>";
		}
		
		
		?>	
		
		
		<?php
	
render_sub_categories();
	
	?>
	
	</div>
            
	<div id="collapseNavBar">
		<div id='menuButton'>
			<div id='topBL' class='buttonLine'></div>
			<div id="midBL" class='buttonLine'></div>
			<div id='lowBL' class='buttonLine'></div>
		</div>

		<a href="home.php"><div id='brand'><img src='../uploads/haichinwhitelogo.jpeg' style='width: 25vw; max-width: 100px;'></div></a>
		
		        <div id="dropDownPanel">
   <?php get_categories_for_collapse(); ?>
					
		<?php if($_SESSION['current_language'] == "swe") {
			echo "<a class='languageLink' href='home.php?lang=eng'>English</a>";
  		} else {
			echo "<a class='languageLink' href='home.php?lang=swe'>Swedish</a>";
		} ?>
		
</div>
	</div>
	
	
	
	
	
	
	<a href="checkout.php" id="shoppingCartLink"><span class="glyphicon glyphicon-shopping-cart"></span></a>
        </div>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		 <script src="js/header.js"></script> -->
		