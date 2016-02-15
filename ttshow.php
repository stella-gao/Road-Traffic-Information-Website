<?php
	require 'connect_sql.php';

	
	//$conn->query("insert into bluetooth(blue_id, lat, lon, direction) values ('1','2.4','4.3','SB')");
	$start = 1;//$_GET["start"];
	$end = 2;//$_GET["end"];
	$query = "SELECT address, description FROM route_pic where start_id=".$start." and end_id=".$end;

	if ($stmt = $conn->prepare($query)) {
		/* execute statement */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($add, $desc);

    /* fetch values */
	$row = 0;
    while ($stmt->fetch()) {
    	echo "Hello";//"uploads/".$add;//"http://localhost/tis/uploads/".$add;
      // printf ("uploads/%s", $add); //http://localhost/tis/
    	break;
    }
	}
	$conn->close();
 ?>
