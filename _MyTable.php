<?php
include 'Header.php';
require_once 'MyFunct.php';
?>
    <link rel="stylesheet" type="text/css" href="Layout.css">
    <link rel="stylesheet" type="text/css" href="TopMenu.css">
    <fieldset>
    <style>
        table, th, td {
            border: 1px solid white;
    </style>
    <style>
        a:link    {
            color:white;
            background-color:transparent;
            text-decoration:none}
        }
    </style>
    <table id="MyStuff" style="width:100%; color:white;">
        <tr>
            <th>Comment</th>
            <th>User</th>
            <th>Options</th>
            </tr><?php
            $head = array();
            $id = getUSERID();
            $head = CallMYHeader($id);
for($x=0;$x < count($head); $x++)
{
    $Title = $head[$x][0];
    $id = $head[$x][2];
    echo "<tr>";
    echo    "<td>" . "<a href='PastHandler.php?id=$id'>$Title</a>". "</td>" . "<td>" . $head[$x][1] . "</td>";
    echo "</tr>";
}
?>
    </tr></table><?