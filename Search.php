<?php

/* Ver 2.09 (4-9-17)
====
Joe Leon
Jonathan Couture
Xavier Villa

===
*/
include 'Header.php';
require_once 'MyFunct.php';
 ?>
<link rel="stylesheet" type="text/css" href="Layout.css">
<link rel="stylesheet" type="text/css" href="SearchMenu.css">

<!-- FaceSpace Banner
When clicked, it will take you back to the home menu.-->
<a href="Home.php">
    <img border="0" alt="HomePage" src="Graphics/logSearchResults.png" style="height:75px"></a><br><br>
<form action="_SearchTable.php" method="POST">

<fieldset>
<!-- Search Textbox -->
<input type="text" name="SearchText" id=SearchText value=""/> <br>

<!--Radio Buttons-->
<input type="radio" name="Switch" value="BodyS" checked>By Body &nbsp; &nbsp;
<input type="radio" name="Switch" value="HeadS">By Title &nbsp; &nbsp; <br>

    <!--Logout -->
    <a href="LogoutChk.php">
        <img border="0" alt="TopPage" id= linked src="Graphics/btnLogout.png" style="height:35px">
    </a>
    <!--Search Button-->
        <input type="image" src="Graphics/btnSearch.png" style="height:35px" class="primary-button"> &nbsp;
    <br>
    <!-- Home -->
    <a href="Home.php">
        <img border="0" alt="HomePage" id= Home src="Graphics/btnHome.png" style="height:35px">
    </a>
</fieldset>