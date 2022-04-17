<?php

// post user details
$email = $_POST["email"];
$user_password = $_POST["password"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$address = $_POST["address"];

// server credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// connecting to the server
$conn = new mysqli($servername, $username, $password, $dbname);

// query to insert the users data in the system

$sql_2 = "INSERT INTO `users`(`user_id`, `email`, `password`, `first_name`, `last_name`, `address`) VALUES ('NULL','".$email."','".$user_password."','".$first_name."','".$last_name."','".$address."')";
if ($conn->query($sql_2) === TRUE) {

// redirecting to the home page
header('Location: home.php');

}else{
	echo "Error: ".$conn->error;
}


?>