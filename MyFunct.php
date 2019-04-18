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
        case 1101: return "ɷError 1101: Cannot Connect to the Database";
        case 1102: return "ɷError 1102: User Name is Curently Taken";
        case 1103: return "ɷError 1103: User Name or Password Do Not Match";
        case 1200: return "ɷError 1200: Database Failed to Properly Connect";
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
    return strpos($String, $subString) !== false;
}

//require_once "MyFunct.php";
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
}

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
Function checkUserExistance($user){
    $conn = dbConn();
    if($conn=="Failed"){
        return error("internet");
    }
    $sql = "SELECT DISTINCT USERNAME FROM userinfo WHERE" . " BINARY USERNAME ='" . $user . "'";
    $result = $conn->query($sql);
    if ($result ->num_rows == 1) {
        //This is what runs when the input text is correct.
        $conn->close();
        return "";
    }
    else {
        $conn->close();
        return error("database");
    }
}
//For Settings
Function update($id, $firstname, $lastname, $user, $email, $password)
{
    return (delete($id)&newRow($firstname, $lastname,$user, $email, $password));

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
        return error("internet");
    }
    $sql = "INSERT INTO userinfo (FirstName, LastName,UserName, Email, Password) VALUES ('".$firstname."', '".$lastname."', '".$user."', '".$email."' , '".$password."')";
    $result = $conn->query($sql);
    /*if(count(mysqli_affected_rows($conn)) != 1){
        return error("database");
    }*/
    $conn->close();
    return $result;
}
//For Settings
Function deleteComments($id)
{
    $Bid = $id;
    $conn = dbConn();
    if($conn=="failed"){
        return error("internet");
    }
    $sql = "DELETE FROM commentinfo WHERE PostID = '$Bid'";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}
