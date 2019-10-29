<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);

 $extension  = end($temp);
$filename   = $_FILES["file"]["name"];
$tmp_name   = $_FILES["file"]["tmp_name"];
$type       = $_FILES["file"]["type"];
$size       = $_FILES["file"]["size"];

if ((($type == "image/gif")
    || ($type == "image/jpeg")
    || ($type == "image/jpg")
    || ($type == "image/pjpeg")
    || ($type == "image/x-png")
    || ($type == "image/png"))
    && ($size < 8000000)
    && in_array($extension, $allowedExts)) {

    

    if ($_FILES["file"]["error"] > 0) {

    echo "Return Code: " .$filename . "<br>";
    
    } else {

    
        if($fid = Media::Update($_POST, $extension , $_GET['mid'], $db)){
           
            move_uploaded_file( $tmp_name, "../media/images/" . $_GET['mid'].'.'.$extension);
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


