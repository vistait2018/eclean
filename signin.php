<?php

var_dump($_POST);
$servername = "localhost";
$username = "root";
$password = "dorc";
$dbname = "eclean";



// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if($_POST){
    //var_dump($_POST);
$email = $_POST['email'];
$password =$_POST['password'];
$created_at =  date("Y-m-d h:i:s");
$updated_at =  date("Y-m-d h:i:s");

$sql = "INSERT INTO user (email,pass,created_at,updated_at)
VALUES ($email, $password,$created_at,$updated_at)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
//echo "Connected successfully";
?>