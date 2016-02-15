<?php


	require_once('config.php');

	/*Open the connection to our database use the info from the config file.*/
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	/*
	$result = $conn->query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
	$row = $result->fetch_assoc();
	echo htmlentities($row['_message']);*/

	/*These are the main variables we'll use to process the form.*/
	//$table = $_POST['ebformID'];
	//if(isset($_POST['ebformID']))     $table = $_POST['ebformID'];	
	
	$table = $_POST["ebformID"];
	$route=$_POST["ebroute"];
	$lat=$_POST["eblat"];
	$long=$_POST["eblong"];
	$mp=$_POST["ebmp"];
	$type=$_POST["ebtype"];
	



   
	
	// sql to create table
	$sql = "CREATE TABLE IF NOT EXISTS EB  (
			ID int(3) UNSIGNED AUTO_INCREMENT NOT NULL,
			PRIMARY KEY(ID),
			ROUTE INT NOT NULL,
			LAT DOUBLE NOT NULL,
			LONG DOUBLE NOT NULL,
			MP DOUBLE NOT NULL,
			TYPE VARCHAR(10) NOT NULL,
			timestamp int NOT NULL
		)";

	if ($conn->query($sql) === TRUE) {
		echo "Table created successfully ";
	} else {
		echo "Error creating table: " . $conn->error;
	}
   
	
	$sql="INSERT INTO EB(ROUTE, LAT, LONG, MP, TYPE, timestamp) 
		values ('".$route."','".$lat."','".$long."','".$mp."','".$type."','".time()."');";

	if (!$conn->query($sql)) {
		 die("Connection failed: " . $conn->connect_error);
	}
	

	/*Close our database connection.*/
	$conn->close();


?>
