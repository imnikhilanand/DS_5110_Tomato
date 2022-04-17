<?php

// Connecting server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// posting the restaurant name
$restaurant_name = $_POST["restaurant_name"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking if the connection is established or not
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// query to call the stored procedure for restaurant sales based on the restaurant name
$sql_2 = "CALL restaurant_sales('".$restaurant_name."')";

$result_2 = $conn->query($sql_2);

if ($result_2->num_rows > 0) {
  while($row = $result_2->fetch_assoc()) {
      echo $row["sum(rd.price)"];
  }
}

// closing the connection
mysqli_close($conn);

?>
