<?php
/*Ver 1.66 (3-19-17)
====
Joe Leon
Jonathan Couture
Xavier Villa
===
*/
include ('Header.php');
include_once 'MyFunct.php';
//Header is there to start a session.

$user = $_POST["User"];
$password = $_POST["Password"];
$AdminChk = $_POST["AdminChk"];

//This function fetch row that contains user and password. Returns a row if successful, otherwise returns an error
$message = getUser($user,$password);

//If Error: is part of $message, login failed
if(amIAnError($message)){
    require_once 'LoginFailed.php';
}
else{
    //save the userID
    saveUserID($message);
    require_once 'LoginResponse.php';

        include('Home.php');
}
?>

