<?php
    include_once '../assets/demo/database.php';

    $db = new Database();
    $conn = $db->getConnection();

    $query = "SELECT * FROM wetter";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    while($result = $stmt->fetch())
    {
        echo json_encode($result['messZeitpunkt']);
        echo "!";
        echo json_encode($result['luftTemp']);
        echo "!";
        echo json_encode($result['streckenTemp']);
        echo "!";
        echo json_encode($result['wetterVerhaeltnis']);
        echo "?";
    }
    
?>