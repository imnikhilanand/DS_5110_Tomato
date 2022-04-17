<?php

// starting the session
session_start();

// posting the order data 
$order_id = $_POST['order_id'];
$ordered_items_id = $_POST['ordered_item_id'];
$_SESSION['delivery_user_id'];

// establishing the connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

$conn = new mysqli($servername, $username, $password, $dbname);

// query to insert the data in delivery order on selecting the order for delivery by the delivery partner
$sql_2 = "INSERT INTO `delivery_order`(`delivery_user_id`, `order_id`, `ordered_items_id`, `status`) VALUES ('".$_SESSION['delivery_user_id']."','".$order_id."','".$ordered_items_id."','selected')";
if ($conn->query($sql_2) === TRUE) {
	echo "Success";
}else{
	echo "Error: ".$conn->error;
}

?>