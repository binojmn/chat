<?php
  // PHP script for fetching the chat lines from DB.
  require_once( "inc/config.php" );
  require_once( "inc/chatClass.php" );
  
  // last time id from GET 
  $id = intval( $_GET[ 'lastTimeID' ] );
  
  // function call 'getRestChatLines' for fetching the chat lines.
  $jsonData = chatClass::getRestChatLines( $id );

  // printing the json data output.
  print $jsonData;
?>
