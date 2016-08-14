<?php

  /**
     * PHP script for validating the loginClass
     * Invoke the script -> php userClassTest.php
  */ 
  require_once( "../inc/config.php" );
  require_once( "../inc/loginClass.php");

  // Sample inputs
  $testuser = "test";
  $testpass = "test";
  $firstname = "Test";

  echo "** Testing the checkUserExist function **\n";
  echo "** user exists ->test to database ** \n";

  $res = loginClass::checkUserExist($testuser);

  print "** query output -->".$res."<-- Function - loginClass::checkUserExist ** \n";       
 
  echo "** Testing the insertUser function **\n";
  echo "** Insert user ->test to database ** \n";
        	   
  loginClass::insertUser($testuser, $testpass, $firstname);

  echo "** inserted the user to database Function - loginClass::insertUser **\n";

  echo "** Testing the checkUserExist function **\n";
  echo "** user exists ->test to database ** \n";

  $res = loginClass::checkUserExist($testuser);

  print "** query output -->".$res."<-- Function - loginClass::checkUserExist ** \n";
  
  if($res > 0) {
 
	print "** SUCCESS!!!!! Successfully added the user to Database with userid ".$res." !!!! Function - loginClass::insertUser, loginClass::checkUserExist **\n";
  } else {
	print "** FAILED!!!!!! Userid is 0, Failed the insert function !!!! Function - loginClass::insertUser **\n";
  }   

  echo "** Testing the checkUserLogin function **\n";
  echo "** user name and password in database ** \n";

  list($id, $firstname_indb) = loginClass::checkUserLogin($testuser, $testpass);
 
  echo "** Output!!! id -->".$id."<-- Firstname -->".$firstname_indb."<--  **\n";

  if($res > 0) {

        print "** SUCCESS!!!!! Successfully fetch id from Database. userid".$res."!!!! Function - loginClass::insertUser, loginClass::checkUserLogin **\n";
  } else {
        print "** FAILED!!!!!! Userid is 0, Failed the insert function !!!! Function - loginClass::insertUser **\n";
  }


  if($firstname_indb == $firstname) {

        print "** SUCCESS!!!!! First name in DB and Input is matching !!!! Function - loginClass::insertUser, loginClass::checkUserLogin **\n";
  } else {
        print "** FAILED!!!!!! First name in DB and Input is not matching!!!!  Function - loginClass::insertUser **\n";
  }
?>
