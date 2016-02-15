<?php

if(isset($_POST["submit"])){
	require_once('config.php');

	/*Open the connection to our database use the info from the config file.*/
	$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$result = $conn->query("SELECT 'Hello, dear MySQL user!' AS _message FROM DUAL");
	$row = $result->fetch_assoc();
	echo htmlentities($row['_message']);

	/*These are the main variables we'll use to process the form.*/
	//$table = $_POST['ebformID'];
	if(isset($_POST['ebformID']))     $table = $_POST['ebformID'];	
	
	
	
	$keys = implode(", ", (array_keys($_POST))); //all the names: formID, redirect_to, ......
	$values = implode("', '", (array_values($_POST)));
	
	//$redirect = isset($_POST['redirect_to']) ? $_POST['redirect_to']: '';

	/*These are the extra data fields we'll collect on form submission.*/
	$x_fields = 'timestamp';
	$x_values = time();
	
	// sql to create table
	$sql = "CREATE TABLE IF NOT EXISTS $table  (
			ID int(3) UNSIGNED AUTO_INCREMENT NOT NULL,
			PRIMARY KEY(`ID`),
			timestamp int NOT NULL
		)";

	if ($conn->query($sql) === TRUE) {
		echo $table . "Table created successfully ";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	


	/*Check to see if the fields specified in the form exist and if they don't, create them.*/
	foreach ($_POST as $key => $value) {
		$column = mysql_real_escape_string($key);
		$alter = f_fieldExists($table, $column, $column_attr = "VARCHAR( 255 ) NULL" );
		
		if (!alter) {
			echo 'Unable to add column: ' . $column;
		}
	}

	/*Insert out values into the database.*/
	$sql="INSERT INTO $table ($keys, $x_fields) VALUES ('$values', '$x_values')";

	if (!$conn->query($sql)) {
		 die("Connection failed: " . $conn->connect_error);
	}
	

	/*Close our database connection.*/
	$conn->close();

}
?>
