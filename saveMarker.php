<?php
	require 'connect_sql.php';

	$num = $_POST['num'];
	$latLng = $_POST['lat'];
	$segment = $_POST['segment'];


	echo "$segment";

	$lls = explode('!', $latLng);

	$ind = 0;
	$Error = false;
	$b_ids = "";
	//$conn->query("insert into bluetooth(blue_id, lat, lon, direction) values ('1','2.4','4.3','SB')");

	if ($conn->query("delete from bluetooth where seg_id=$segment") != true) {
		$Error = false;
	}

	if ($conn->query("delete from segment where seg_id=$segment") != true) {
		$Error = false;
	}

	// $blue_ids = '';
	// $query = "SELECT blue_id FROM bluetooth where seg_id=$segment";
	// if ($stmt = $conn->prepare($query)) {
	// 	/* execute statement */
	//     $stmt->execute();

	//      // bind result variables 
	//     $stmt->bind_result($b_ids);

	//     /* fetch values */
	//     while ($stmt->fetch()) {
	//       $blue_ids=$blue_ids.','.$b_ids;
	//     }
	// }

	$number = 0;
	foreach ($lls as $ll) {
		if (strpos($ll, ',') == false) {
			continue;
		}
		list($ind, $lat, $lng) = explode(',', $ll);
		
		if ($lat == 0) {
			break;
		}
		// $query = "select count(*) from bluetooth where blue_id=$ind";
		// $result = $conn->query($query);
		// $rows = $result->fetch_row();
		// if($rows[0] !== 0) {
		
		// }
		if ($conn->query("insert into bluetooth(blue_id, seg_id, lat, lon, direction) values ('".$ind."',$segment,'".$lat."','".$lng."','SB');") !== TRUE) {
		    $Error = true;
		    break;
		}
		$number = $number+1;
		// $conn->query("delete from segment where blue_id=$ind");
		$line = "($segment,$ind)";
		$b_ids = $b_ids.$line.',';
	}

	$b_ids = substr($b_ids, 0, strlen($b_ids)-1);
	echo "XXXX".$b_ids;

	$segName = $_POST['segName'];
	$dis = $_POST['dis'];

	$query = "insert into segment(seg_id, seg_name, seg_num, seg_dis) values ('$segment', '$segName', '$number', '$dis');";
	
	echo $query;
	if ($conn->query($query) != TRUE) {
        $Error = false;
    }

    $mes = $_POST['markerInf'];

	$infs = explode(';', $mes);

	//$conn->query("insert into bluetooth(blue_id, lat, lon, direction) values ('1','2.4','4.3','SB')");
	foreach ($infs as $inf) {
		if (strpos($inf, ',') == false) {
			continue;
		}
		list($id, $dn, $mp, $rn) = explode(',', $inf);
		// echo "$id";
		if ($id == 0) {
			break;
		}

		$query = "update bluetooth set dn=$dn, mp=$mp, rn='$rn' where blue_id=$id;";
		// echo $query;
		if ($conn->query($query) !== TRUE) {
		    $Error = true;
		    break;
		}
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
