<?php

class Database {


  public $dbconn;
  private $options;
  
  function __construct() {
    $this->open_db_connection();
  }

  public function open_db_connection() {
     
  
try {
  $this->options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
  
  $this->dbconn = new PDO("mysql:host=localhost;dbname=school_haichin;", "root", "", $this->options);
  $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

  echo 'Connection failed: ' . $e->getMessage() . "<br>";

}

  }


  public function query($sql) {
    $result = $this->dbconn->prepare($sql);
    return $result;
    
  }

  private function confirm_query($result) {
    if(!$result) {
      die("query failed");
    }
  }

  public function init_database()
  {
    try {

	$sql = "CREATE TABLE user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    password VARCHAR(30),
    last_time_logged_in DATETIME,
    is_admin BIT
    )";

	$this->dbconn->exec($sql);

	$sql = "CREATE TABLE quiz (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    description TEXT,
    creating_user INT(6)
    )";

	$this->dbconn->exec($sql);

	$sql = "CREATE TABLE question (
    question_text TEXT NOT NULL,
    quiz_id INT(6) NOT NULL,
    order_in_quiz INT(6) NOT NULL,
    creating_user INT(6)
    )";

	$sql = "CREATE TABLE correct_answer (
    alternative_number INT(1),
    quiz_id INT(6) NOT NULL,
    order_in_quiz INT(6) NOT NULL,
    )";

	$this->dbconn->exec($sql);

	$sql = "CREATE TABLE answer (
    answer_text TEXT NOT NULL,
    quiz_id INT(6) NOT NULL,
    order_in_quiz INT(6) NOT NULL,
    creating_user INT(6)
    )";

	$this->dbconn->exec($sql);

	$sql = "CREATE TABLE result (
    user_id INT(6) NOT NULL,
    quiz_id INT(6) NOT NULL,
    points INT
    )";

	$this->dbconn->exec($sql);

	echo "Table created successfully";
} catch (PDOException $e) {
	echo $sql . "<br>" . $e->getMessage();
}

$dbconn = null;

  }
 
  
  
  
}

?>