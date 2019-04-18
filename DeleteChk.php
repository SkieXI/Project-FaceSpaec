<?php
include 'Header.php';
include_once 'MyFunct.php';

$id = $_GET["id"];
$userId = getUSERID();
$idcheck = ValidAuthorID($userId, $id);
if ($idcheck)
{
?>
<head>
    <meta charset="UTF-8">
    <title>Delete Post?</title>
    <link rel="stylesheet" type="text/css" href="Layout.css">
</head>
<body>
<!--<form action="DeleteHandler.php" method="POST">-->
<fieldset>

    <h1>Are you sure you want to delete post?</h1>

    <!-- NO --> <?php
    echo "<a href='PastHandler.php?id=$id'>" ?>
        <img border="0" alt="No" id= linked src="Graphics/btnNO.png" style="height:35px">
    </a>

    <!--YES--> <?php
    echo "<a href='DeleteHandler.php?id=$id'>"?>
    <img border="0" alt="No" id= linked src="Graphics/btnDeletePost.png" style="height:35px">
    </a>

</fieldset>
</body>
<?php }
else
{
    $message = "Wrong user";
}