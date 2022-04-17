<?php 

// starting the session
session_start();

// unsetting the session variables

unset($_SESSION['user_id']);
unset($_SESSION['username']);

// redirecting to the home page
header('Location: home.php');

?>