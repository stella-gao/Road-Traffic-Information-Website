<?php
$servername = "localhost:3307";
$username = "root";
$password = "";

// Create connection
//$conn = mysql_connect($servername,$user,$password); 
// Check connection
// if ($conn) {
//     echo "Connected successfully";
// } else {
// die("Connection failed: ");
// }

//$conn = @mysql_connect("localhost","root","") or die ("Unable to connect database server!"); 


// Create connection
$conn = new mysqli("localhost:3307", "root", "", "web_traffic");
//$conn = mysql_connect($servername,$user,$password); 

//$connect = @mysql_connect("localhost","root","123456") or die ("Unable to connect database server!"); 

// Check connection

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

// if ($conn->query("insert into pic(address) values ('4');") === TRUE) {
//     printf("Insert successfully.\n");
// }

?>
