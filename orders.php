<?php

// start session
session_start();

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

table{
  border: 0px solid black;
  table-layout: fixed;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10%;
  padding-right: 10%;
  text-align: center;
  vertical-align: middle;
  table-layout:fixed;
}

th{
  border: 1 px solid #cccccc;
  background-color: #cccccc;
}

td{
  border: 1px solid #f2f2f2;
  background-color: #f2f2f2;
  border-radius: 10px;
}

tr{
  border: 10px solid black;
}

.checkout {
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


.delete_order{
  background-color: red;
  color: white;
  border: none;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  margin: 2px 2px;
  cursor: pointer;
  border-radius: 8px;
  width: 80px;
}


.order_button {
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
    width: 100px;
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

<table style="width:100%; 0px solid white ">
  <tr >
    <th style="background-color: #ffffff"><p id="user_name"><?php echo 'Hello '.$_SESSION['username'];?></p></th>
    <th style="background-color: #ffffff"><p id="restaurant_search"><a href="restaurant_search.php">Restaurant Search</a></p></th>
    <th style="background-color: #ffffff"><p id="logout"><a href="logout.php">Logout</a></p></th>
  </tr>
</table>


<br><br>
<b style="color: black;font-size: 30px;">Items in Cart</b>
<br><br>


<table style="width:100%" style='border:1px'>
  <tr>
    <th>Item</th><th>Photo</th><th>Restaurants</th><th>Order Status</th><th>Price</th><th>Delete</th>
  </tr>


<?php

// data currently in the cart
$sql_1 = "SELECT ot.ordered_item_id,ot.order_id, ot.order_status, ot.restaurant_id, ot.dish_id, r.name as restaurant_name, r.address, d.name as dish_name,d.photo , rd.price FROM ordered_items ot left join restaurants r on r.restaurant_id = ot.restaurant_id left join dish d on d.dish_id = ot.dish_id left join restaurants_dishes rd on rd.restaurant_id = ot.restaurant_id and rd.dish_id = ot.dish_id WHERE ot.order_status = 'in-cart' AND ot.user_id = '".$_SESSION['user_id']."' ";

$result_1 = $conn->query($sql_1);

if ($result_1->num_rows > 0) {
  
  while($row = $result_1->fetch_assoc()) {
      $dish = $row["dish_name"];
      $order_id = $row['order_id'];
      $restaurant_name = $row["restaurant_name"];
      $photo = $row["photo"];
      $order_status = $row["order_status"];
      $price = $row["price"];
      $order_item_id = $row["ordered_item_id"];
      $dish_id_last = $row["dish_id"];
  
?>

  <tr>
    <td><?php echo $dish;?></td><td><img src="<?php echo $photo;?>" style="width: 70px"></td><td><?php echo $restaurant_name;?></td><td><?php echo $order_status;?></td><td><?php echo '$'.$price;?></td><td><button class="delete_order" data-order-id="<?php echo $order_id;?>" data-order-item-id="<?php echo $order_item_id;?>">Delete</button></td>
  </tr>


<?php

  }
} 

?>

</table>




<br><br>
<b style="color: black;font-size: 30px;">Recommended</b>
<br><br>


<table style="width:100%" style='border:1px'>
  <tr>
    <th>Item</th><th>Photo</th><th>Restaurants</th><th>Price</th><th>Add</th>
  </tr>


<?php

// data currently in the cart

if (isset($dish_id_last)){


$sql_10 = "

select t3.dish_2_id, r.name as restaurant_name, r.restaurant_id as restaurant_id, d.name as dish_name, d.photo as photo, rd.price
from
(select t2.dish_name_2, t2.dish_2_id, count(t2.dish_name_2)
from
(select t1.*, d.dish_id as dish_2_id, d.name as dish_name_2
from
(select ot.ordered_item_id, ot.dish_id, ot.order_id, d.name as dish_name
from ordered_items ot 
inner join dish d on d.dish_id = ot.dish_id
where ot.order_status = 'completed' and d.dish_id = ".$dish_id_last."
)t1
inner join ordered_items ot on ot.order_id = t1.order_id and ot.dish_id != ".$dish_id_last."
inner join dish d on d.dish_id = ot.dish_id
)t2
group by 1
order by 3 DESC 
limit 3)t3
inner join dish d on d.dish_id = t3.dish_2_id
inner join restaurants_dishes rd on rd.dish_id = t3.dish_2_id
inner join restaurants r on r.restaurant_id = rd.restaurant_id



";

$result_10 = $conn->query($sql_10);

if ($result_10->num_rows > 0) {
  
  while($row = $result_10->fetch_assoc()) {
      $dish = $row["dish_name"];
      $dish_id = $row["dish_2_id"];
      $restaurant_id = $row["restaurant_id"];
      $restaurant_name = $row["restaurant_name"];
      $photo = $row["photo"];
      $price = $row["price"];      
  
?>

  <tr>
    <td><?php echo $dish;?></td><td><img src="<?php echo $photo;?>" style="width: 70px"></td><td><?php echo $restaurant_name;?></td><td><?php echo '$'.$price;?></td><td><button class="order_button" data-dish-id="<?php echo $dish_id;?>" data-restaurant-id="<?php echo $restaurant_id;?>">Add Item</button></td>
  </tr>


<?php
}


  }
} 

?>

</table>













<?php

if (isset($order_status)){
  
  
if($order_status=='in-cart'){

// query to calculate the price of items currently in the cart

$sql_2 = "SELECT ot.order_id,  sum(rd.price) as total_price
FROM ordered_items ot 
left join restaurants r on r.restaurant_id = ot.restaurant_id 
left join dish d on d.dish_id = ot.dish_id 
left join restaurants_dishes rd on rd.restaurant_id = ot.restaurant_id and rd.dish_id = ot.dish_id 
WHERE ot.order_status = 'in-cart' AND ot.user_id = '".$_SESSION['user_id']."' ";

$result_2 = $conn->query($sql_2);

if ($result_2->num_rows > 0) {
  
  while($row = $result_2->fetch_assoc()) {
      $total_price = $row["total_price"];
  }

}


?>

<p style="font-size: 20px;">Total Price: <b><?php echo '$'.$total_price;?></b></p>
<button class='checkout' data-order-id='<?php echo $order_id?>;'>Checkout</button>

<?php
}

}

?>

<script>

// function to perform checkout
$(document).ready(function(){
    $('.checkout').click(function(){
        var order_id = $(this).attr('data-order-id');
        var ajaxurl = 'ordered_by_user.php',
          data =  {'order_id': order_id};
            $.post(ajaxurl, data, function (response) {
              alert("Ordered");
              location.reload();
          });
    });
});


// function to perform checkout
$(document).ready(function(){
    $('.delete_order').click(function(){
        var order_id = $(this).attr('data-order-id');
        var order_item_id = $(this).attr('data-order-item-id');
        var ajaxurl = 'delete_order.php',
          data =  {'order_id': order_id,'order_item_id':order_item_id};
            $.post(ajaxurl, data, function (response) {
              alert('Item Removed from Cart');
              location.reload();
          });
    });
});


$(document).ready(function(){
    $('.order_button').click(function(){
        var restaurant_id = $(this).attr('data-restaurant-id');
        var dish_id = $(this).attr('data-dish-id');
        var ajaxurl = 'add_items.php',
        data =  {'restaurant_id': restaurant_id,'dish_id':dish_id};
            $.post(ajaxurl, data, function (response) {
              alert('Added to Cart');
              location.reload();
          });
    });
});



</script>


</script>


<br><br>
<b style="color: black;font-size: 30px;">Previous Orders</b>
<br><br>


<table style="width:100%" style='border:1px'>
  <tr>
    <th>Item</th><th>Photo</th><th>Restaurants</th><th>Order Status</th><th>Price</th>
  </tr>


<?php

// query to finc previous orders

$sql_1 = "SELECT ot.ordered_item_id,ot.order_id, ot.order_status, ot.restaurant_id, ot.dish_id, r.name as restaurant_name, r.address, d.name as dish_name,d.photo , rd.price FROM ordered_items ot left join restaurants r on r.restaurant_id = ot.restaurant_id left join dish d on d.dish_id = ot.dish_id left join restaurants_dishes rd on rd.restaurant_id = ot.restaurant_id and rd.dish_id = ot.dish_id WHERE ot.order_status != 'in-cart' AND ot.user_id = '".$_SESSION['user_id']."' order by 1 desc";

$result_1 = $conn->query($sql_1);

if ($result_1->num_rows > 0) {
  
  while($row = $result_1->fetch_assoc()) {
      $dish = $row["dish_name"];
      $order_id = $row['order_id'];
      $restaurant_name = $row["restaurant_name"];
      $photo = $row["photo"];
      $order_status = $row["order_status"];
      $price = $row["price"];
  
?>


  <tr>
    <td><?php echo $dish;?></td><td><img src="<?php echo $photo;?>" style="width: 70px"></td><td><?php echo $restaurant_name;?></td><td><?php echo $order_status;?></td><td><?php echo '$'.$price;?></td>
  </tr>


<?php
  
  }
} 

?>

</table>

<br><br>

</body>
</html>







