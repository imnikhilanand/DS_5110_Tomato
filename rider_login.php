<html>

<head>
	
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

#submit_button {
  background-color: green;
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 8px;
  width: 100px;
}

table, th, td {
  border: 0px solid black;
  margin-left: auto;
  margin-right: auto;
}

#pass{
  width: 100%;
  padding: 8px 5px;
  margin: 8px 0;
  box-sizing: border-box;
}

</style>

<body>

<img src="delivery_logo.png" alt="Girl in a jacket" width="630" height="220" id="logo"/>

<h3>Delivery Partner Login</h3>

<form action="delivery_available.php" method="post">
<table>
  <tr><td style="width: 100px;"><label for="username">Email  </label></td><td style="width: 300px;"><input type="text" id="username" name="username"></td></tr>
    <tr><td><label for="lname">Password</label></td><td><input type="password" id="pass" name="password"></td></tr>
</table>
<table>
  <tr><td><input type="submit" value="Login" id="submit_button"></td></tr>
</table>

</form>

</body>

</html>
