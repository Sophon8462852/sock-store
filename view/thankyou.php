<?php require_once("../model/new_config.php"); ?>    
	<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

	
		<?php 
	
	
	 	$json_url = "https://api.playground.klarna.com/checkout/v3/orders/". $_SESSION['order_id'];
	
		$username = "PK04101_57e36968c8e6";  // authentication
		$password = "tYgpzHjEK9NFu43Q";  // authentication
		
		$ch = curl_init( $json_url );

		// Configuring curl options
		$options = array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_USERPWD	=> $username . ":" . $password,  // authentication
		CURLOPT_HTTPHEADER => array("Content-type: application/json") ,
		);

// Setting curl options
		curl_setopt_array( $ch, $options );

// Getting results
		$result = curl_exec($ch); // Getting jSON result string

		echo json_decode($result)->html_snippet;
	
	
	$query = query("INSERT INTO orders(order_klarna_id, order_amount, order_products, order_zip_code, order_region, order_adress) VALUES('{$_SESSION['order_id']}', '{$'item_total'}', '{$_SESSION['order_products']}', '". json_decode($result)->billing_address->postal_code ."', '". json_decode($result)->billing_address->region ."', '". json_decode($result)->billing_address->street_address ."')");

confirm($query);


        }


?>
        <div id="container">
			<h1>Thank You for your purchase!</h1>
		</div>

	   <?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
        