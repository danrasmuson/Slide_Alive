<?php
include('../include/core.php');
include('../include/login/response.php');
include('../include/login/request.php');
include('../include/login/result.php');

$mysql = databaseConnect();

$action = $_GET['action'];
$password = $_POST['password'];
$email = $_POST['email'];

$response = new loginResponse();
$request = new loginRequest();

if(validateEmail($email) === false) {
    $response->fail("Please check the values you entered for your email and try again.");
}

switch($action) {
    case "register":
        $loginResult = $request->registerNewUser($mysql, $email, $password);
        break;
    case "login":
        $loginResult = $request->loginUser($mysql, $email, $password);
        break;
    default:
        $response->fail("Invalid arguments specified.");
}

if($loginResult->succeeded) {
    $response->succeed();
} else {
    $response->fail($loginResult->failReason);
}