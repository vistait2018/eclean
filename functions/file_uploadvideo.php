<?php
$allowedExts = array("mp4", "mov", "mpeg", "avi","3gp");
$temp = explode(".", strtolower($_FILES["file"]["name"]));
print $_FILES["file"]["name"];

print $extension  = end($temp);
$filename   = $_FILES["file"]["name"];
$tmp_name   = $_FILES["file"]["tmp_name"];
$type       = $_FILES["file"]["type"];
$size       = $_FILES["file"]["size"];

if ((($_FILES["file"]["type"] == "video/mp4")
	|| ($_FILES["file"]["type"] == "video/quicktime")
	|| ($_FILES["file"]["type"] == "video/mpeg")
	|| ($_FILES["file"]["type"] == "video/avi")
	|| ($_FILES["file"]["type"] == "video/3gp")
	|| ($_FILES["file"]["type"] == "video/3gpp")
	|| ($_FILES["file"]["type"] == "video/wmv")
	)
	&& ($_FILES["file"]["size"] < 20000000000)
	&& in_array($extension, $allowedExts)) {


    if ($_FILES["file"]["error"] > 0) {

    echo "Return Code: " .$filename . "<br>";

    } else {


        if($fid = Article::createMedia($_POST,$extension, $db)){
            extract($_POST);
            move_uploaded_file( $tmp_name, "../media/videos/" . $fid.'.'.$extension);
           echo'<div class="bg-green fg-white">';
           echo "Title: " . $_POST['title'] . "<br>";
           echo "Author: " .  $_POST['author'] . "<br>";
            echo "Upload: " .  $filename . "<br>";
            echo "Type: " . $type . "<br>";
            echo "Size: " . ceil($size / 1024) . " kB<br>";
            echo 'Video was uploaded successfully</div>';
        }
        else{
            echo '<div class="fg-red">Video was not uploaded successfully</div>';
        }
    }


} else {
    echo "Invalid file";
}

?>


