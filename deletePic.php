<?php
	require 'connect_sql.php';

	//$conn->query("insert into bluetooth(blue_id, lat, lon, direction) values ('1','2.4','4.3','SB')");
	$Tadds = $_POST["picAdd"];
  $Tadds2 = implode (",", $Tadds);
  $adds = explode(',', $Tadds2);

  foreach ($adds as $add) {
    $query = "delete FROM route_pic where address='$add'";
    if ($conn->query($query) !== TRUE) {
        $Error = true;
        break;
    }
    echo "$add";
  }

?>
