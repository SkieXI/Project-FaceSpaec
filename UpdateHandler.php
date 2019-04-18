<?php
include 'Header.php';
require_once 'MyFunct.php';

$Head = $_POST["Header"];
$Body = $_POST["Body"];
$id = $_GET["id"];

$message = UpdatePost($Head, $Body, $id);

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