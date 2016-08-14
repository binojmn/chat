<?php

  class chatClass
  {
    /**
        * function for retrieving the chat result.
        * inputs -> id
        * output -> json array [ id, username, chattext, date].
    */

    public static function getRestChatLines($id)
    {
      $arr = array();
      $jsonData = '{"results":[';
      $db_connection = new mysqli( mysqlServer, mysqlUser, mysqlPass, mysqlDB);
      $db_connection->query( "SET NAMES 'UTF8'" );
      $statement = $db_connection->prepare( "SELECT id, usrname, chattext, chattime FROM chat WHERE id > ? and chattime >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
      $statement->bind_param( 'i', $id);
      $statement->execute();
      $statement->bind_result( $id, $usrname,  $chattext, $chattime);
      $line = new stdClass;
      while ($statement->fetch()) {
        $line->id = $id;
        $line->usrname = $usrname;
        $line->chattext = $chattext;
        $line->chattime = date('H:i:s', strtotime($chattime));
        $arr[] = json_encode($line);
      }
      $statement->close();
      $db_connection->close();
      $jsonData .= implode(",", $arr);
      $jsonData .= ']}';
      return $jsonData;
    }

    /**
    	* function for inserting the chat records. 
	* inputs -> chattext and username
	* output -> none
    */
    public static function setChatLines( $chattext, $usrname) {
      $db_connection = new mysqli( mysqlServer, mysqlUser, mysqlPass, mysqlDB);
      $db_connection->query( "SET NAMES 'UTF8'" );
      $statement = $db_connection->prepare( "INSERT INTO chat( usrname, chattext ) VALUES(?, ?)");
      $statement->bind_param( 'ss', $usrname, $chattext);
      $statement->execute();
      $statement->close();
      $db_connection->close();
    }
  }
?>
