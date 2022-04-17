<?php

// starting the session
session_start();

// posting the order id
$order_id = $_POST['order_id'];

// Connecting server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// query to update the order status to ordered
$sql = "UPDATE `orders` SET `order_status`='ordered' WHERE `order_id`='".$order_id."'";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

// query to update the order status to processing
$sql2 = "UPDATE `ordered_items` SET `order_status`='processing', `ordered_time`=CURRENT_TIMESTAMP() WHERE `order_id`='".$order_id."'";

if ($conn->query($sql2) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}


?>