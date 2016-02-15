<?php
    require 'connect_sql.php';

    
    //$conn->query("insert into bluetooth(blue_id, lat, lon, direction) values ('1','2.4','4.3','SB')");
    $start = $_GET["start"];
    $end = $_GET["end"];
    $query = "SELECT address, description FROM route_pic where start_id=".$start." and end_id=".$end;

    if ($stmt = $conn->prepare($query)) {
        /* execute statement */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($add, $desc);

    /* fetch values */
    ?>
    <table width="240px">
    <?php
    $row = 0;
    while ($stmt->fetch()) {
        if (fmod($row, 2) == 0) {
            echo "<tr>";
        }
        ?>
    <td valign="top"; style="vertical-align:top">
    <!-- <input type="checkbox" name="picAdd[]" style="margin-top:20px;" value=<?php //echo "$add"; ?>> -->
    <a href=<?php echo "uploads/".$add; ?> 
        title="IMG" class="ref-img" target="view_window">
    <img src=<?php
        echo "uploads/".$add;//"http://localhost/tis/uploads/".$add;
        ?> width="210px" height="220px" />
    </a>
    <p><?php 
        echo $desc;
        ?>
    </p></td>
    
        <?php
        if(fmod($row, 2)==1) {
            echo "</tr>";
        }
        $row++;
      // printf ("uploads/%s", $add); //http://localhost/tis/
    }
    }
    $conn->close();
 ?>
</table>
 
