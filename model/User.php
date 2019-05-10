<?php

class User {

  public $id;
  public $username;
  public $email;
  public $password;
  public $confirmed;

  public function check_existing_user($id) {
    $status = false;
    foreach(User::get_all() as $user) {
      if($user->id == $id) {
	$status = true;
      }
    }  
    return $status;
  }

  public function login($username, $password) {

    global $db;
    
    foreach(User::get_all() as $user) {
	  
	//if($username == $user->username && $password == $user->password) {
	if($username == $user->username && password_verify($password, $user->password)) {


	if($user->confirmed == 0) {
	  set_message("Admin account not confirmed");
	  redirect("login.php");
	  die();
	}

	
	
	$_SESSION['username'] = $username;
	redirect("admin.php");
	die();
      }
     
    }
    
    set_message("Incorrect username or password");
    redirect("login.php");
  }

  private function get_time_created($id) {
    global $db;
    $sql = 'SELECT * FROM users WHERE id= ' . $id;
    foreach ($db->dbconn->query($sql) as $row) {
       
      return $row['time_created'];
      
    }
  }


   public static function fetch() {
    global $db;
    $_SESSION['user_array'] = array();
    $sql = 'SELECT * FROM users';
    //foreach ($db->dbconn->query($sql) as $row) {
    foreach ($db->dbconn->query($sql) as $row) {
       
      $user = User::instantiation($row);
      array_push($_SESSION['user_array'], serialize($user));
      
    }
  }

   public static function get_all() {
    $array = array();
    
    foreach ($_SESSION['user_array'] as $value) {
	        $user = unserialize($value);
		array_push($array, $user);
    }
    return $array;
  }


   public static function get_from_id($id) {
    
    
    foreach ($_SESSION['user_array'] as $value) {
	        $user = unserialize($value);
		if($user->id == $id) {
		  return $user;
		  }
    }
  }

   public static function add() {
     if(isset($_POST['add_user']) && isset($_SESSION['username'])) {
       global $db;

       try {
	 $str=rand(); 
	 $confirmation_string = md5($str); 
	 $username   = $_POST['username'];
	 $email      = $_POST['email'];
	 $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
	 
	 $sql = "INSERT INTO users(username,email,password,confirmed,time_created, confirmation_string) VALUES('{$username}','{$email}','{$password}', 0, NOW(), '{$confirmation_string}')";

	 $db->dbconn->exec($sql);
    
	 set_message("User Created, Confirmation Email Sent");
	 redirect("admin.php?users");

	 $meddelande = "To confirm your account, please press this link: kaliff.xyz/confirm.php?username=". $username ."&confirmation=" . $confirmation_string;
	 $mottagare=$_POST["email"];
	 $rubrik="Account Confirmation";
	 $mejlhuvud="From: ". $email ." \nReply-To: kalle@anka.se";
	 mail($email, $rubrik, $meddelande, $mejlhuvud);

	 

       }
       catch(PDOException $e)
	 {
	   echo $e->getMessage();
	   set_message($sql . "<br>" . $e->getMessage());
	 }
     }
   }

   public static function delete($id) {
     global $db;
     
     try {
       $sql = "DELETE FROM users WHERE id = " . $id;
       $db->dbconn->exec($sql);
       
       set_message("User Deleted");
       redirect("admin.php?users");
       User::fetch();
    
     }
     catch(PDOException $e)
       {
	 echo $e->getMessage();
	 set_message($sql . "<br>" . $e->getMessage());
       }
   }


   public static function confirm() {
      global $db;

      try {

	if(isset($_GET['username']) && isset($_GET['confirm'])) {
	  $user;
	  foreach(User::get_all() as $item) {
	    if($item->username == $_GET['username']) {
	      $user = $item;
	    }
	  }

	if($user->confirmed == 0) {
   
	  $user_time = User::get_time_created($user->id);
	  $now;
	  $diff;

	  foreach($db->dbconn->query('SELECT NOW()') as $row) {
	    $now = $row['NOW()'];
	  }

	  foreach($db->dbconn->query("SELECT TIMEDIFF('{$now}','{$user_time}')") as $row) {
	    $diff = $row["TIMEDIFF('{$now}','{$user_time}')"];
	  }
	  
	  foreach($db->dbconn->query("SELECT MINUTE('{$diff}')") as $row) {
	    if($row["MINUTE('{$diff}')"] > 15) {
	      set_message("Confirmation time expired");
	      redirect("login.php");
	    } else {
	      $query = "UPDATE users SET ";	
	      $query .= "confirmed = '1'";
	      $query .= "WHERE id=" . $user->id . " AND confirmation_string='". $_GET['confirm'] . "'";
	      $stmt = $db->query($query);
	      $stmt->execute();
	      set_message("Account confirmed");
	      redirect("login.php");
	      User::fetch();
	    }
	  }
	}

	
      }
  
    }
    catch(PDOException $e)
      {
	echo $e->getMessage();
	set_message("<br>" . $e->getMessage());
      }
 
   }



  
  private static function instantiation($found_category) {
    $object = new self;

    $object->id = $found_category['id'];
    $object->username = $found_category['username'];
    $object->password = $found_category['password'];
    $object->email = $found_category['email'];
    $object->confirmed = $found_category['confirmed'];
    
    return $object;
  }

}
