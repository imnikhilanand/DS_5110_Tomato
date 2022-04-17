<?php

// starting the session
session_start();

// connecting to the server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

$conn = new mysqli($servername, $username, $password, $dbname);

// checking if the connection is established
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// checking if the deliver_user_id is set or not
if (isset($_SESSION['delivery_user_id'])){
// do noting  
}else{

  $delivery_email  = $_POST['username'];
  $delivery_pass =  $_POST['password'];

  // query to selecting the user id of delivery person
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

.picked_up,.delivered {
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

<img src="delivery_logo.png" alt="Girl in a jacket" width="315" height="110" id="logo">

<br><br>
<b style="color: red;font-size: 30px;">Pending Deliveries</b>
<br><br>

<table style="width:100%">
  <tr>
    <th><p id="user_name"><?php echo 'Hello '.$_SESSION['delivery_username'];?></p></th>
    <th><p id="delivery_available"><a href="delivery_available.php">Available Orders</a></p></th>
    
    <th><p id="logout"><a href="delivery_logout.php">Logout</a></p></th>
  </tr>
</table>


<table style="width:100%" style='border:1px'>
  <tr>
    <th>Order ID</th><th>Item</th><th>Photo</th><th>Restaurant</th><th>Delivery Address</th><th>Complete Actions</th>
  </tr>


<?php

// query to select those items which are yet not delivered
$sql_1 = "SELECT do_t.delivery_user_id, do_t.ordered_items_id, do_t.order_id, o.user_id , do_t.status as do_t_status, ot.order_status, r.name as restaurant_name, r.address as restaurant_address, d.dish_id, d.name as dish_name, d.photo, u.address as delivery_address 
FROM `delivery_order` do_t
inner join orders o on o.order_id = do_t.order_id 
inner join ordered_items ot on ot.order_id = o.order_id and ot.ordered_item_id = do_t.ordered_items_id
inner join restaurants r on r.restaurant_id = ot.restaurant_id
inner join dish d on d.dish_id = ot.dish_id
inner join users u on u.user_id = o.user_id
WHERE do_t.status != 'delivered' AND do_t.delivery_user_id = '".$_SESSION["delivery_user_id"]."'";

$result_1 = $conn->query($sql_1);

if ($result_1->num_rows > 0) {
  
  while($row = $result_1->fetch_assoc()) {
      $dish = $row["dish_name"];
      $order_id = $row['order_id'];
      $restaurant_name = $row["restaurant_name"];
      $restaurant_address = $row["restaurant_address"];
      $delivery_address = $row["delivery_address"];
      $photo = $row["photo"];
      $order_status = $row["do_t_status"];
      $ordered_items_id = $row["ordered_items_id"];
?>

  <tr>
    <th><?php echo $order_id;?></th><th><?php echo $dish;?></th><th><img src="<?php echo $photo;?>" style="width: 70px"></th><th><?php echo $restaurant_name.", ".$restaurant_address;?></th><th><?php echo $delivery_address;?></th>

    <th>

      <?php 

      if($order_status=="selected"){

    ?>

      <button class='picked_up' data-order-id='<?php echo $order_id;?>' data-ordered-items-id='<?php echo $ordered_items_id;?>'>Picked Up</button>


        <?php
}

if($order_status=="picked_up"){

        ?>

     <button class='delivered' data-order-id='<?php echo $order_id;?>' data-ordered-items-id='<?php echo $ordered_items_id;?>'>Delivered</button>



<?php
}
?>


    </th>
  

  </tr>


<?php
  }

} 


?>



</table>

<script>

// function to pickup the order
$(document).ready(function(){
    $('.picked_up').click(function(){
        var order_id = $(this).attr('data-order-id');
        var ordered_item_id = $(this).attr('data-ordered-items-id');
        var ajaxurl = 'picked_up.php',
          data =  {'order_id': order_id,'ordered_item_id':ordered_item_id};
            $.post(ajaxurl, data, function (response) {
               location.reload();
                 
          });
    });
});


// function to deliver the product
$(document).ready(function(){
    $('.delivered').click(function(){
        var order_id = $(this).attr('data-order-id');
        var ordered_item_id = $(this).attr('data-ordered-items-id');
        var ajaxurl = 'delivered.php',
          data =  {'order_id': order_id,'ordered_item_id':ordered_item_id};
            $.post(ajaxurl, data, function (response) {
               location.reload();
                 
          });
    });
});

</script>


</body>