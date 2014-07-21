<html>
<head>
    <title>SlideAlive Account Activation</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='css/login/main.css' rel='stylesheet' type='text/css'>
</head>
<body>
<img src="img/header.png" class="header">
<?php
include('include/core.php');
include('include/login/response.php');
include('include/login/request.php');
include('include/login/result.php');

$mysql = databaseConnect();

$action = $_POST['action'];
$password = $_POST['password'];
$email = $_POST['email'];

$response = new loginResponse();
$request = new loginRequest();

if(validateEmail($email) === false) {
    $response->fail("Please check the values you entered for your email and try again.");
}

switch($action) {
    case "register":
        $loginResult = $request->registerNewUser($email, $password);
    break;
    case "login":
        $loginResult = $request->loginUser($email, $password);
    break;
    default:
        $response->fail("Invalid arguments specified.");
}

if($loginResult->succeeded) {
    $response->succeed();
} else {
    $response->fail($loginResult->failReason);
}
?>
</body>
</html>