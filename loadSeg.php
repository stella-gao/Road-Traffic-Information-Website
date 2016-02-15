<?php
	require "connect_sql.php";
	$query = "SELECT seg_id, blue_id FROM segment";
	if ($stmt = $conn->prepare($query)) {
		/* execute statement */
	    $stmt->execute();

	    /* bind result variables */
	    $stmt->bind_result($s_ids, $b_ids);

	    /* fetch values */
	    while ($stmt->fetch()) {
	      // printf ("%s,%s!", $s_ids, $b_ids);
	    	$x = 0;
		}
	}
	echo "OK";
?>
