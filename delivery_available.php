<?php

// starting the session
session_start();

// connecting to the server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

$conn = new mysqli($servername, $username, $password, $dbname);

// checking if the connection is established or not
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


// check if delivery user id is present or not
if (isset($_SESSION['delivery_user_id'])){

  // do noting  
  
}else{

// posting the delivery user credentials
$delivery_email  = $_POST['username'];
$delivery_pass =  $_POST['password'];

// query to extract delivery partner user_id 
$sql_1 = "SELECT * FROM delivery_partner WHERE email = '".$delivery_email."' AND password = '".$delivery_pass."'";
$result_1 = $conn->query($sql_1);

if ($result_1->num_rows > 0) {
  while($row = $result_1->fetch_assoc()) {
      $_SESSION['delivery_user_id'] = $row["delivery_user_id"];
      $_SESSION['delivery_username'] = $row["first_name"];

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

table{
  border: 0px solid black;
  table-layout: fixed;
  padding-left: 10%;
  padding-right: 10%;
  padding-bottom: 10px;
  text-align: center;
  vertical-align: middle;
  table-layout:fixed;
}

th{
  border: 0px solid black;
}

.select-button{
  background-color: #50C878;
  border: none;
  color: black;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 2px;
  cursor: pointer;
  border-radius: 8px;
  width: 80px;
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

<img src="delivery_logo.png" alt="Girl in a jacket" width="315" height="110" id="logo">

<br><br>
<b style="color: red;font-size: 30px;">Available Orders</b>
<br><br>

<table style="width:100%">
  <tr>
    <th><p id="user_name"><?php echo 'Hello '.$_SESSION['delivery_username'];?></p></th>
    <th><p id="logout"><a href="to_deliver.php">Pending deliveries</a></p></th>
    <th><p id="logout"><a href="delivery_logout.php">Logout</a></p></th>
  </tr>
</table>


<table style="width:100%" style='border:1px'>
  <tr>
    <th>Order ID</th><th>Order Item ID</th><th>Item</th><th>Photo</th><th>Restaurants</th><th>Delivery Address</th><th>Order Status</th>
  </tr>


<?php

// query to finc the orders that are yet to be delivered
$sql_1 = "select o.order_id, o.order_status , r.name as restaurant_name, r.address as restaurant_address, d.dish_id, d.photo, d.name as dish_name, ot.ordered_item_id, do_t.delivery_user_id, u.address as delivery_address
from orders o 
left join ordered_items ot on ot.order_id = o.order_id 
left join restaurants r on r.restaurant_id = ot.restaurant_id 
left join dish d on d.dish_id = ot.dish_id
left join delivery_order do_t on do_t.order_id = o.order_id and do_t.ordered_items_id = ot.ordered_item_id
left join users u on u.user_id = o.user_id
where o.order_status != 'in-cart' and delivery_user_id is null";

$result_1 = $conn->query($sql_1);

if ($result_1->num_rows > 0) {
  
  while($row = $result_1->fetch_assoc()) {
      $dish = $row["dish_name"];
      $order_id = $row['order_id'];
      $ordered_item_id = $row['ordered_item_id'];
      $restaurant_name = $row["restaurant_name"];
      $restaurant_address = $row["restaurant_address"];
      $delivery_address = $row["delivery_address"];
      $photo = $row["photo"];
      $order_status = $row["order_status"];
      
?>

  <tr>
    <th><?php echo $order_id;?></th><th><?php echo $ordered_item_id;?></th><th><?php echo $dish;?></th><th><img src="<?php echo $photo;?>" style="width: 70px"></th><th><?php echo $restaurant_name.", ".$restaurant_address;?></th><th><?php echo $delivery_address;?></th><th><button class='select-button' data-order-id='<?php echo $order_id;?>' data-order-item-id='<?php echo $ordered_item_id;?>'>SELECT</button></th>
  </tr>


<?php
  
  }
} 

?>

</table>

<script>

// function to select order for delivery
$(document).ready(function(){
    $('.select-button').click(function(){
        var order_id = $(this).attr('data-order-id');
        var ordered_item_id = $(this).attr('data-order-item-id');
        var ajaxurl = 'select_order.php',
          data =  {'order_id': order_id,'ordered_item_id':ordered_item_id};
            $.post(ajaxurl, data, function (response) {
              location.reload();
          });
    });
});
</script>


</body>