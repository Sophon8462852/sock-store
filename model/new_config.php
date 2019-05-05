<?php

ob_start();
session_start();

defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "../view/templates/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "../view/templates/back");

defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", "../uploads");


defined("DB_HOST") ? null : define("DB_HOST", "localhost");

defined("DB_USER") ? null : define("DB_USER","root");

defined("DB_PASS") ? null : define("DB_PASS", "");

defined("DB_NAME") ? null : define("DB_NAME", "school_haichin");





//$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(isset($_SESSION['current_language']) == false) {
	$_SESSION['current_language'] = 'eng';
}

require_once("essential_functions.php");
require_once("User.php");
require_once("Database.php");
require_once("Category.php");
require_once("Subcategory.php");
require_once("Product.php");
require_once("Klarna.php");
require_once("Cart.php");
require("password.php");
require_once("../controller/category_functions.php");
require_once("../controller/product_controller.php");
require_once("../controller/back_end_controller.php");


$db = new Database;
$klarna = new Klarna;

if(!isset($_SESSION['products_in_cart'])) {
$_SESSION['products_in_cart'] = array();
}


$db->open_db_connection();

Category::fetch();
Product::fetch();
User::fetch();
Subcategory::fetch();
?>
