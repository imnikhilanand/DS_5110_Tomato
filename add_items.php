<?php

// Start session
session_start();

// Post values
$restaurant_id = $_POST['restaurant_id'];
$dish_id = $_POST['dish_id'];

// Connecting server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// Creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Fetching all the orders in the cart
$sql_3 = "SELECT * FROM orders WHERE user_id = '".$_SESSION['user_id']."' AND order_status = 'in-cart'";
$result_3 = $conn->query($sql_3);
$curr_order_id = 0;
if ($result_3->num_rows > 0) {
  while($row = $result_3->fetch_assoc()) {
      $curr_order_id = $row["order_id"];
  }
} 

if($curr_order_id>0){
	// inserting data into ordered items table
	$sql_2 = "INSERT INTO `ordered_items`(`ordered_item_id`, `order_id`, `user_id`, `order_status`, `restaurant_id`, `dish_id`) VALUES ('NULL','".$curr_order_id."','".$_SESSION['user_id']."','in-cart','".$restaurant_id."','".$dish_id."')";
	  if ($conn->query($sql_2) === TRUE) {
	  	echo "Success";
	  }
}else{
	// inserting into orders table
	$sql = "INSERT INTO `orders`(`order_id`, `user_id`, `order_status`) VALUES ('NULL','".$_SESSION['user_id']."','in-cart')";
	if ($conn->query($sql) === TRUE){
		// fetching the last id to get the foreign key
	  $last_id = $conn->insert_id;
	  // inserting data into ordered items table
	  $sql_2 = "INSERT INTO `ordered_items`(`ordered_item_id`, `order_id`, `user_id`, `order_status`, `restaurant_id`, `dish_id`) VALUES ('NULL','".$last_id."','".$_SESSION['user_id']."','in-cart','".$restaurant_id."','".$dish_id."')";
	  if ($conn->query($sql_2) === TRUE) {
	  	echo "Success";
	  }
	} 
	else {
	  echo "Error: ".$conn->error;
	}
}

?>