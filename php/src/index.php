<?php
  session_start();

  //Index script.
 
  // Check whether the username is set or not. Display index if session is not set 
  if(!IsSet($_SESSION[ "usrname" ]) && $_SESSION[ "usrname" ] == "") {
   include('template/index.tmpl');
  }else{

   include('template/chat.tmpl');
 }
?>
