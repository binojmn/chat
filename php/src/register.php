<?php
  require_once( "inc/config.php" );
  require_once( "inc/loginClass.php");

  // Check whether the Request method id POST. Else print the registration page.
  if($_SERVER["REQUEST_METHOD"] == "POST") {
	$regerrmsg = "";

        // validate the values. Error out if not set 
        if((strlen(trim($_POST['fname'])) == 0) || (strlen(trim(($_POST['usrname'])))  == 0) || (strlen(trim(($_POST['usrpass'])))  == 0) || (strlen(trim(($_POST['conpass'])))  == 0)) {
             $regerrmsg="Please fill all the fiels";
        }

        // check whether both password and confirm password is same. Error if both the password is not matching. 
  	if($_POST['usrpass'] != $_POST['conpass']) {
		$regerrmsg="Password & Confirm Password is not matching";
  	}
        
        // Add the user to database.
	if(!$regerrmsg) {

		// Check whether the user exists in DB or not. Error if exists.
                $res = loginClass::checkUserExist($_POST['usrname']);       
                if($res > 0) { 
		  $regerrmsg="Userid ". $_POST['usrname']. " already exists in DB";
                } else {   
		   // Insert user information into database.      
         	   loginClass::insertUser($_POST['usrname'], $_POST['usrpass'],$_POST['fname']);
	           $register="Successfully registered"; 		
                   include("template/success.tmpl");
                   exit;
               }
      }
   } 
include("template/register.tmpl");

?>
