<?php 

// starting the session
session_start();

// posting the data
$order_id = $_POST["order_id"];
$order_item_id = $_POST["order_item_id"];

// Connecting server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

echo $sql_1 = "SELECT * FROM `ordered_items` WHERE `ordered_item_id`='".$order_id."' AND `order_id` = '".$order_item_id."'";

$result_1 = $conn->query($sql_1);

if ($result_1->num_rows > 1) {
  
	$sql = "DELETE FROM `ordered_items` WHERE `ordered_item_id`='".$order_item_id."' AND `order_id` = '".$order_id."'";
	if ($conn->query($sql) === TRUE) {
	  echo "Record deleted successfully";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}  

}else{

	$sql = "DELETE FROM `ordered_items` WHERE `ordered_item_id`='".$order_item_id."' AND `order_id` = '".$order_id."'";
	if ($conn->query($sql) === TRUE) {
	  echo "Record deleted successfully";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}

	$sql = "DELETE FROM `orders` WHERE `order_id` = '".$order_id."'";
	if ($conn->query($sql) === TRUE) {
	  echo "Record deleted successfully";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}
	

}


?>