<?php

/* Ver 2.001 (4-6-17)
====
Joe Leon
Jonathan Couture
Xavier Villa

===
*/
include 'Header.php';
require_once 'MyFunct.php';

$Comment = $_POST["Comment"];
$PostID = $_GET["id"];
$userId = getUSERID();

$message = newComment($Comment, $PostID, $userId );

if (!amIAnError($message)) {
    include ('Header.php'); ?>
    <html>
    <h2>Post Successful. </h2>
    </html><?php include ("PastHandler.php");
}
else {
    include('PosterFailed.php');
}


?>