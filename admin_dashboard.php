<?php

// Connecting to the server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tomato";

// Creating the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking connection
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
  text-align: center;
}

table{
  border: 1px solid black;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
  
}

th{
  border: 1px solid;
  background-color: #b3e0ff;
}

td{
  border: 1px solid black;
  background-color: #ffffff; 
}

tr{
  border: 1px solid black;
   
}


</style>

<body>

<br>

<img src="logo_new_2.png" alt="Tomato" width="315" height="110" id="logo">

<p style="font-size: 30px;">ADMIN DASHBOARD</p>

<p style="font-size: 20px;">Dishes Sale per Restaurant</p>

<table style="all:unset">
<tr style="all:unset">
<td style="all:unset"><input type="text" id="dish_name" name="dish_name"></td><td style="all:unset"><button class="dish_search_button" >Search Dish</button></td> 
</tr>
</table>

<p class="result_dish"></p>

<script>

$(document).ready(function(){
    $('.dish_search_button').click(function(){
        var temp = $('#dish_name').val();
        var ajaxurl = 'dish_sold_per_restaurant.php',
        data =  {'dish_name': temp};
            $.post(ajaxurl,data,function (response) {
              $(".result_dish").html(response);
          });


    });
});

</script>


<p style="font-size: 20px;">Restaurant Sales</p>


<table style="all:unset">
<tr>
<td style="all:unset"><input type="text" id="restaurant_name" name="restaurant_name"></td><td style="all:unset"><button class="search_button" >Search Sales</button></td> 

</tr>
</table>
<p class="restaurant_sales"></p></td>

<script>

$(document).ready(function(){
    $('.search_button').click(function(){
        var temp = $('#restaurant_name').val();
        var ajaxurl = 'sales_per_restaurant.php',
        data =  {'restaurant_name': temp};
            $.post(ajaxurl, data, function (response) {
              $(".restaurant_sales").text('$'+response);
          });


    });
});

</script>



<p style="font-size: 20px;">Popular Cuisines and Dishes based on Sales</p>

<table>
  <tr><th>Cuisine</th><th>Dish</th><th>Items Ordered</th><th>Sales Generated</th></tr>


<?php 

$sql_1 = "CALL popular_cuisines_dish()";

$result_1 = $conn->query($sql_1);

if ($result_1->num_rows > 0) {

  while($row = $result_1->fetch_assoc()) {
?>


  <tr><td><?php echo $row["cuisine_name"];?></td><td><?php echo $row["dish_name"];?></td><td><?php echo $row["items_ordered"];?></td><td><?php echo '$'.$row["sales"];?></td></tr>

<?php 

  }

}

mysqli_close($conn);

?>


</table>


<p style="font-size: 20px;">Most frequent users and their purchase</p>

<table>
  <tr><th>User ID</th><th>Email</th><th>Items Ordered</th><th>Sales Generated</th></tr>


<?php 

$conn = new mysqli($servername, $username, $password, $dbname);

$sql_2 = "CALL customer_previous_orders()";

$result_2 = $conn->query($sql_2);

if (!$result_2) {
    trigger_error('Invalid query: ' . $conn->error);
}

if ($result_2->num_rows > 0) {

  while($row2 = $result_2->fetch_assoc()) {
?>


  <tr><td><?php echo $row2["user_id"];?></td><td><?php echo $row2["email"];?></td><td><?php echo $row2["num_of_items_orders"];?></td><td><?php echo '$'.$row2["total_sales"];?></td></tr>

<?php 

  }

}

mysqli_close($conn);

?>


</table>



</table>


<p style="font-size: 20px;">Delivery Partner Stats</p>

<table>
  <tr><th>Delivery Partner ID</th><th>Name</th><th>Orders Delivered</th><th>Sales Completed</th></tr>


<?php 

$conn = new mysqli($servername, $username, $password, $dbname);

$sql_3 = "CALL sales_by_delivery_partner()";

$result_3 = $conn->query($sql_3);

if (!$result_3) {
    trigger_error('Invalid query: ' . $conn->error);
}

if ($result_3->num_rows > 0) {

  while($row3 = $result_3->fetch_assoc()) {
?>


  <tr><td><?php echo $row3["delivery_user_id"];?></td><td><?php echo $row3["first_name"];?></td><td><?php echo $row3["orders_delivered"];?></td><td><?php echo '$'.$row3["sales_completed"];?></td></tr>

<?php 

  }

}

mysqli_close($conn);

?>


</table>
<br><br>


<br><br><br><br><br><br>


</body>



</html>