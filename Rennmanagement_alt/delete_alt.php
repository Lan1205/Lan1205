<?php

include_once './../database/database.php';

$id = $_GET['id']; 

$db = new Database();
$conn = $db->getConnection();
$query = "DELETE FROM rennen WHERE rennID = '$id'";
$stmt = $conn->prepare($query);
$stmt->execute();
echo "<meta http-equiv='refresh' content='0;url=rennmanagement.php'>";  
?>