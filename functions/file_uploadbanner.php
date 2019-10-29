<?php
 //var_dump($_POST);
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
    && ($size < 80000000)
    && in_array($extension, $allowedExts)) {

    

    if ($_FILES["file"]["error"] > 0) {

    echo '<div class="error">An error occur. File may be too large</div>';
    
    } else {

    
        if($fid = Media::createBanner($_POST,$extension, $db)){
           
        	move_uploaded_file( $tmp_name, "../images/" .'banner'. $fid.'.'.$extension);
			echo'<div class="success">';
			echo 'Banner was uploaded successfully <br>';
            echo "Upload: " .  $filename . "<br>";
            echo "Size: " . ceil($size / 1024) . " kB</div>";
        }
        else{
            echo '<div class="fg-red">Banner was not uploaded </div>';
        }
    }
        
    
} else {
    echo "Invalid file";
}

?>


