<?php
/*
 * SlideAlive - Automatic Presentation Generation Software
 * --------------
 * core.php - Functions useful among multiple pieces of code or that make sense to split off.
 * Created by William Teder using PHPstorm on 7/21/14 at 9:16 AM.
 */

function validateEmail($email) {
    $requirements = array('@','.');
    foreach($requirements as $requirement) {
        if(stristr($email,$requirement) === false) {
            return false;
        }
    }

    return true;
}

function databaseConnect() {
    $return = mysqli_connect("127.0.0.1","root","5cT00sL4NbEpUgfxM5DJ","accounts");
    return $return;
}

function databaseEscapeString($string) {
    global $mysql;

    if($mysql->ping()) {
        $result = $mysql->real_escape_string($string);
        return $result;
    } else {
        throw new Exception("Couldn't connect to the database, please check the connection.");
    }
}