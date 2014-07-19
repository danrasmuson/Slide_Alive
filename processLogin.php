<html>
<head>
    <title>SlideAlive Account Activation</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <style>
        .roboto {
            font-family: 'Roboto', sans-serif;
            color: #ffffff;
        }

        .container {
            width: 40%;
            height: 10%;
            position: relative;
            left: 30%;
            top: 45%;
            text-align: center;
        }
    </style>
</head>
<body bgcolor="#1f4e78">
<img src="img/header.png" width="10%" height="7%" style="position: absolute">
<?php
$invalid = false;

$password = $_POST['password'];
if(isset($password) === false) {
    $password = "";
}
$requirements = array('@','.');
foreach($requirements as $requirement) {
    if(stristr($password,$requirement) === false) {
        invalidate();
    }
}
$mysql = mysqli_connect("127.0.0.1","root","5cT00sL4NbEpUgfxM5DJ","accounts");
if($mysql->query("INSERT INTO `login` (`email`,`password`) VALUES '".$_POST['email']."','".hash("sha512",$password)) === false) {
    echo '<div class="container">';
    echo '<h1 class="roboto">Account activation failed.</h1>';
    echo '<h2 class="roboto">This account already exists. Forgot your password?</h2>';
    echo '</div>';
}
function invalidate() {
    global $invalid;
    if($invalid) return;
    $invalid = true;
    echo '<div class="container">';
        echo '<h1 class="roboto">Account activation failed.</h1>';
        echo '<h2 class="roboto">Please check the values you entered and try again.</h2>';
    echo '</div>';
}
?>
</body>
</html>