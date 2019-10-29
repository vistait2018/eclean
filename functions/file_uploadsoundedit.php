<?php
$allowedExts = array("mp3", "wma", "mov", "aac");
$temp = explode(".", $_FILES["file"]["name"]);

 $extension  = end($temp);
$filename   = $_FILES["file"]["name"];
$tmp_name   = $_FILES["file"]["tmp_name"];
$type       = $_FILES["file"]["type"];
$size       = $_FILES["file"]["size"];

 if ((($_FILES["file"]["type"] == "audio/mp3")
|| ($_FILES["file"]["type"] == "audio/wma")
|| ($_FILES["file"]["type"] == "audio/mov")
|| ($_FILES["file"]["type"] == "audio/aac")
|| ($_FILES["file"]["type"] == "audio/mpeg"))
&& ($_FILES["file"]["size"] < 20000000000)
&& in_array($extension, $allowedExts)) {



    if ($_FILES["file"]["error"] > 0) {

    echo "Return Code: " .$filename . "<br>";

    } else {


        if($fid = Media::Update($_POST, $extension , $_GET['mid'], $db)){

            move_uploaded_file( $tmp_name, "../media/sound/" . $_GET['mid'].'.'.$extension);
           echo'<div class="bg-green fg-white">';
           echo "Title: " . $_POST['title'] . "<br>";
           echo "Author: " .  $_POST['author'] . "<br>";
            echo "Upload: " .  $filename . "<br>";
            echo "Type: " . $type . "<br>";
            echo "Size: " . ceil($size / 1024) . " kB<br>";
            echo 'Image was uploaded successfully</div>';
        }
        else{
            echo '<div class="fg-red">Image was not uploaded successfully</div>';
        }
    }


} else {
    echo "Invalid file";
}

?>


