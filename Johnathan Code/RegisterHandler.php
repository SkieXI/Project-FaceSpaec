<?php
require_once 'MyFunct.php';
/*FaceSpace
Ver 0.2 (2-16-17)
====
Joe Leon
Jonathan Couture
Xavier Villa
===
*/

//$conn = mysqli_connect('localhost','root','root','rleonbho_blogthing')
//or die('Error connecting to MySQL server.');
$first = $_POST["First"];
$last = $_POST["Last"];
$user = $_POST["User"];
$email = $_POST["Email"];
$password = $_POST["password"];

if($first == NULL || trim($first) == " ")
{
    exit("First Name is a required field");
}
if($last == NULL || trim($last) == " ")
{
    exit("Last Name is a required field");
}
if($user == NULL || trim($user) == " ")
{
    exit("Username is a required field");
}
//the code below checks if username is already taken.
/*if(checkUserExistance($user)){
    exit("Username is taken");
}*/
if($password == NULL || trim($password) == " ")
{
    exit("Password is a required field");
}
//function newRow returns true if successfuly add new row and returns false if it fails
if (newRow($first, $last, $user, $email, $password)) {
     include('LoginResponse.php');
     include('MainMenu.html');
} else {
     $message = "Error unable to connect to internet";
     include('RegisterFailed.php');
}
?>