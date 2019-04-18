<?php
/*Version 0.75 (2/19/2017)
//This is a very experimental page that is designed to bypass a redirect based on the results of a connection check.
//Due to the nature of php pages, there is a html page nested inside this page to run when the all login requirements
//are met.
====
Joe Leon
Jonathan Couture
Xavier Villa
===
*/
include_once 'MyFunct.php';
include ('Header.php');
//Header is there to start a session.

$user = $_POST["User"];
$password = $_POST["Password"];

//This function fetch row that contains user and password. Returns a row if successful, otherwise returns an error
$message = getUser($user,$password);

//If Error: is part of $message, login failed
if(contains("Error:", $message)){
    require_once 'LoginFailed.php';
}
else{
    //save the userID
    saveUserID($message);
    require_once 'LoginResponse.php';
}
?>

