<?php
    include_once '../assets/demo/database.php';
    echo "HELLO"; 
    $db = new Database();
    $conn = $db->getConnection();

    $now = date("Y-m-d H:i:s");
    $query = "INSERT INTO wetter SET 
        messZeitpunkt='".$now."',
        luftTemp='".$_POST['luftTmp']."', 
        streckenTemp='".$_POST['streckeTmp']."', 
        wetterVerhaeltnis='".$_POST['verhaeltnis']."'
        ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
?>