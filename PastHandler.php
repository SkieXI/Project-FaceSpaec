<?php
include 'Header.php';
require_once 'MyFunct.php';
?>
<html>
<body>
<link rel="stylesheet" type="text/css" href="Layout.css">
<link rel="stylesheet" type="text/css" href="TopMenu.css">
<form action="CommentHandler.php?id=<?php echo $_GET["id"]?>" method="POST">
<fieldset>
<!--Color List-
    Teal = #45e0d6
    Darker Teal = #2e8fa0
    Bright Purple: #b614fc

-->
    <style>
        p {
            width: 80em;
            border: 2px solid #FFFFFF;
            word-wrap: break-word;
            color:white;
            background-color:#228091;
        }
    </style>
<?php

$id = $_GET["id"];
$FullPost = PastHandler($id);
$userId = getUSERID();
?>

<html><p><?php echo $FullPost;?> </p></html><?php
?>
    <!--Home-->
    <a href="Home.php">
        <img border="0" alt="HomePage" id= linkeded src="Graphics/btnHome.png" style="height:35px">
    </a>
    <!--Logout-->
    <a href="LogoutChk.php">
        <img border="0" alt="TopPage" id= linked src="Graphics/btnLogout.png" style="height:35px">
    </a>


    <?php
    $idcheck = ValidAuthorID($userId, $id);
    if ($idcheck){
     echo "<a href='PostUpdate.php?id=$id'>" ?>
         <img border=0 alt="Edit Post" src="Graphics/btnEdit.png" style="height:35px"></a> &nbsp; &nbsp; <?php
       echo "<a href='DeleteChk.php?id=$id'>" ?>
            <img border=0 alt="Delete Post" src="Graphics/btnDeletePost.png" style="height:35px"></a>
        <?php
             }
             ?>
</fieldset>
<fieldset>
    <fieldset>

    <!-- Comment Box-->
    Comments? <br>
    <textarea rows="2" cols="75" name="Comment" id="Comment" value="" maxlength="255" minlength="2"required></textarea><br><br>

    <!-- Submit Button -->
    <input type="image" src="Graphics/btnRegSubmit.png" style="height:35px" class="pure-button primary">



</fieldset>
    <?php include ('_Comment Table.php');?>
</fieldset>
</body>
</html>