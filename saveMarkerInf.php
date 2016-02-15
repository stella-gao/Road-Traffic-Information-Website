<?php
	require 'connect_sql.php';

	$mes = $_POST['markerInf'];

	$infs = explode(';', $mes);

	$ind = 0;
	$Error = false;
	$b_ids = "";
	//$conn->query("insert into bluetooth(blue_id, lat, lon, direction) values ('1','2.4','4.3','SB')");
	foreach ($infs as $inf) {
		if (strpos($inf, ',') == false) {
			continue;
		}
		list($id, $dn, $mp, $rn) = explode(',', $inf);
		
		if ($id == 0) {
			break;
		}

		$query = "update bluetooth set dn=$dn, mp=$mp, rn='$rn' where blue_id=$id;";
		if ($conn->query($query) !== TRUE) {
		    $Error = true;
		    break;
		}
	}

	$segName = $_POST['segName'];
	$dis = $_POST['dis'];
	$segment = $_POST['segment'];

	$query = "update segment set seg_name='$segName', seg_dis=$dis where seg_id=$segment;";
	echo $query;
	if ($conn->query($query) !== TRUE) {
	    $Error = true;
	    break;
	}

	if ($Error) {
	?>
		alert("Save Error.\n");
	<?php
	} else {
	?>
		alert("Save successfully.\n");
	<?php
	}
?>
