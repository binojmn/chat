<?php
  session_start();
  require_once( "inc/config.php" );
  require_once( "inc/chatClass.php" );
  $logout=$_SESSION['usrname']." logged off";
  
  // Insert the "User logged off: message to database.
  chatClass::setChatLines( $logout, $_SESSION['usrname']);

  // unset user session.
  unset($_SESSION['usrname']);
  include("template/success.tmpl");
?>
