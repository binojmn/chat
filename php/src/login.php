<?php
   session_start();
   require_once( "inc/config.php" );
   require_once( "inc/chatClass.php" );
   require_once( "inc/loginClass.php");

   // check whether the username and password is set
   if(empty(trim($_POST['usrname'])) || empty(trim($_POST['usrpass']))) {
	header("Location: index.php?invalid");
	exit;
   }
  
  // Check if it is a valid user in DB.
  list($res, $firstname) = loginClass::checkUserLogin($_POST['usrname'], $_POST['usrpass']);
  if($res) {
  	session_start();
 	$_SESSION['usrname'] = $firstname;
  	$chattext=$_SESSION['usrname']." logged in";
 
        // Insert "User logged in" message into DB 
	chatClass::setChatLines( $chattext, $_SESSION['usrname']);
  	header("Location: index.php");
  } else { 
	header("Location: index.php?invalid");
        exit;
  }

?>
