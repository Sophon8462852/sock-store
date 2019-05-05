<?php require_once("../resources/new_config.php"); ?>    
	<?php 
	
	
	//if($_GET['id'] == "5"){
	
	include("../resources/templates/front/header.php");
	//}
	 ?>


	<?php 
	//temporary block of public view
				
				//if($_GET['id'] == "5"){
	if(isset($_GET['lang'])){
		if($_GET['lang'] == "swe") {
			$_SESSION['current_language'] = "swe";
			redirect("index.php");
  		} else {
			if($_GET['lang'] == "eng") {
				$_SESSION['current_language'] = "eng";
				redirect("index.php") ;
			}
		} 
	}
	
	//}
	
	
	?>

        
			
				<?php 
			//if($_GET['id'] == "5"){
				
				echo '<div id="bigImage"><img src="../resources/uploads/haichinBGPicture.jpg"></div>';
       				echo ' <div id="container">';
			echo '<div id="categoryContainer">';
				
					get_categories_index(); 
					
					echo "</div>";
					echo "</div>";
					
					//}
				
				
				?>
			<!-- </div> -->

	<!-- </div> -->

<?php  
	//if($_GET['id'] == "5"){

	include("../resources/templates/front/footer.php"); 
	
	//}
	
?>
        
