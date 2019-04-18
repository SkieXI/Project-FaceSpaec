<?php
include ('Header.php');
require_once 'MyFunct.php';
/*FaceSpace
Ver 1.61 (3-9-17)
====
Joe Leon
Jonathan Couture
Xavier Villa
===
*/
$first = $_POST["First"];
$last = $_POST["Last"];
$user = $_POST["User"];
$email = $_POST["Email"];
$password = $_POST["password"];

//function newRow returns true if successfuly add new row and returns false if it fails
if ($message = (newRow($first, $last, $user, $email, $password))) {
        saveUserID($message);
        include ('Header.php'); ?>
        <html>
        <h2>Congratulations <?php echo " " . $user . ", " ?> registration successful  </h2>
        </html><?php
        include('Login.html');
    }
else {

    $message = error("username");
    include('RegisterFailed.php');
    }
?>