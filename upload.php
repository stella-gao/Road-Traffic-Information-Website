
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
require 'connect_sql.php';

$target_dir = "uploads/";
$temp_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($temp_file,PATHINFO_EXTENSION);
$date = new DateTime();
$time = $date->getTimestamp();
$target_file = $target_dir.$time.'.'.$imageFileType;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }
}
//echo $target_file;
// Check if file already exists
if (file_exists($target_file)) {
    // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// echo $_FILES["fileToUpload"]["size"];
// Check file size
//if ($_FILES["fileToUpload"]["size"] > 500000) {
//    echo "Sorry, your file is too large.";
//    $uploadOk = 0;
//}
// Allow certain file formats
//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//&& $imageFileType != "gif" ) {
if($imageFileType != "csv" && $imageFileType != "xlsx" && $imageFileType != "xls") {
    // echo "Sorry, only CSV, XLS, XLSL files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	// echo $target_file;
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$start = $_POST["start"];
$end = $_POST["end"];
$address = $time.'.'.$imageFileType;
$desc = $_POST["description"];


// $query = "delete FROM route_pic where start_id='".$start."' and end_id='".$end."'";

// if ($conn->query($query)===TRUE) {
    if ($conn->query("insert into route_pic(start_id, end_id, address, description) values ('".$start."','".$end."','".$address."','".$desc."');") === TRUE) {
    // printf("Insert successfully.\n");
?>
       <img src= <?php
        echo "uploads/".$address;
        ?> 
		width="220px" height="220px"
        />
        <p><?php 
            echo $desc;
            ?>
        </p>
<?php
    } else {
        // echo "insert into route_pic(start_id, end_id, address, description) values ('".$start."','".$end."','".$address."','".$desc."');";
        echo "Not insert";
    }
// }


?>
</body>
</html>
