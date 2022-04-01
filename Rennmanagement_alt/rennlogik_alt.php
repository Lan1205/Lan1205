<?php
session_start();
include_once './../database/database.php';
include_once '../objects/rennen.php';

$db = new Database();
$conn = $db->getConnection();


$rennen = new Rennen($conn);

if(isset($_POST['erstellen'])){
$standort=$_POST['standort'];
$datum=$_POST['renndatum'];

    if(empty($standort)){
        echo "<script type='text/javascript'>alert('Standort kann nicht leer sein');</script>";
        echo"<meta http-equiv='refresh' content='0;url=rennmanagement.php'>";  
    }else{
        $saved= $rennen->rennenSpeichern($standort, $datum);
        echo"<meta http-equiv='refresh' content='0;url=rennmanagement.php'>";  
}
}
else if(isset($_POST['hinzufügen'])){
$rennID= $_SESSION['newsession'];
$mischung=$_POST['mischung'];
$bezeichnung=$_POST['bezeichnung'];
$kontingent=$_POST['kontingent'];

$saved= $rennen->mischungSpeichern($rennID, $mischung, $bezeichnung, $kontingent);
$id = $_SESSION['newsession'];
header("Refresh:0; url=edit.php?id=$id");
}
?>
