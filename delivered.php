<?php

// starting the session
session_start();

// Getting the post data
$order_id = $_POST['order_id'];
$ordered_items_id = $_POST['ordered_item_id'];
$_SESSION['delivery_user_id'];

// connecting to the server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// connection
$conn = new mysqli($servername, $username, $password, $dbname);

// calling the sql procedure to change the status in delivery order and order status 
//$sql_2 = "CALL update_status_delivered(".$_SESSION['delivery_user_id'].", ".$order_id.", ". $ordered_items_id.");";
	
// checking if connection is established or not
//if ($conn->query($sql_2) === TRUE) {
//	echo "Success";
//}else{
//	echo "Error: ".$conn->error;
//}



$sql_2 = "UPDATE `delivery_order` SET `status`='delivered' WHERE `delivery_user_id` = '".$_SESSION['delivery_user_id']."' AND `order_id` = ".$order_id." AND `ordered_items_id` = ".$ordered_items_id."";
	  if ($conn->query($sql_2) === TRUE) {
	  	echo "Success";
	  }else{

	  	 echo "Error: ".$conn->error;

	  }


$sql_2 = "UPDATE `ordered_items` SET `order_status`='completed', `delivered_time`=CURRENT_TIMESTAMP() WHERE `order_id` = ".$order_id." AND `ordered_item_id` = ".$ordered_items_id."";
	  if ($conn->query($sql_2) === TRUE) {
	  	echo "Success";
	  }else{

	  	
	  	 echo "Error 2: ".$conn->error;

	  }





?>