Function deleteBlog($id)
{
    $Bid = $id;
    $conn = dbConn();
    if($conn=="failed"){
        return error("internet");
    }
    $sql = "DELETE FROM bloginfo WHERE PostID = '$Bid'";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

//For Poster.php
Function ValidAuthorID($userId, $id)
{
    $isValid = false;
    $conn = dbConn();
    $SQL = "SELECT * FROM bloginfo where bloginfo.UserID = '$userId' AND bloginfo.PostID = '$id'";
    $result = $conn->query($SQL);

    if ($result->num_rows > 0){
        $isValid = true;
    }
    return $isValid;
}
Function newPost($Head, $Body, $userId)
{
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    //
    $Head = $conn->real_escape_string($Head);
    $Body = $conn->real_escape_string($Body);
    $sql = "INSERT INTO bloginfo (UserID, Header, Body) VALUES ('" . $userId . "','" . $Head . "', '" . $Body . "')";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}

Function newComment($Comment, $PostID, $userId )
{
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    $Comment = $conn->real_escape_string($Comment);
    //Index, UserID, PostID, Comment
    $sql = "INSERT INTO commentinfo (UserID, PostID, Comment) VALUES ('" . $userId . "','" . $PostID . "', '" . $Comment . "')";
    $result = $conn->query($sql);

    $conn->close();
    return $result;
}
//Calls all post
function CallHeader()
{
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    $sql = "SELECT bi.Header, ui.UserName, bi.PostID FROM bloginfo bi INNER JOIN userinfo ui ON(bi.UserID = ui.RegID)";
    $result = $conn->query($sql);

    $index = 0;
    $head = array();
    while($row = $result ->fetch_assoc())
    {
        $Names = $row["UserName"];
        $IID = $row["PostID"];

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

    while($CurrentRow = $result ->fetch_assoc())
    {
        $body = $CurrentRow["Body"];
        echo nl2br( $body. "<br>". "____" . "<br>" );
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

    while($CurrentRow = $result ->fetch_assoc())
    {
        $IndexID = $CurrentRow["UserName"];
        //echo nl2br($IndexID . "<br><br>");
    }

    $conn->close();
    return $IndexID;
}
function CountBlogs(){
    $i = 0;
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    $sql = "SELECT * FROM bloginfo";
    $result = $conn->query($sql);

    while($CurrentRow = $result ->fetch_assoc())
    {
        $i++;
    }
    $conn->close();
    return $i;
}
function CallNewRow($i){
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    $sql = "SELECT * FROM bloginfo WHERE PostID = $i";
    $result = $conn->query($sql);
    while($CurrentRow = $result ->fetch_assoc())
    {
        $newRow["Header"] = $CurrentRow["Header"];
        $newRow["Body"] = $CurrentRow["Body"];
        $newRow["PostID"] = $CurrentRow["PostID"];
    }
    $conn->close();
    return $newRow;
}

Function GetAllUsers()
{
//Temp Function.
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    $sql = "";//"SELECT * FROM userinfo WHERE UserName LIKE $SearchBar ";
    $result = $conn->query($sql);

    while($CurrentRow = $result ->fetch_assoc())
    {
        $IndexID = $CurrentRow["UserName"];
        echo nl2br($IndexID . "<br><br>");
        //return $IndexID;
    }

    $conn->close();
}
Function SearchHeader($Search)
{ // This will compare results with the header field.
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    $Search = $conn->real_escape_string($Search);
    $sql = "SELECT * FROM  bloginfo WHERE Header LIKE '%$Search%'";
    $result = $conn->query($sql);

    $index = 0;
    $users = array();
    while($row = $result ->fetch_assoc())
    {
        $uID = $row["UserID"];
        $Names = GetUserName($uID);
        $IID = $row["PostID"];

        $users[$index] = array($row["Header"], $Names, $IID );
        ++$index;
    }
    // Close the connection
    $conn->close();

    // Return the Users Array
    return $users;
}
Function SearchBody($Search)
{ //This will compare results with the body field.
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    $Search = $conn->real_escape_string($Search);
    $sql = "SELECT * FROM  bloginfo WHERE Body LIKE '%$Search%'";
    $result = $conn->query($sql);

    $index = 0;
    $users = array();
    while($row = $result ->fetch_assoc())
    {
        $uID = $row["UserID"];
        $Names = GetUserName($uID);
        $IID = $row["PostID"];

        $users[$index] = array($row["Header"], $Names, $IID );
        ++$index;
    }
    // Close the connection
    $conn->close();

    // Return the Users Array
    return $users;
}
Function GetUserName($uID)
    //Inverse of GetUserID($user, $password)
{
    $conn = dbConn();
    if ($conn == "Failed") {
        return error("internet");
    }
    $sql = "SELECT UserName FROM userinfo WHERE RegID = '$uID'";
    $result = $conn->query($sql);
    $row = $result ->fetch_assoc();

    return $row["UserName"];

}
Function PastHandler($id)
{

    $conn = dbConn();
    $BID = $id;
    $FullPost = "";
    //SELECT bi.Header, ui.UserName, bi.Index FROM bloginfo bi INNER JOIN userinfo ui ON(bi.UserID = ui.RegID)
    $sql = "SELECT * FROM bloginfo WHERE bloginfo.PostID = '$BID'";

    $result = $conn->query($sql);
    if ($result)
    {
        while ($row = $result->fetch_assoc())
        {
            $FullPost = "Header: " . $row["Header"] . "<br><br>" . "Body: " . $row["Body"] . "<br><br>";
        }
    }
    else
        {
            $FullPost = "Invalid Index" .  "<br>" . "ID = " . $BID;
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
    while($row = $result ->fetch_assoc())
    {

        $Names = $row["UserName"];
        $Commentinfo [$index] = array($row["Comment"], $Names,);
        $index++;
    }
    $conn->close();
    return $Commentinfo;
}
Function UpdatePost($Head, $Body, $id)
{
    $conn = dbConn();
    if ($conn == "failed") {
        return error("internet");
    }
    $Head = $conn->real_escape_string($Head);
    $Body = $conn->real_escape_string($Body);
    $sql = "UPDATE bloginfo SET Header = '" . $Head . "', Body = '" .  $Body ."' WHERE PostID = $id";
    //$sql = "INSERT INTO bloginfo ( Header, Body) VALUES ('" . $Head . "', '" . $Body . "') WHERE PostID = $id";
    $result = $conn->query($sql);
    //if ($result->mssql_rows_affected()>0)

        $conn->close();
        return $result;

}