<?php

// Start the session
session_start();

// Get the restaurant name from the code
$restaurant_name = $_GET["restaurant_name"];

// Connecting to the server
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

?>

<html>

<head>
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<style>

body{
	margin: 0 auto;
	text-align: center;
	}

#logo{
	margin-top: 20px;
}

#user_name{
}

#logout{
}

table{
  border: 0px solid black;
  table-layout: fixed;
  padding-left: 10%;
  padding-right: 10%;
  padding-bottom: 10px;
}

.order_button {
  background-color: #50C878;
  border: none;
  color: black;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 2px;
  cursor: pointer;
  border-radius: 8px;
  width: 120px;
}

a {
    color: black;
  }

  a:link {
  text-decoration: none;
  }


  a:hover {
    color: red;
  }
  
</style>

<body>

<img src="logo_new_2.png" alt="Girl in a jacket" width="315" height="110" id="logo">

<table style="width:100%">
  <tr>
    <th><p id="user_name"><?php echo 'Hello '.$_SESSION['username'];?></p></th>
    <th><p id="restaurant_search"><a href="restaurant_search.php">Restaurant Search</a></p></th>
    <th><p id="orders"><a href="orders.php">Orders</a></p></th>
    <th><p id="logout"><a href="logout.php">Logout</a></p></th>
  </tr>
</table>



<table style="width:100%">

<tr><th><p style="font-size: 40px; color: red"><?php echo $restaurant_name;?></p></th></tr>
  
<?php

// fetching data from restaurants_menu view
$sql_2 = "SELECT * from restaurant_menu rm where rm.restaurant_name = '".$restaurant_name."'";
$result_2 = $conn->query($sql_2);
if ($result_2->num_rows > 0) {
  while($row = $result_2->fetch_assoc()) {
?>

<tr>
    <th class="restaurant_name"><?php echo $row["name"]." • $".$row["price"];?></th>
</tr>

<tr>
    <th class="photo_dish"><img src="<?php echo $row["photo"]?>" width="350" height="350"></th>
</tr>

<tr>
	<th><button class="order_button" data-restaurant-id="<?php echo $row['restaurant_id'];?>" data-dish-id="<?php echo $row['dish_id'];?>">Add item</button></th>
</tr>

<?php

  }
} 

?>
</table>


<script>

// function to add items to cart
$(document).ready(function(){
    $('.order_button').click(function(){
        var restaurant_id = $(this).attr('data-restaurant-id');
        var dish_id = $(this).attr('data-dish-id');
        var ajaxurl = 'add_items.php',
          data =  {'restaurant_id': restaurant_id,'dish_id':dish_id};
            $.post(ajaxurl, data, function (response) {
              //alert('Added to Cart');
          });
    });
});

</script>

</body>

</html>





