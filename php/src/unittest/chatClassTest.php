<?php
  /**
     * script for testing the chatClass
     * command to execute -> php chatClassTest.php
  */
  require_once( "../inc/config.php" );
  require_once( "../inc/chatClass.php");

  $id = 0;
  $chattext = "test";
  $username = "test";

  echo "** Testing the getRestChatLines function **\n";
  echo "** fetch the values. chatClass::getRestChatLines ** \n";

  $res = chatClass::getRestChatLines($id);

  print "** query output -->".$res."<-- Function -  chatClass::getRestChatLines ** \n";       
 
  echo "** Testing the chatClass::setChatLines function **\n";
  echo "** Insert text ->test to database ** \n";
        	   
  chatClass::setChatLines($chattext, $username);

  echo "** inserted the chat text to database Function - chatClass::setChatLines **\n";
  
  $res = chatClass::getRestChatLines($id);
  $obj = json_decode($res);

  if($obj->{'results'}) {

    if(is_null($obj->{'results'}[0]->{'usrname'})) {
         print "** FAILED!!!!!! Result is ".$res."!!!! , Failed the insert function !!!! Function - chatClass::setChatLines **\n";
     } else {
         print "** SUCCESS!!!!! Successfully fetch values from Database. result".$res."!!!! Function - chatClass::setChatLines, chatClass::getRestChatLines **\n";
     }
   } else {
	print "** FAILED!!!!!! Result is ".$res."!!!! , Failed the insert function !!!! Function - chatClass::setChatLines **\n";
   }
?>
