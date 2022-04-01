<?php
// include database and object files
session_start();
$_SESSION['logged_in'] = true;
include_once '../database.php';
include_once '../objects/user.php';
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare user object
$user = new User($db);
// set ID property of user to be edited
$user->username_login = isset($_POST['username']) ? $_POST['username']: die();
$user->password = isset( $_POST['password']) ?  $_POST['password']: die();
// get the position of the user 
$stmt = $user->login();
if($stmt->rowCount() > 0)
{
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $arr[] =$row['position'];
   
    //jenach position wird die entsprechende Seite aufgerufen
    switch($arr[0]) 
    {
        case 1: // Mitarbeiter
            echo"<meta http-equiv='refresh' content='0;url=../Rennmanagement/rennmanagement.php'>";
            break; 
        case 2: //Manager
            echo"<meta http-equiv='refresh' content='0;url=../Rennmanagement/rennmanagement.php'>";
            break; 
        case 3: //Ingenieur 
            echo"<meta http-equiv='refresh' content='0;url=../Rennmanagement/rennmanagement.php'>";
            break; 
        default : 
             echo"<meta http-equiv='refresh' content='0;url=../Rennmanagement/rennmanagement.php'>";   
             break; 
    }     
} 
else
{
    echo '<script>alert("No Such User found, try again!")</script>';
    echo"<meta http-equiv='refresh' content='0;url=./login.html'>";
}

$_SESSION['position'] = $arr[0];
?>