<?php
function dbConn()
{
    //ServerName, Username, Password, DBName
    //$conn = new mysqli("localhost", "rleonbho_root", "rooot", "rleonbho_blogthing");
    //Hostable Values ^
    //MAMP Values     v
    $conn = new mysqli("localhost", "root", "root", "blogthing");
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
Function GetBlogID()
{
    return $_SESSION["UserID"];
}

function error($type){
    $type = strtolower($type);
    switch ($type){
        case "internet": return "ɷError 1101: Cannot Connect to the Database";
        case "username": return "ɷError 1102: User Name is Currently Taken";
        case "incorrect": return "ɷError 1103: User Name or Password Do Not Match";
        case "database": return "ɷError 1200: Database Failed to Properly Connect";
        case "resultIsFalse": return "ɷError 1212: Database Refused to Act Properly";
        case 1101: return "ɷError 1101: Cannot Connect to the Database";
        case 1102: return "ɷError 1102: User Name is Curently Taken";
        case 1103: return "ɷError 1103: User Name or Password Do Not Match";
        case 1200: return "ɷError 1200: Database Failed to Properly Connect";
        case 1212: return "ɷError 1212: Database Failed to Properly Connect";
        default: return "ɷError ⸎⸎⸎⸎: Unknown Error was Detected";
    }
    return "ɷError ⸎⸎⸎⸎: Unknown Error was Detected";
}

function amIAnError($message){
    $trueMessage = mb_substr($message, 1);
    if(mb_substr($message, 0, 1) === 'ɷ' && !contains("ɷ", $trueMessage)){
        return true;
    }
    else{
        return false;
    }
}

function contains($subString, $String)
{
    return !strpos($String, $subString);
}

// ALL SELECT FUNCTIONS

Function selectAll()
{
    $conn = dbConn();
    if($conn=="Failed"){
        $errorMessage = error("internet");
        $users[0] = array($errorMessage);
        return $users;
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
    $errorMessage = error("resultIsFalse");
    return $users[0] = array($errorMessage);
}
Function getUser($user, $password)
{
    $conn = dbConn();
    if ($conn == "Failed") {
        return error("internet");
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
        return error("incorrect");
    }
}/*
Function GetUserName($uID)
    //Inverse of GetUserID($user, $password)
{
    $conn = dbConn();
    if ($conn == "Failed") {
        return error("internet");
    }
    $sql = "SELECT bloginfo.UserID, userinfo.RegID, userinfo.UserName FROM userinfo
            INNER JOIN userinfo ON userinfo.RegID = bloginfo.UserID";

    $index = 0;
    $Test = array();
    $result = $conn->query($sql);


    while($row = $result ->fetch_assoc()) {
        $Test[$index] = array ($row["UserName"]);
        $index++;
    }
    return $Test;
}*/
//Added 3-12-17
//To determine Admin status.
Function GetAdminChk($user, $AdminChk)
{
    $conn = dbConn();
    if ($conn == "Failed") {
        return error("internet");
    }
    $sql = "SELECT DISTINCT ADMINCHK FROM userinfo WHERE" . " BINARY ADMINCHK ='" . $AdminChk ."'";

    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        //This is what runs when the input text is correct.
        $row = $result->fetch_assoc();
        $message = $row["AdminChk"];

        $conn->close();
        return $message;
    }
    else{
        return "Not an Admin.";
    }

}
// For AdminSettings.html
Function getUserReturnRow($user, $password)
{
    $conn = dbConn();
    if($conn=="Failed"){
        return error("internet");
    }
    $sql = "SELECT DISTINCT USERNAME, PASSWORD FROM userinfo WHERE" . " BINARY USERNAME ='" . $user . "' AND " . "BINARY PASSWORD ='" .$password . "'";
    $result = $conn->query($sql);
    if ($result ->num_rows == 1) {
        //This is what runs when the input text is correct.
        $message = $result->fetch_assoc();
    }
    else{
        $message = error("database");
    }
    $conn->close();
    return $message;
}
//???
Function checkUserExistance($user)
{
    $conn = dbConn();
    if ($conn == "Failed") {
        return error("internet");
    }
    $sql = "SELECT DISTINCT USERNAME FROM userinfo WHERE" . " BINARY USERNAME ='" . $user . "'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        //This is what runs when the input text is correct.
        $conn->close();
        return "";
    } else {
        $conn->close();
        return error("database");
    }
    //Calls all post
    function CallHeader()
    {
        $conn = dbConn();
        if ($conn == "failed") {
            return error("internet");
        }
        $sql = "SELECT bi.Header, ui.UserName, bi.Index FROM bloginfo bi INNER JOIN userinfo ui ON(bi.UserID = ui.RegID)";
        $result = $conn->query($sql);


        $index = 0;
        $head = array();
        while ($row = $result->fetch_assoc()) {

            $Names = $row["UserName"];
            $IID = $row["Index"];

            $head [$index] = array($row["Header"], $Names, $IID);
            $index++;
        }
        $conn->close();
        return $head;
    }

    Function CallBody()
    {
        $conn = dbConn();
        if ($conn == "failed") {
            return error("internet");
        }
        $sql = "SELECT * FROM bloginfo";
        $result = $conn->query($sql);

        while ($CurrentRow = $result->fetch_assoc()) {
            $body = $CurrentRow["Body"];
            echo nl2br($body . "<br>" . "____" . "<br>");
        }

        $conn->close();
    }

    Function CallUser()
    {
        $conn = dbConn();
        if ($conn == "failed") {
            return error("internet");
        }
        $sql = "SELECT * FROM userinfo";
        $result = $conn->query($sql);

        while ($CurrentRow = $result->fetch_assoc()) {
            $IndexID = $CurrentRow["UserName"];
            //echo nl2br($IndexID . "<br><br>");
        }

        $conn->close();
        return $IndexID;
    }

    function CountBlogs()
    {
        $i = 0;
        $conn = dbConn();
        if ($conn == "failed") {
            return error("internet");
        }
        $sql = "SELECT * FROM bloginfo";
        $result = $conn->query($sql);

        while ($CurrentRow = $result->fetch_assoc()) {
            $i++;
        }
        $conn->close();
        return $i;
    }

    function CallNewRow($i)
    {
        $conn = dbConn();
        if ($conn == "failed") {
            return error("internet");
        }
        $sql = "SELECT * FROM bloginfo WHERE Index = $i";
        $result = $conn->query($sql);
        while ($CurrentRow = $result->fetch_assoc()) {
            $newRow["Header"] = $CurrentRow["Header"];
            $newRow["Body"] = $CurrentRow["Body"];
            $newRow["Index"] = $CurrentRow["Index"];
        }
        $conn->close();
        return $newRow;
    }


//Temp Function.
    Function ValidAuthorID($UserID, $PostID)
    {
        $isValid = false;
        $conn = dbConn();
        $SQL = "SELECT * FROM bloginfo where bloginfo.UserID = '$UserID' AND bloginfo.Index = '$PostID'";
        $result = $conn->query($SQL);

        if ($result->num_rows > 0){
            $isValid = true;
        }
        return $isValid;
    }

    Function GetAllUsers()
    {

        $conn = dbConn();
        if ($conn == "failed") {
            return error("internet");
        }
        $sql = "";//"SELECT * FROM userinfo WHERE UserName LIKE $SearchBar ";
        $result = $conn->query($sql);

        while ($CurrentRow = $result->fetch_assoc()) {
            $IndexID = $CurrentRow["UserName"];
            echo nl2br($IndexID . "<br><br>");
            //return $IndexID;
        }

        $conn->close();
    }

    Function SearchBody($Search)
    {
        $conn = dbConn();
        if ($conn == "failed") {
            return error("internet");
        }
        $sql = "SELECT * FROM  bloginfo WHERE Body LIKE '%$Search%'";
        $result = $conn->query($sql);

        $index = 0;
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $uID = $row["UserID"];
            $Names = GetUserName($uID);
            $IID = $row["Index"];

            $users[$index] = array($row["Header"], $Names, $IID);
            ++$index;
        }
        // Close the connection
        $conn->close();

        // Return the Users Array
        return $users;
    }

    Function PastHandler($id)
    {

        $conn = dbConn();
        $BID = $id;
        $FullPost = "";
        //SELECT bi.Header, ui.UserName, bi.Index FROM bloginfo bi INNER JOIN userinfo ui ON(bi.UserID = ui.RegID)
        $sql = "SELECT * FROM bloginfo WHERE bloginfo.Index = '$BID'";

        $result = $conn->query($sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $FullPost = "Header: " . $row["Header"] . "<br>" . "Body: " . $row["Body"] . "<br><br>";
            }
        } else {
            $FullPost = "Invalid Index" . "<br>" . "ID = " . $BID;
        }
        $conn->close();
        return $FullPost;


    }

    Function CallComment($id)
    {
        $conn = dbConn();
        if ($conn == "failed") {
            return error("internet");
        }
        //Needed: Comment, and UserName from the PostID.
        //$sql = "SELECT bi.Header, ui.UserName, bi.Index FROM bloginfo bi INNER JOIN userinfo ui ON(bi.UserID = ui.RegID)";
        $sql = "SELECT ci.Comment, ui.UserName FROM commentinfo ci INNER JOIN userinfo ui ON(ci.UserID = ui.RegID) WHERE ci.PostID = '$id'";
        $result = $conn->query($sql);

        $index = 0;
        $Commentinfo = array();
        while ($row = $result->fetch_assoc()) {

            $Names = $row["UserName"];
            //$IID = $row["Index"];

            $Commentinfo [$index] = array($row["Comment"], $Names,);
            $index++;
        }
        $conn->close();
        return $Commentinfo;
    }
}

