<?php
require_once 'MyFunct.php';
include 'Header.php';
$Search = $_POST["SearchText"];
include ('Search.php');

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
        </tr><?
        if ($_POST["Switch"] =="BodyS") {
            //Searches for matching body.
            $users = SearchBody($Search);
            for ($x = 0; $x < count($users); $x++) {
                $Title = $users[$x][0];
                $id = $users[$x][2];
                echo "<tr>";
                echo "<td>" . "<a href='PastHandler.php?id=$id'>$Title</a>" . "</td>" . "<td>" . $users[$x][1] . "</td>" . "</td>";
                echo "</tr>";
            }
        }
        else if ($_POST["Switch"] =="HeadS")
        {
            //Searches for matching Headers.
            $users = SearchHeader($Search);
            for ($x = 0; $x < count($users); $x++) {
                $Title = $users[$x][0];
                $id = $users[$x][2];
                echo "<tr>";
                echo "<td>" . "<a href='PastHandler.php?id=$id'>$Title</a>" . "</td>" . "<td>" . $users[$x][1] . "</td>" . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</fieldset>

</html>