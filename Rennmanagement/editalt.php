<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reifenmanagement</title>
    </head>
    <body>
<form action="rennlogik.php" method="post">        
<?php
session_start();
include_once './../database/database.php';

$_SESSION['newsession'] = $_GET['id'];
$id = $_SESSION['newsession'];

$db = new Database();
             $conn = $db->getConnection();
             $query = "SELECT standort, datum FROM rennen WHERE rennID='$id'";
             $stmt = $conn->prepare($query);
             $stmt->execute();
             while($result = $stmt->fetch())
             {
                echo json_encode($result['standort']." ". $result['datum'])." ";
                echo "<br><br>";
             }

$db = new Database();
             $conn = $db->getConnection();
             $query = "SELECT mischung, bezeichnung, kontingent FROM mischung WHERE rennID = '$id'";
             $stmt = $conn->prepare($query);
             $stmt->execute();
             echo "Vorhandene Mischungen:"."<br>";
             while($result = $stmt->fetch())
             {
                echo json_encode($result['mischung']." ". $result['bezeichnung']." ".$result['kontingent'])." ";
                echo "<br>";
             }
?>
<br>
<div id="mischungen">
        <label>Mischung/Bezeichnung/Kontingent</label><br>
        <input type="text" id="mischung" name="mischung" ><input type="text" id="bezeichnung" name="bezeichnung"><input type="text" id="kontingent" name="kontingent"><br><br>
        <input type="submit" value = "Mischung hinzufügen" name="hinzufügen"><br><br>
        </div>     
<a href="rennmanagement.php">Zurück</a>  
    </body>
</html>