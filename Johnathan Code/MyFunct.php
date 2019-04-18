<?php
function dbConn()
{
    $conn = new mysqli("localhost", "root", "root", "activity2");
    if ($conn->connect_error)
    {
        $conn = "Failed";
    }
    return $conn;
}
function saveUserID($id)
{
    $_SESSION["RegID"] = $id;
}

function getUSERID()
{
    return $_SESSION["RegID"];
}
function contains($subString, $String)
{
    return strpos($String, $subString) !== false;
}

require_once "MyFunct.php";
Function selectAll()
{
    $conn = dbConn();
    if($conn=="Failed"){
        return;
    }
    $index = 0;
    $users = array();

    $sql = "SELECT * FROM userinfo";
    $result = $conn->query($sql);
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            $users[$index] = array($row["RegID"], $row["FirstName"], $row["LastName"], $row["UserName"], $row["Email"], $row["Password"]);
            ++$index;
        }
        $conn->close();
        return $users;
    }
}
Function getUser($user, $password)
{
    $conn = dbConn();
    if ($conn == "Failed") {
        return "Error: Unable to connect to the internet";
    }
    $sql = "SELECT RegID, USERNAME, PASSWORD FROM userinfo WHERE" . " BINARY USERNAME ='" . $user . "' AND " . "BINARY PASSWORD ='" .
        $password . "'";

    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        //This is what runs when the input text is correct.
        $row = $result->fetch_assoc();
        $message = $row["RegID"];

        $conn->close();
        return $message;
    }
    else{
        return "Error: User name and Password does not match";
    }
}
Function getUserReturnRow($user, $password)
{
    $conn = dbConn();
    if($conn=="Failed"){
        return "Failed";
    }
    $sql = "SELECT DISTINCT USERNAME, PASSWORD FROM userinfo WHERE" . " BINARY USERNAME ='" . $user . "' AND " . "BINARY PASSWORD ='" .$password . "'";
    $result = $conn->query($sql);
    if ($result ->num_rows == 1) {
        //This is what runs when the input text is correct.
        $message = $result->fetch_assoc();
    }
    else{
        $message = "Failed";
    }
    $conn->close();
    return $message;
}
Function checkUserExistance($user){
    $conn = dbConn();
    if($conn=="Failed"){
        return true;
    }
    $sql = "SELECT DISTINCT USERNAME FROM userinfo WHERE" . " BINARY USERNAME ='" . $user . "'";
    $result = $conn->query($sql);
    if ($result ->num_rows == 1) {
        //This is what runs when the input text is correct.
        $conn->close();
        return true;
    }
    else {
        $conn->close();
        return false;
    }
}
Function update($id, $firstname, $lastname, $user, $email, $password)
{
    $conn = dbConn();
    if($conn=="failed"){
        return false;
    }
    $sql = "UPDATE userinfo SET `RegID`=$id,'FirstName' = $firstname, 'LastName'= $lastname.'UserName'=$user, 'Email'= $email, 'Password'= $password WHERE RegID = $id";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
/*Function updateRow($row){
    update($row["RegID"],$row["FirstName"],$row["LastName"],$row["UserName"], $row["Email"], $row["Password"]);
}*/
/*Function newRowID($id, $firstname, $lastname, $user, $email, $password){
    $conn = dbConn();
    if($conn=="failed"){
        return true;
    }
    $sql = "INSERT INTO userinfo (RegID, FirstName, LastName,UserName, Email, Password) VALUES ('".$id."','".$firstname."', '".$lastname."', '".$user."', '".$email."' , '".$password."')";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}*/
Function newRow($firstname, $lastname, $user, $email, $password){
    $conn = dbConn();
    if($conn=="failed"){
        return false;
    }
    $sql = "INSERT INTO userinfo (FirstName, LastName,UserName, Email, Password) VALUES ('".$firstname."', '".$lastname."', '".$user."', '".$email."' , '".$password."')";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
Function delete($id)
{
    $conn = dbConn();
    if($conn=="failed"){
        return false;
    }
    $sql = "DELETE FROM userinfo WHERE RegID = $id";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}