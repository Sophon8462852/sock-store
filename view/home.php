<?php require_once("../model/new_config.php"); ?>    
<?php
//User::find_all_users();
if (!User::check_existing_user(5)) {
  //not found
} else {
  //found
}
?>

<?php 
	
	
	include(TEMPLATE_FRONT . "/header.php");
	
	 ?>


	<?php 


if(isset($_GET['lang'])){
		if($_GET['lang'] == "swe") {
			$_SESSION['current_language'] = "swe";
			redirect("home.php");
  		} else {
			if($_GET['lang'] == "eng") {
				$_SESSION['current_language'] = "eng";
				redirect("home.php") ;
			}
		} 
	}
	
	
	?>

        
			
				<?php 
				
				echo '<div id="bigImage"><img src="../uploads/haichinBGPicture.jpg"></div>';
       				echo ' <div id="container">';
			echo '<div id="categoryContainer">';
				
display_all_categories();
					
					echo "</div>";
					echo "</div>";
				       	
				
				?>
<script src="js/home.js"></script>
<?php  
	include(TEMPLATE_FRONT . "/footer.php"); 	
?>
        
