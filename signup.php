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
	margin-top: 150px;
}

#login_form{
	margin-top: 50px;
}

input[type=text] {
  width: 100%;
  padding: 8px 5px;
  margin: 8px 0;
  box-sizing: border-box;
}

#pass{
  width: 100%;
  padding: 8px 5px;
  margin: 8px 0;
  box-sizing: border-box;
}

  
#submit_button {
  background-color: #CC3300;
  border: none;
  color: white;
  width: 100px;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
}


table, th, td {
  border: 0px solid black;
  margin-left: auto;
  margin-right: auto;
}

</style>

<body>

<img src="logo_new_2.png" alt="Girl in a jacket" width="630" height="220" id="logo">

<form action="signup_user_first_time.php" method="post" id="signup_form">

<table>
  <tr><td style="width: 100px;"><label for="username">Email  </label></td><td style="width: 300px;"><input type="text" id="email" name="email"></td></tr>
    <tr><td><label for="lname">Password</label></td><td><input type="password" id="password" name="password"></td></tr>
    <tr><td><label for="lname">First Name</label></td><td><input type="text" id="first_name" name="first_name"></td></tr>
    <tr><td><label for="lname">Last Name</label></td><td><input type="text" id="last_name" name="last_name"></td></tr>
    <tr><td><label for="lname">Address</label></td><td><input type="text" id="address" name="address"></td></tr>

</table>

<table>
  <tr><td><input type="submit" value="Signup" id="submit_button"></td></tr>
</table>

</form>


<p class="signup_text"><a href="home.php">Login Page</a></p>


</body>

</html>
