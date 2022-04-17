<?php

// Connecting server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// posting the dish names
$dish_name = $_POST["dish_name"];

?>

<table>
  <tr><th>Restaurant Name</th><th>Units sold</th><th>Sales Generated</th></tr>

<?php 

// calling the procedure to show revenue
$sql_1 = "CALL dish_sold_revenue_per_restaurant('".$dish_name."')";
$result_1 = $conn->query($sql_1);
if ($result_1->num_rows > 0) {
  while($row = $result_1->fetch_assoc()) {
?>
  <tr><td><?php echo $row["restaurant_name"];?></td><td><?php echo $row["items_sold"];?></td><td><?php echo '$'.$row["total_sale"];?></td></tr>

<?php 

  }
}

mysqli_close($conn);

?>
</table>
