<html>
<head>
    <title>SlideAlive Account Activation</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='css/login/main.css' rel='stylesheet' type='text/css'>
</head>
<body>
<h3>Login</h3>
<form name="login" action="forms/login.php?action=login" method="post">
    Email Address: <input type="email" name="email">
    Password: <input type="password" name="password">
    <input type="submit" value="Submit">
</form>
<br>
<h3>Register</h3>
<form name="login" action="forms/login.php?action=register" method="post">
    Email Address: <input type="email" name="email">
    Password: <input type="password" name="password">
    <input type="submit" value="Submit">
</form>
<br>
<p>Note: Should be confirmation on password, client-side. Express purpose is for testing, should be replaced with something better. Remember that the login info to the database is in the github repo publicly, so accounts might get wiped at any time.</p>
</body>
</html>