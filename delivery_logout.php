<?php 

// starting the session
session_start();

// unset the delivery partner details
unset($_SESSION['delivery_user_id']);
unset($_SESSION['delivery_username']);

// redirecting the user to the homepage
header('Location: rider_login.php');

?>