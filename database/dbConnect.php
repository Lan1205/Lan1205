<?php

function userLogin($user, $pass){

$message = 'Wrong password or username!';

$servername = "localhost";
$username = "root";
$password_sql = "";
$dbname = "propra";
$row = '';

    $conn = new mysqli($servername, $username, $password_sql, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT position from user where username = '$user' and password = '$pass' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $arr = array();
    $x = 0;
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $arr[] = $row['position'];
    echo $arr[$x];
    if($arr[$x] == 0)
    header("Location: admin.php");
    else if($arr[$x] == 1)
    header("Location: prozess.php");
    else if($arr[$x] == 2)
    header("Location: manager.php");
    else if($arr[$x] == 3)
    header("Location: mitarbeiter.php");

    $x++;
    
  }
} else {
  echo "<script type='text/javascript'>alert('$message');</script>";
}
$conn->close();
    }
// Create connection

function register($lastname, $firstname, $birthdate, $phonenumber, $position, $email, $username, $password){
$servername = "localhost";
$username_sql = "root";
$password_sql = "";
$dbname = "propra";

// Create connection
$conn = new mysqli($servername, $username_sql, $password_sql, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO user (lastname, firstname, birthdate, phonenumber, position, email, username, password)
VALUES ('$lastname', '$firstname', '$birthdate', '$phonenumber', '$position', '$email', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}

function deleteUser($userID){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "propra";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

// sql to delete a record
$sql = "DELETE FROM user WHERE userID='$userID'";

if ($conn->query($sql) === TRUE) {
  //echo "UserID is ".$userID;
} else {
  echo "Error deleting record:" . $conn->error;
}

$conn->close();
}

function editUser($userID, $lastName, $firstName, $birthdate, $phonenumber, $position, $email, $username, $password){
  $servername = "localhost";
  $username_sql = "root";
  $password_sql = "";
  $dbname = "propra";
  
  // Create connection
  $conn = new mysqli($servername, $username_sql, $password_sql, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  
  // sql to edit a record
  $sql = "UPDATE user SET lastName='$lastName', firstName='$firstName', birthdate='$birthdate', phonenumber='$phonenumber', position='$position', email='$email', username='$username', password='$password' WHERE userID='$userID'";
  
  if ($conn->query($sql) === TRUE) {
    //echo "UserID is ".$userID;
  } else {
    echo "Error editing record: " . $conn->error;
  }
  
  $conn->close();
  }


?>