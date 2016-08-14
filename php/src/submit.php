<?php
  session_start();
  require_once( "inc/config.php" );
  require_once( "inc/chatClass.php" );

  // Get the user chat lines from GET.
  $chattext = htmlspecialchars( $_GET['chattext'] );

  // Insert chat lines to database.
  chatClass::setChatLines( $chattext, $_SESSION['usrname']);
?>