// ALL DELETE FUCTIONS
//For Settings
Function delete($id)
{
    $conn = dbConn();
    if($conn=="failed"){
        return error("internet");
    }
    $sql = "DELETE FROM userinfo WHERE RegID = $id";
    $result = $conn->query($sql);
    if(count(mysqli_affected_rows($conn)) != 1){
        return error("resultIsFalse");
    }
    $conn->close();
    if($result) {
        return $result;
    }
    return error("resultIsFalse");
}

//ALL UPDATE FUNCTIONS
Function update($id, $firstname, $lastname, $user, $email, $password)
{
    return (delete($id)&newRow($firstname, $lastname,$user, $email, $password));

}
/*Function updateRow($row){
    update($row["RegID"],$row["FirstName"],$row["LastName"],$row["UserName"], $row["Email"], $row["Password"]);
}*/

//ALL INSERT FUNCTIONS
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
        return error("internet");
    }
    $sql = "INSERT INTO userinfo (FirstName, LastName,UserName, Email, Password) VALUES ('".$firstname."', '".$lastname."', '".$user."', '".$email."' , '".$password."')";
    $result = $conn->query($sql);
    if(count(mysqli_affected_rows($conn)) != 1){
        return error("resultIsFalse");
    }
    $conn->close();
    if($result) {
        return $result;
    }
    return error("resultIsFalse");
}
//For Poster.php
Function newPost($Head, $Body, $userId)
{
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    //
    $sql = "INSERT INTO bloginfo (UserID, Header, Body) VALUES ('" . $userId . "','" . $Head . "', '" . $Body . "')";
    $result = $conn->query($sql);
    if(count(mysqli_affected_rows($conn)) != 1){
        return error("resultIsFalse");
    }
    $conn->close();
    if($result) {
        return $result;
    }
    return error("resultIsFalse");
}
Function newComment($Comment, $PostID, $userId )
{
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    //Index, UserID, PostID, Comment
    $sql = "INSERT INTO commentinfo (UserID, PostID, Comment) VALUES ('" . $userId . "','" . $PostID . "', '" . $Comment . "')";
    $result = $conn->query($sql);
    if(count(mysqli_affected_rows($conn)) != 1){
        return error("resultIsFalse");
    }
    $conn->close();
    if($result) {
        return $result;
    }
    return error("resultIsFalse");
}