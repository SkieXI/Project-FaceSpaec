<?php

/* Ver 1.66 (3-16-17)
====
Joe Leon
Jonathan Couture
Xavier Villa

===*/
include 'Header.php';
require_once 'MyFunct.php';

$Head = $_POST["Heading"];
$Body = $_POST{"Body"};
$userId = getUSERID();


$message= newPost($Head, $Body, $userId );

if (!amIAnError($message)) {
    include ('Header.php'); ?>
    <html>
<h2>Post Successful. </h2>
    </html><?php
    include('Home.php');
}
else {
    include('PosterFailed.php');
}
?>