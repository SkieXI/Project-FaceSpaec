<?php
include 'Header.php';
require_once 'MyFunct.php';
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
    <table id="CommentPost" style="width:100%; color:white;">
        <tr>
            <th>Comment</th>
            <th>User</th>
        </tr><?
        $id = $_GET["id"];
        $Commentinfo = CallComment($id);
        //$Comment, $PostID, $userId
        for($x=0;$x < count($Commentinfo);$x++)
        {
            //Array Commentinfo contains Comment Text[0], and $names [1]
            echo "<tr>";
            echo    "<td>" . $Commentinfo[$x][0] . "</td>" . "<td>" . $Commentinfo[$x][1] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</fieldset>
</html>

