<?php
include ('Header.php');
require_once 'MyFunct.php';
$id = $_GET{"id"};

for ($x=0;$x<1;$x++)
{
    //This will be attemped, but if there are not comments to delete, it will move on.
    try {

        deleteComments($id);
    }
    //This will always run.
    finally
    {
        deleteBlog($id);
        include 'Home.php';
    }
}
