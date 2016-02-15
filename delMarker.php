<?php
	require 'connect_sql.php';

	//$conn->query("insert into bluetooth(blue_id, lat, lon, direction) values ('1','2.4','4.3','SB')");
	$segId = $_POST["seg"];

  $query = "select blue_id FROM segment where seg_id='$segId'";

  $b_ids = "";

  if ($stmt = $conn->prepare($query)) {
    /* execute statement */
    $stmt->execute();

     // bind result variables 
    $stmt->bind_result($b_id);

    /* fetch values */
    while ($stmt->fetch()) {
      $b_ids = $b_ids.$b_id.",";
    }
  }

  $query = "delete FROM bluetooth where seg_id='$segId'";    
  if ($conn->query($query) !== TRUE) {
      $Error = true;
      break;
  }

  $query = "delete FROM segment where seg_id='$segId'";
  $conn->query($query);

  $Error = false;

  $b_idArray = explode(',', $b_ids);

  foreach ($b_idArray as $b_id) {
    $query = "delete FROM route_path where start_id='$b_id' or end_id='$b_id'";    
    if ($conn->query($query) !== TRUE) {
        $Error = true;
        break;
    }    
  }

  // if (!$Error) {
  //   alert("success");
  // }

?>
