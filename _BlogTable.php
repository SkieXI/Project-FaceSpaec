<?php
require_once 'MyFunct.php';

/*Table that displayes pevious Post by ALL user.
<form action="PastHandler.php" method="get"> */
?><fieldset>
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
    <table id="PastPost" style="width:100%; color:white;">
        <tr>
            <th>Headings</th>
            <th>User</th>
        </tr><?php
        $head = array();
        $head = CallHeader();
        //head is a 2D array containing $Names and $IID
        for($x=0;$x < count($head); $x++)
        {
            $Title = $head[$x][0];
            $id = $head[$x][2];
            echo "<tr>";
            echo    "<td>" . "<a href='PastHandler.php?id=$id'>$Title</a>". "</td>" . "<td>" . $head[$x][1] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</fieldset>