<!DOCTYPE html>
<html>
<body>

<link rel="stylesheet" type="text/css" href="Layout.css">
<link rel="stylesheet" type="text/css" href="TopMenu.css">
<link rel="stylesheet" type="text/css" href="TxtAlignment.css">
<?php
require_once 'MyFunct.php';
$conn = dbConn();


    $sql = "SELECT * FROM bloginfo";

    $results = $conn->query($sql);
    if ($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            echo /*"id: " . $row["UserID"]. "<br>" . */
                " Header: " . $row["Header"] . "<br>" . " Body: " . $row["Body"] . "<br><br>";
        }
    } else {
        echo "0 results";
    }
    $conn->close();

?>
<input type="image" src="Graphics/btnGoBack.png" style="height:35px" onclick="window.location.href='GetPosts.php'" />
</body>
</html>