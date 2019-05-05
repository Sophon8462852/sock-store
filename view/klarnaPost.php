<?php require_once("../controller/cart.php"); ?>

<?php






$json_url = "https://api.playground.klarna.com/ordermanagement/v1/orders/". $_GET['sid'];
	
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






		$json_url1 = "https://api.playground.klarna.com/ordermanagement/v1/orders/". $result->order_id ."/acknowledge";
		
		$ch1 = curl_init( $json_url1 );

		// Configuring curl options
		$options1 = array(
		CURLOPT_HTTPHEADER => array("Content-type: application/json") ,
		);

// Setting curl options
		curl_setopt_array( $ch1, $options1 );

// Getting results
		$result1 = curl_exec($ch1); // Getting jSON result string

		echo json_decode($result1)->html_snippet;

?>