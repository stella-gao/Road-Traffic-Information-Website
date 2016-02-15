<?php
require 'connect_sql.php';


    $segId = $_POST['segment'];

    $idS = '';

    $query = "SELECT blue_id FROM bluetooth where seg_id='$segId';";
    if ($stmt = $conn->prepare($query)) {
        /* execute statement */
        $stmt->execute();

         // bind result variables 
        $stmt->bind_result($b_ids);

        /* fetch values */
        while ($stmt->fetch()) {
            $idS = $idS.$b_ids.";";
        }
    }

    echo "$segId";

    $idArray = explode(';', $idS);
    foreach ($idArray as $id) {
        if ($id == 0) {
            break;
        }
        echo "$id";
        $conn->query("delete from route_path where start_id=$id or end_id=$id;");
    }

    $num = $_POST['num'];
    $pathVar = $_POST['line'];

    echo $num;

    $lls = explode('!', $pathVar);

    $ind = 0;
    $Error = false;
    //$conn->query("insert into bluetooth(blue_id, lat, lon, direction) values ('1','2.4','4.3','SB')");
    foreach ($lls as $ll) {
        if (strpos($ll, ',') == false) {
            continue;
        }
        list($start, $end, $paths) = explode(',', $ll);

        // $conn->query("delete from route_path where start_id=$start and end_id=$end");

        $latLngs = explode(']', $paths);
        foreach ($latLngs as $latLng) {
            if (strpos($latLng, '?') == false) {
                continue;
            }
            list($lat, $lng) = explode('?', $latLng);
            if ($conn->query("insert into route_path(start_id, end_id, lat, lng) values ('".$start."','".$end."','".$lat."','".$lng."');") !== TRUE) {
                $Error = true;
                break;
            } 
        }
        //echo "XX'".$ind."','".$lat."','".$lng."','"."'SB');";
        
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
