


<?php #connector.php

	class connection
	{
	
			private $USER;
			private $PASS;
			private $HOST;
			private $SITE_NAME;

			public function_construct($USER ,$PASS , $HOST ,$SITE_NAME){
				
				$this->USER=$USER
				$this->PASS=$PASS
				$this->HOST=$HOST
				$this->SITE=$PASS

			}//construction

		$2446992_New_Customer = new interestCalculator(47924, 47924cis12, 209.129.8.3,47924)		

	    function connectToNew_Customer // create a function for connect database
    													{

        $database= mysql_connect($this->host,$this->username,$this->password);

        if(!$conn)// testing the connection
        {
            die ("Cannot connect to the database");
        }

        else
        {

            $this->myconn = $conn;

            echo "Connection established";

        }

        return $this->myconn;

    }

    function selectDatabase() // selecting the database.
    {
        mysql_select_db($this->database);  //use php inbuild functions for select database

        if(mysql_error()) // if error occured display the error message
        {

            echo "Cannot find the database ".$this->database;

        }
         echo "Database selected..";       
    }

    function closeConnection() // close the connection
    {
        mysql_close($this->myconn);

        echo "Connection closed";
    }

}

?>

    include ('connection.php');

    $connection = new createConnection(); //i created a new object

    $connection->connectToDatabase(); // connected to the database

    echo "<br />"; // putting a html break

    $connection->selectDatabase();// closed connection

    echo "<br />";

    $connection->closeConnection();
			

?>