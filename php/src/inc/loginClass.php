<?php

  class loginClass
  {
    /**
        * function for handling the user login 
	* inputs -> username and password
	* output -> array [ id and firstname ] 
    */
    public static function checkUserLogin($username, $password)
    {
      $db_connection = new mysqli( mysqlServer, mysqlUser, mysqlPass, mysqlDB);
      $db_connection->query( "SET NAMES 'UTF8'" );
      $statement = $db_connection->prepare( "select id, firstname  from chat_users where username = ? and password = ?" );
      $statement->bind_param( 'ss', $username, $password);
      $statement->execute();
      $statement->bind_result( $id, $firstname );
      $statement->fetch();
      $statement->close();
      $db_connection->close();
      return array($id, $firstname);
    }

    /** 
	* function for handling the user exists or not.
	* inputs -> username
	* output -> id
    */
    public static function checkUserExist($username) {
      $db_connection = new mysqli( mysqlServer, mysqlUser, mysqlPass, mysqlDB);
      $db_connection->query( "SET NAMES 'UTF8'" );
      $statement = $db_connection->prepare( "select id from chat_users where username = ?" );
      $statement->bind_param( 's', $username);
      $statement->execute();
      $statement->bind_result( $id );
      $statement->fetch();
      $statement->close();
      $db_connection->close();
      return $id;
    }
   
    /**
	* Inserting new user to database. 
	* inputs -> username, password and firstname
	* output -> none.
    */
    public static function insertUser( $username, $password, $firstname ) {
      $db_connection = new mysqli( mysqlServer, mysqlUser, mysqlPass, mysqlDB);
      $db_connection->query( "SET NAMES 'UTF8'" );
      $statement = $db_connection->prepare( "INSERT INTO chat_users( username, password, firstname) VALUES(?, ?, ?)");
      $statement->bind_param( 'sss', $username, $password, $firstname);
      $statement->execute();
      $statement->close();
      $db_connection->close();
    }
  }
?>
