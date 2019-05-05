<?php
class Klarna {

  public $html_snippet;
  public $total_cost;
  public $order_json;
  public $id;

  public static function update_json(){
    	$json_url = "https://api.playground.klarna.com/checkout/v3/orders/". $_SESSION['order_id'];
	
	$username = "PK04101_51b9857afbd0";  // authentication
	$password = "Ffx7sjvGnSQeMSIe";  // authentication
	
	$json_string = '{
 "order_amount": '. ($this->total_cost * 100) .',
 "order_tax_amount": 0,
 "order_lines": [
   '. $this->order_json .'
 ]
}';	
	
// Initializing curl
$ch = curl_init( $json_url );

// Configuring curl options
$options = array(
CURLOPT_RETURNTRANSFER => true,
CURLOPT_USERPWD	=> $username . ":" . $password,  // authentication
CURLOPT_HTTPHEADER => array("Content-type: application/json") ,
CURLOPT_POSTFIELDS => $json_string
);

// Setting curl options
curl_setopt_array( $ch, $options );

// Getting results
$result = curl_exec($ch); // Getting jSON result string

$this->html_snippet = json_decode($result)->html_snippet;
return json_decode($result);
	//return $json_string;
}

  public function session_start() {
	
	echo "<br><br>";
	
	if(isset($this->id)) {
		
		$json_url = "https://api.playground.klarna.com/checkout/v3/orders/". $this->id;
	
	$username = "PK04101_51b9857afbd0";  // authentication
	$password = "Ffx7sjvGnSQeMSIe";  // authentication
	
		
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

		$_SESSION['klarna_html'] = json_decode($result)->html_snippet;
		
	} else {
		
	
$json_url = "https://api.playground.klarna.com/checkout/v3/orders";
	
$username = "PK04101_51b9857afbd0";  // authentication
$password = "Ffx7sjvGnSQeMSIe";  // authentication

// jSON String for request

$json_string = '{
 "purchase_country": "se",
 "purchase_currency": "sek",
 "locale": "en-GB",
 "billing_address": {
   "given_name": "Testperson-se",
    "family_name": "Approved",
    "email": "youremail@email.com",
    "street_address": "Stårgatan 1",
    "postal_code": "12345",
    "city": "Ankeborg",
    "phone": "+46765260000",
    "country": "se"
 },
 "order_amount":' . $this->total_cost * 100 .' ,
"order_tax_amount": 0,
"order_lines": ['. $this->order_json .' ],
 "merchant_urls": {
   "terms": "http://haichin.com/public/terms.php",
   "checkout": "http://haichin.com/public/checkout.php",
   "confirmation": "http://haichin.com/public/thankyou.php",
   "push": "http://haichin.com/public/klarnaPost.php"
 },
 "shipping_options": [
  {
    "id": "free_shipping",
    "name": "Free Shipping",
    "description": "Delivers in 5-7 days",
    "price": 0,
    "tax_amount": 0,
    "tax_rate": 0,
    "preselected": true,
    "shipping_method": "Home"
  }
]
}';

// Initializing curl
$ch = curl_init( $json_url );

// Configuring curl options
$options = array(
		 CURLOPT_RETURNTRANSFER => true,
		 CURLOPT_USERPWD	=> $username . ":" . $password,  // authentication
		 CURLOPT_HTTPHEADER => array("Content-type: application/json") ,
		 CURLOPT_POSTFIELDS => $json_string
		 );

// Setting curl options
curl_setopt_array( $ch, $options );

// Getting results
$result = curl_exec($ch); // Getting jSON result string


$this->html_snippet = json_decode($result)->html_snippet;
$this->id = json_decode($result)->order_id;
	}
  }


  public static function load() {
    echo $this->html_snippet;
  }  
}

?>