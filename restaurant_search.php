<?php

// Start session
session_start();

// Connecting to the server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Getting the username and password from the previous page
if (isset($_SESSION['username'])){
  // do nothing  
}else{
  // post email and username
  $email  = $_POST['username'];
  $user_pass =  $_POST['password'];

  // fetch the user_id
  $sql_1 = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$user_pass."'";

  $result_1 = $conn->query($sql_1);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


  if ($result_1->num_rows > 0) {
    while($row = $result_1->fetch_assoc()) {
        $_SESSION['user_id'] = $row["user_id"];
        $_SESSION['username'] = $row["first_name"];
    }
  } 
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

  table, th, td {
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
    <th><p id="orders"><a href="orders.php">Orders</a></p></th>
    <th><p id="logout"><a href="logout.php">Logout</a></p></th>
  </tr>
</table>



<table style="width:100%">
  
<?php

// fetch the restaurant and dishes
$sql_2 = "SELECT * from restaurant_dish_search";
$result_2 = $conn->query($sql_2);
if ($result_2->num_rows > 0) {
  while($row = $result_2->fetch_assoc()) {

?>

<tr>  
    <th class="restaurant_name"><a href="dish_details.php?dish_name=<?php echo $row['dish_name'];?>"> <?php echo $row["dish_name"]." • ";?></a> <a href="restaurant_details.php?restaurant_name=<?php echo $row['restaurant_name'];?>"><?php echo $row["restaurant_name"]." • "; ?></a> <?php echo $row["address"];?></th>
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

// to add items to the cart

$(document).ready(function(){
    $('.order_button').click(function(){
        var restaurant_id = $(this).attr('data-restaurant-id');
        var dish_id = $(this).attr('data-dish-id');
        var ajaxurl = 'add_items.php',
        data =  {'restaurant_id': restaurant_id,'dish_id':dish_id};
            $.post(ajaxurl, data, function (response) {
              alert('Added to Cart');
          });
    });
});

</script>

</body>

</html>
