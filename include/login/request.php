<?php
/*
* SlideAlive - Automatic Presentation Generation Software
* --------------
* login/request.php - Processes login and registration requests.
* Created by William Teder using PHPstorm on 7/21/14 at 9:19 AM.
*/

class loginRequest {
    public function __construct() {

    }

    public function registerNewUser($mysql, $email, $password) {
        $esc_email = databaseEscapeString($email);
        $esc_pass = databaseEscapeString($password);

        $hash = hash("sha512",$esc_pass);
        $result = new loginResult();
        $result->type = 'register';

        if($mysql->query("INSERT INTO `login` (`email`,`password`) VALUES '".$esc_email."','".$hash."'") === false) {
            $result->succeeded = false;
            $result->failReason = "An account with that email already exists on file.";
        } else {
            $result->succeeded = true;
        }

        return $result;
    }

    public function loginUser($mysql, $email, $password) {
        $esc_email = databaseEscapeString($email);
        $esc_pass = databaseEscapeString($password);

        $hash = hash("sha512",$esc_pass);
        $result = new loginResult();
        $result->type = 'login';

        $query = $mysql->query("SELECT `hash` FROM `login` WHERE `email` = '".$esc_email."'");

        if($query === false) {
            $result->succeeded = false;
            $result->failReason = "That account doesn't exist. Would you like to register it instead?";
        } else {
            $query_result = $mysql->fetch_result(MYSQLI_ASSOC);
            if($hash === $query_result) {
                $result->succeeded = true;
            } else {
                $result->succeeded = false;
                $result->failReason = "That's not the right password for this account. Please try again.";
            }
        }

        return $result;
    }
}