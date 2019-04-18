<?php
include 'Header.php';
require_once 'MyFunct.php';
$id = $_GET["id"];
$userId = getUSERID();
$idcheck = ValidAuthorID($userId, $id);
if ($idcheck) {
    ?>
    <html>
<body>

<link rel="stylesheet" type="text/css" href="Layout.css">
<link rel="stylesheet" type="text/css" href="TopMenu.css">
<fieldset>

    <style>
        p {
            width: 80em;
            border: 2px solid #FFFFFF;
            word-wrap: break-word;
            color: white;
            background-color: #228091;
        }
    </style>
    <?php


    $FullPost = PastHandler($id);
    $userId = getUSERID();
    ?>

    <html><p><?php echo $FullPost; ?> </p></html><?php
    ?>
    <!--Home-->
    <a href="Home.php">
        <img border="0" alt="HomePage" id=linkeded src="Graphics/btnHome.png" style="height:35px">
    </a>
    <!--Logout-->
    <a href="LogoutChk.php">
        <img border="0" alt="TopPage" id=linked src="Graphics/btnLogout.png" style="height:35px">
    </a>

</fieldset>
<fieldset>
    <form action="UpdateHandler.php?id=<?= $id ?>" method="POST">
        <!--Heading -->
        New Heading: <br>
        <input type="text" name="Header" id="Header" maxlength="128" minlength="5" value="" required><br><br>
        <!--Body-->
        New Body: <br>
        <textarea rows="6" cols="75" name="Body" id="Body" value="" maxlength="95000" required></textarea><br><br>

        <!--Submit sends the data to the server.--> <?php
        echo "<a href='PastHandler.php?id=$id'>" ?>
        <img border="0" alt="HomePage" src="Graphics/btnGoBack.png" style="height:35px">
        </a>

        &nbsp; &nbsp;
        <input type="image" src="Graphics/btnUpdate.png" style="height:35px" class="pure-button primary"/>
    </form>
</fieldset>
</form>
</body>
    </html><?php
}
else{
    $message = "This is not your post!";
    include 'LoginFailed.php';
}
