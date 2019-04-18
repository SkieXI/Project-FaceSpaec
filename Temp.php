Function GetUserName($uID)
//Inverse of GetUserID($user, $password)
{
$conn = dbConn();
if ($conn == "Failed") {
return error("internet");
}
$sql = "SELECT ui.UserName, bi.UserID bi.Header FROM bloginfo bi INNER JOIN userinfo ui ON(bi.UserID = '$uID'";

$index = 0;
$Test = array();
$result = $conn->query($sql);

while($row = $result ->fetch_assoc()) {
$Test[$index] = array ($row["UserName"]);
$index++;
}
return $Test;
}
